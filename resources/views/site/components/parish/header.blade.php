<header class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 shadow-sm">
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                    <img src="../../images/icon.png" alt="Verbum" class="h-10 w-10 object-contain">
                    <span class="text-xl font-bold text-[#D94052] dark:text-white">Verbum</span>
                </a>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('welcome') }}" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Sobre Nós</a>
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Horários</a>
                <a href="#midias" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Mídias</a>
                <a href="#liturgia" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Liturgia</a>
                <a href="#ofertas" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Ofertas</a>
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Contato</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#D94052] hover:bg-[#EE7E4C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D94052]">
                    Entrar em contato
                </a>
            </div>

            <div class="md:hidden">
                <button id="menu-toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>

<!-- Menu Mobile -->
<div class="hidden md:hidden fixed inset-0 z-50 mt-16 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 ease-in-out" id="mobile-menu" style="overflow-y: auto;">
    <div class="px-6 py-4 space-y-3">
        <a href="{{ route('welcome') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Home</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Sobre Nós</a>
        <a href="#horarios" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Horários</a>
        <a href="#midias" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Mídias</a>
        <a href="#liturgia" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Liturgia</a>
        <a href="#ofertas" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Ofertas</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Contato</a>
        <hr class="border-gray-200 dark:border-gray-700">
        <a href="#" class="block w-full px-3 py-3 mt-2 text-base font-medium text-white bg-[#D94052] hover:bg-[#EE7E4C] rounded-md text-center">Entrar em contato</a>
    </div>
</div>

<!-- Overlay para fechar o menu ao clicar fora -->
<div id="menu-overlay" class="hidden fixed inset-0 z-40 bg-black bg-opacity-50 transition-opacity duration-300"></div>

<script>
    function initMobileMenu() {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOverlay = document.getElementById('menu-overlay');

        if (menuToggle && mobileMenu && menuOverlay) {
            function toggleMenu() {
                const isOpen = !mobileMenu.classList.contains('hidden');
                
                if (isOpen) {
                    mobileMenu.classList.add('hidden');
                    menuOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                } else {
                    mobileMenu.classList.remove('hidden');
                    menuOverlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            menuToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                toggleMenu();
            });

            menuOverlay.addEventListener('click', () => {
                toggleMenu();
            });

            const menuLinks = mobileMenu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    if (link.getAttribute('href').startsWith('#')) {
                        const targetId = link.getAttribute('href');
                        if (targetId !== '#') {
                            e.preventDefault();
                            const targetElement = document.querySelector(targetId);
                            if (targetElement) {
                                targetElement.scrollIntoView({ behavior: 'smooth' });
                            }
                        }
                    }
                    setTimeout(() => {
                        toggleMenu();
                    }, 300);
                });
            });

            function handleResize() {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.add('hidden');
                    menuOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            }

            window.addEventListener('resize', handleResize);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }
</script>
