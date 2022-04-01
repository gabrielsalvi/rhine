<?php

class Database {

  private static $connection;

  public static function connect() {
    if (!self::$connection) {
      require '../../resources/config.php';

      $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
  
      try {
        self::$connection = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    
      if (self::isEmpty()) {
        self::createTables();
      }
    }
  }

  public static function getConnection() {
    return self::$connection;
  }

  private static function isEmpty() : bool {
    $stmt = "SELECT count(*) as num_of_tables FROM information_schema.tables WHERE table_schema = 'public' AND table_type='BASE TABLE'";
    
    $command = self::$connection->prepare($stmt);
    $command->execute();
  
    $num_of_tables = (int)($command->fetch())['num_of_tables'];
  
    if ($num_of_tables > 0) {
      return false;
    }

    return true;
  }

  private static function createTables() {
  
    $statements = [
      'CREATE TABLE IF NOT EXISTS localizacoes (
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
        senha VARCHAR(255) NOT NULL,
        id_localizacao INTEGER,
        PRIMARY KEY (cpf),
        CONSTRAINT fk_localizacao FOREIGN KEY (id_localizacao) REFERENCES localizacoes (id),
        UNIQUE (email, username)
      );',
      'CREATE TABLE IF NOT EXISTS estabelecimentos (
          cnpj VARCHAR(14),
          nome VARCHAR(30) NOT NULL,
          descricao VARCHAR(160),
          username VARCHAR(20) NOT NULL,
          email VARCHAR(30) NOT NULL,
          senha VARCHAR(255) NOT NULL,
          horario_abertura TIME NOT NULL,
          horario_fechamento TIME NOT NULL,
          PRIMARY KEY (cnpj),
          UNIQUE (email, username)
      );',
      'CREATE TABLE IF NOT EXISTS enderecos_estabelecimentos (
        id SERIAL,
        cnpj VARCHAR(14),
        id_localizacao INTEGER,
        logradouro VARCHAR(100) NOT NULL,
        numero VARCHAR(10) NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT fk_estabelecimento FOREIGN KEY (cnpj) REFERENCES estabelecimentos (cnpj),
        CONSTRAINT fk_localizacao FOREIGN KEY (id_localizacao) REFERENCES localizacoes (id)
      );',
      'CREATE TABLE IF NOT EXISTS esportes (
        id SERIAL,
        descricao VARCHAR(20) NOT NULL,
        qtd_atletas INTEGER NOT NULL,
        PRIMARY KEY (id)
      );',
      'CREATE TABLE IF NOT EXISTS partidas (
        id SERIAL,
        data date NOT NULL,
        hora_inicio TIME NOT NULL,
        hora_termino TIME NOT NULL,
        valor NUMERIC(15,2) NOT NULL,
        id_esporte INTEGER,
        cnpj VARCHAR(14),
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
      'CREATE TABLE IF NOT EXISTS avaliacao (
        id_partida INTEGER,
        estrelas INTEGER NOT NULL,
        comentario VARCHAR(180),
        avaliador VARCHAR(11),
        avaliado VARCHAR(11),
        PRIMARY KEY(id_partida, avaliador, avaliado),
        CONSTRAINT fk_partida FOREIGN KEY (id_partida) REFERENCES partidas (id),
        CONSTRAINT fk_avaliador FOREIGN KEY (avaliador) REFERENCES atletas (cpf),
        CONSTRAINT fk_avaliado FOREIGN KEY (avaliado) REFERENCES atletas (cpf)
      );'
    ];
  
    foreach ($statements as $statement) {
      self::getConnection()->exec($statement);
    }
  
  }
}

?>