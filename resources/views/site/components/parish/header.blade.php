<header class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm">
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                    <img src="../../images/icon.png" alt="Verbum" class="h-10 w-10 object-contain">
                    <span class="text-xl font-bold text-[#D94052] dark:text-white">Verbum</span>
                </a>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="#inicio" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Início</a>
                <a href="#sobre" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Sobre Nós</a>
                <a href="#avisos" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Avisos</a>
                <a href="#horarios" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Horários</a>
                <a href="#midias" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Mídias</a>
                <a href="#contato" class="text-gray-900 dark:text-white hover:text-[#D94052] px-3 py-2 rounded-md text-sm font-medium scroll-smooth">Contato</a>
            </div>

            <div class="hidden md:block">
                <a href="#contato" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#D94052] hover:bg-[#C41E3A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D94052] transition-colors duration-200">
                    Fale Conosco
                </a>
            </div>

            <div class="md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white" aria-expanded="false">
                    <span class="sr-only">Abrir menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div class="md:hidden hidden mobile-menu bg-white dark:bg-gray-800 shadow-lg rounded-b-lg">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#inicio" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Início</a>
            <a href="#sobre" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Sobre Nós</a>
            <a href="#avisos" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Avisos</a>
            <a href="#horarios" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Horários</a>
            <a href="#midias" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Mídias</a>
            <a href="#contato" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 dark:text-white hover:text-[#D94052] scroll-smooth">Contato</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700 px-4">
            <a href="#contato" class="block w-full px-3 py-2 text-base font-medium text-white bg-[#D94052] hover:bg-[#C41E3A] rounded-md text-center transition-colors duration-200">Fale Conosco</a>
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                
                const menuLinks = mobileMenu.querySelectorAll('a');
                menuLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            });
        }

        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && event.target !== mobileMenuButton) {
                mobileMenu.classList.add('hidden');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endpush
