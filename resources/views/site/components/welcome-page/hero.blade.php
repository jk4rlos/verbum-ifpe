<div class="relative isolate overflow-hidden bg-gradient-to-b from-[#D94052]/10 to-transparent dark:from-[#D94052]/5 pt-24 pb-16 sm:pt-32 lg:pb-24">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute left-16 top-0 h-[40rem] w-[40rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-r from-[#D94052]/20 to-[#EE7E4C]/20 opacity-20 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 -translate-y-1/2 translate-x-1/2 rounded-full bg-[#EAD56C]/20 opacity-30 blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <div class="inline-flex items-center rounded-full bg-[#D94052]/10 px-4 py-2 text-sm font-medium text-[#D94052] ring-1 ring-inset ring-[#D94052]/30 mb-6">
                <span class="relative flex h-2 w-2 mr-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#D94052] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#D94052]"></span>
                </span>
                A solução completa para sua paróquia
            </div>

            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                <span class="bg-clip-text text-transparent bg-[#D94052]">
                    Gestão Paroquial Completa
                </span>
            </h1>

            <p class="mt-6 text-xl leading-8 text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Modernize a gestão da sua paróquia com ferramentas poderosas e fáceis de usar.
                Conecte-se com sua comunidade como nunca antes.
            </p>

            <div class="mt-10 max-w-2xl mx-auto">
                <div class="relative">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            type="text"
                            id="parishSearch"
                            placeholder="Busque sua paróquia..."
                            class="block w-full pl-12 pr-6 py-4 text-base bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg focus:ring-2 focus:ring-[#D94052] focus:border-transparent transition-all duration-200"
                            oninput="handleSearch(this.value)"
                            autocomplete="off"
                        >
                    </div>

                    <div id="searchResults" class="absolute z-10 w-full mt-2 bg-white/90 dark:bg-gray-900/95 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hidden transition-all duration-200">
                        <a href="/paroquia/cristo-redentor" class="block">
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150 border-b border-gray-100 dark:border-gray-800">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-[#D94052] to-[#EE7E4C] flex items-center justify-center text-white font-bold">
                                        CR
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Paróquia Cristo Redentor</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Rua Exemplo, 123 - Centro</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Não encontrou sua paróquia? <a href="#" class="text-[#D94052] hover:underline">Cadastre-a aqui</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 flex items-center justify-center gap-x-6 gap-y-4 flex-wrap">
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    100 paróquias atendidas
                </div>
                <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Suporte 24/7
                </div>
                <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Teste grátis por 30 dias
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleSearch(value) {
    const results = document.getElementById('searchResults');
    if (value.trim() === '') {
        results.classList.add('hidden');
        return;
    }
    results.classList.remove('hidden');
}

document.addEventListener('click', function(event) {
    const searchResults = document.getElementById('searchResults');
    const searchInput = document.querySelector('input[type="text"]');

    if (!searchResults.contains(event.target) && event.target !== searchInput) {
        searchResults.classList.add('hidden');
    }
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
#searchResults {
    animation: fadeIn 0.2s ease-out;
}
@supports (backdrop-filter: blur(10px)) {
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
}
@keyframes fadeLogo {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fade-in {
    animation: fadeLogo 0.6s ease-out forwards;
}
</style>
