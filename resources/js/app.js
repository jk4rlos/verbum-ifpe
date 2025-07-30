// Scroll suave para âncoras
function handleAnchorClick(event) {
    event.preventDefault();
    const targetId = event.currentTarget.getAttribute('href');
    if (targetId === '#') return;

    const targetElement = document.querySelector(targetId);
    if (targetElement) {
        window.scrollTo({
            top: targetElement.offsetTop - 100, // Ajuste para o header fixo
            behavior: 'smooth'
        });
    }

    // Fechar menu mobile se estiver aberto
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
    }
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', handleAnchorClick);
});

// Fechar menu de resultados da busca ao rolar
function handleScroll() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults && !searchResults.classList.contains('hidden')) {
        searchResults.classList.add('hidden');
    }
}

// Fechar menu de resultados ao clicar fora
document.addEventListener('click', (e) => {
    const searchResults = document.getElementById('searchResults');
    const searchInput = document.querySelector('input[placeholder="Busque sua paróquia..."]');
    
    if (searchResults && !searchResults.contains(e.target) && e.target !== searchInput) {
        searchResults.classList.add('hidden');
    }
});

// Busca de paróquias
function handleSearch(query) {
    const searchResults = document.getElementById('searchResults');
    
    if (query.length > 0) {
        searchResults.classList.remove('hidden');
    } else {
        searchResults.classList.add('hidden');
    }
}

// Inicialização
document.addEventListener('DOMContentLoaded', () => {
    // Fechar menu de resultados ao clicar em um resultado
    const resultItems = document.querySelectorAll('#searchResults a');
    resultItems.forEach(item => {
        item.addEventListener('click', () => {
            const searchResults = document.getElementById('searchResults');
            if (searchResults) {
                searchResults.classList.add('hidden');
            }
        });
    });
});

window.addEventListener('scroll', handleScroll);