var optionsMenu = document.getElementById('options-menu');
optionsMenu.addEventListener('click', dropdownAction);

function dropdownAction() {
    var dropdownContent = document.getElementsByClassName("dropdown-content")[0];

    if (dropdownContent.classList.contains('active')) {
        dropdownContent.classList.remove('active');
    } else {
        dropdownContent.classList.toggle('active');
    }
}