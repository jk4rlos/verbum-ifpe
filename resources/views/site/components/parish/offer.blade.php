<section id="ofertas" class="py-20 bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-gray-900 dark:via-gray-800 dark:to-green-900/20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent mb-4">
                    Ofertas e Contribuições
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    Sua generosidade fortalece nossa missão
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-green-500 to-emerald-600 mx-auto rounded-full"></div>
            </div>

            @php
                $ofertas = \App\Models\Offer::all();
            @endphp

            @if($ofertas->count() > 0)
                <div class="justify-center mb-16">
                    @foreach($ofertas as $oferta)
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 group">
                            <div class="p-8">
                                <div class="flex items-center mb-6">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                                            {{ $oferta->title }}
                                        </h3>
                                        @if($oferta->bank)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $oferta->bank }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if($oferta->pix)
                                    <div class="mb-6">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Chave PIX</span>
                                        </div>
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border-l-4 border-green-500">
                                            <p class="text-sm font-mono text-gray-800 dark:text-gray-200 break-all">{{ $oferta->pix }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($oferta->qrcode)
                                    <div class="mb-6">
                                        <div class="flex items-center mb-3">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12H8.99M12 12v4.01M12 12V8.99" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">QR Code PIX</span>
                                        </div>
                                        <div class="bg-white dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600 flex justify-center">
                                            <img src="{{ asset('storage/' . $oferta->qrcode) }}"
                                                 alt="QR Code PIX - {{ $oferta->title }}"
                                                 class="max-w-full h-32 object-contain shadow-sm">
                                        </div>
                                    </div>
                                @endif

                                @if($oferta->description)
                                    <div class="mb-6">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                                                {!! $oferta->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex justify-center">
                                    <button onclick="copyToClipboard('{{ $oferta->pix }}')"
                                            class="group/btn inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2 group-hover/btn:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span>Copiar Chave PIX</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-3xl p-8 shadow-lg border border-green-200/50 dark:border-green-800/50">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            Como sua contribuição faz a diferença
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                            Cada contribuição nos ajuda a manter nossa missão de servir à comunidade,
                            apoiar os necessitados e manter nossa igreja vibrante e acolhedora.
                        </p>
                        <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Manutenção da igreja
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Ações sociais
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Eventos comunitários
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Nenhuma opção de oferta disponível
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        As opções de contribuição estarão disponíveis em breve.
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        notification.textContent = 'Chave PIX copiada!';
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 2000);
    }).catch(function(err) {
        console.error('Erro ao copiar: ', err);
        alert('Erro ao copiar chave PIX. Tente novamente.');
    });
}
</script>