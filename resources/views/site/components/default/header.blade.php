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
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Soluções</a>
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Preços</a>
                <a href="#" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium">Contato</a>
            </div>

            <!-- Botões Desktop -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-sm font-medium text-[#D94052] hover:text-[#EE7E4C]">Entrar</a>
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#D94052] hover:bg-[#EE7E4C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D94052]">
                    Começar Agora
                </a>
            </div>

            <!-- Botão Mobile -->
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
<div class="hidden md:hidden bg-white dark:bg-gray-800 shadow-md" id="mobile-menu">
    <div class="px-4 pt-4 pb-3 space-y-2">
        <a href="{{ route('welcome') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Home</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Soluções</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Preços</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Contato</a>
        <hr class="border-gray-200 dark:border-gray-700">
        <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052]">Entrar</a>
        <a href="#" class="block w-full px-3 py-2 text-base font-medium text-white bg-[#D94052] hover:bg-[#EE7E4C] rounded-md text-center">Começar Agora</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden'); // Mostra/oculta menu
        });
    });
</script>
