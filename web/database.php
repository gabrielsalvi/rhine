<?php

function connect(): PDO {

  require 'config.php';
  
  $dsn = "pgsql:host=$host;port=$port;dbname=$db;";

  try {

    $db = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  } catch (PDOException $e) {
      
    die($e->getMessage());

  }

  $command = $db->prepare("SELECT count(*) as num_of_tables FROM information_schema.tables WHERE table_schema = 'public' AND table_type='BASE TABLE'");
  $command->execute();

  $num_of_tables = ($command->fetch())['num_of_tables'];

  if ($num_of_tables == '0') {
    createTables($db);
  }

  return $db;

}

function createTables(PDO $db) {
  
  $statements = [
    'CREATE TABLE IF NOT EXISTS enderecos (
      id SERIAL,
      uf VARCHAR(2) NOT NULL,
      cidade VARCHAR(25) NOT NULL,
      logradouro VARCHAR(80),
      numero VARCHAR(10),
      PRIMARY KEY (id)
    );',
    'CREATE TABLE IF NOT EXISTS atletas (
      cpf VARCHAR(11),
      nome VARCHAR(40) NOT NULL,
      sobrenome VARCHAR(80) NOT NULL,
      dtnascimento DATE NOT NULL,
      username VARCHAR(20) NOT NULL,
      email VARCHAR(30) NOT NULL,
      senha VARCHAR(30) NOT NULL,
      id_endereco INTEGER,
      CONSTRAINT fk_endereco FOREIGN KEY (id_endereco) REFERENCES enderecos (id),
      PRIMARY KEY (cpf)
    );',
    'CREATE TABLE IF NOT EXISTS estabelecimentos (
        cnpj VARCHAR(14),
        nome VARCHAR(30) NOT NULL,
        descricao VARCHAR(160),
        username VARCHAR(20) NOT NULL,
        email VARCHAR(30) NOT NULL,
        senha VARCHAR(30) NOT NULL,
        horario_abertura TIME NOT NULL,
        horario_fechamento TIME NOT NULL,
        PRIMARY KEY (cnpj) 
    );',
    'CREATE TABLE IF NOT EXISTS esportes (
      id SERIAL,
      descricao VARCHAR(20) NOT NULL,
      qtd_atletas INTEGER NOT NULL,
      PRIMARY KEY (id)
    );',
    'CREATE TABLE IF NOT EXISTS partidas (
      id SERIAL,
      cnpj VARCHAR(14),
      id_esporte INTEGER,
      data date NOT NULL,
      hora_inicial TIME NOT NULL,
      hora_final TIME NOT NULL,
      valor NUMERIC(15,2) NOT NULL,
      PRIMARY KEY (id),
      CONSTRAINT fk_estabelecimento FOREIGN KEY (cnpj) REFERENCES estabelecimentos (cnpj),
      CONSTRAINT fk_esporte FOREIGN KEY (id_esporte) REFERENCES esportes (id)
    );',
    'CREATE TABLE IF NOT EXISTS partida_atletas (
        id_partida INTEGER,
        cpf VARCHAR(11),
        PRIMARY KEY (id_partida, cpf),
        CONSTRAINT fk_partida FOREIGN KEY (id_partida) REFERENCES partidas (id),
        CONSTRAINT fk_atleta FOREIGN KEY (cpf) REFERENCES atletas (cpf)
    );',
  ];

  foreach ($statements as $statement) {
    $db->exec($statement);
  }

}

?>