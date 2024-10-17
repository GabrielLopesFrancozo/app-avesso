var winSize = document.getElementById("win-size");
var sidebarLink = document.getElementById("sidebar-link");

// Função para mostrar o tamanho atual da tela
function updateScreenSize() {
    winSize.innerHTML = window.innerWidth + " x " + window.innerHeight;
}

// Função para mostrar ou ocultar o bottom-navbar
function toggleBottomNavbar() {
    if (window.innerWidth > 768) {
        hideElement(document.getElementById('bottom-navbar'));
        showElement(document.getElementById('sidebar'));
    }
    else {
        showElement(document.getElementById('bottom-navbar'));
        hideElement(document.getElementById('sidebar'));
    }
}

function hideElement(element) {
    element.style.display = 'none';
}

function showElement(element) { 
    element.style.display = 'flex';
}

// Inicia o tamanho inicial da tela
updateScreenSize();

// Inicia o toggle do bottom-navbar
toggleBottomNavbar();

// Adiciona o evento de resize
window.addEventListener('resize', updateScreenSize);
window.addEventListener('resize', toggleBottomNavbar);
sidebarLink.addEventListener('click', toggleBottomNavbar);