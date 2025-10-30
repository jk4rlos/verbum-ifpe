<section id="liturgia" class="py-16 bg-gradient-to-br from-gray-50 via-white to-blue-50/30 dark:from-gray-900 dark:via-gray-800 dark:to-blue-900/20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent mb-4">
                    Leituras do Dia
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    {{ $liturgiaData['liturgia'] ?? 'A Palavra de Deus para o nosso dia' }}
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-emerald-500 to-teal-600 mx-auto rounded-full"></div>
            </div>

            @if(isset($liturgiaError))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8 rounded-lg shadow-md max-w-3xl mx-auto" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p>{{ $liturgiaError }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 p-8">
                <!-- Cabeçalho com data e cor litúrgica -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-6 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 dark:text-emerald-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $liturgiaData['data'] ?? 'Data não disponível' }}</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $liturgiaData['liturgia'] ?? 'Leituras do Dia' }}</h3>
                    </div>
                    <div class="px-4 py-2 rounded-full bg-gradient-to-r from-emerald-500/10 to-teal-600/10 text-emerald-700 dark:text-emerald-400 text-sm font-medium flex items-center">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>
                        {{ $liturgiaData['cor'] ?? 'Verde' }} Litúrgico
                    </div>
                </div>

                <!-- Seção de Leituras -->
                @if(isset($liturgiaData['leituras']))
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center mr-3 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.477 5.754 19 7.5 19s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Leituras do Dia</h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            @php
                                $leituras = [
                                    'primeiraLeitura' => ['title' => 'Primeira Leitura', 'icon' => '1', 'color' => 'from-blue-500 to-indigo-600'],
                                    'segundaLeitura' => ['title' => 'Segunda Leitura', 'icon' => '2', 'color' => 'from-purple-500 to-pink-600'],
                                    'salmo' => ['title' => 'Salmo Responsorial', 'icon' => '♪', 'color' => 'from-amber-500 to-orange-500'],
                                    'evangelho' => ['title' => 'Evangelho', 'icon' => '✝', 'color' => 'from-red-500 to-pink-600']
                                ];
                            @endphp

                            @foreach ($leituras as $tipo => $info)
                                @if(!empty($liturgiaData['leituras'][$tipo]))
                                    @foreach ($liturgiaData['leituras'][$tipo] as $leitura)
                                        <div class="bg-gradient-to-br {{ $info['color'] }} text-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                                            <div class="p-1 bg-black/20">
                                                <div class="flex items-center px-5 py-3">
                                                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm mr-3">
                                                        {{ $info['icon'] }}
                                                    </div>
                                                    <h4 class="text-lg font-bold">{{ $info['title'] }}</h4>
                                                </div>
                                            </div>
                                            <div class="p-5 bg-white/5 backdrop-blur-sm">
                                                <div class="mb-3">
                                                    <p class="text-sm font-medium text-white/80">{{ $leitura['referencia'] ?? '' }}</p>
                                                    <h5 class="text-xl font-bold text-white mt-1">{{ $leitura['titulo'] ?? '' }}</h5>
                                                </div>
                                                <div class="prose prose-sm prose-invert max-w-none">
                                                    <p class="text-white/90 leading-relaxed">{{ $leitura['texto'] ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Antífonas -->
                @if(isset($liturgiaData['antifonas']))
                    <div class="mt-10 pt-8 border-t border-gray-200/50 dark:border-gray-700/50">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                            Antífonas
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            @if(!empty($liturgiaData['antifonas']['entrada']))
                                <div class="bg-emerald-50/50 dark:bg-emerald-900/10 p-4 rounded-lg border-l-4 border-emerald-400">
                                    <h5 class="font-semibold text-emerald-900 dark:text-emerald-200">Antífona de Entrada</h5>
                                    <p class="text-emerald-800/80 dark:text-emerald-300 text-sm mt-1 italic">"{{ $liturgiaData['antifonas']['entrada'] }}"</p>
                                </div>
                            @endif
                            
                            @if(!empty($liturgiaData['antifonas']['comunhao']))
                                <div class="bg-teal-50/50 dark:bg-teal-900/10 p-4 rounded-lg border-l-4 border-teal-400">
                                    <h5 class="font-semibold text-teal-900 dark:text-teal-200">Antífona da Comunhão</h5>
                                    <p class="text-teal-800/80 dark:text-teal-300 text-sm mt-1 italic">"{{ $liturgiaData['antifonas']['comunhao'] }}"</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Rodapé com informações adicionais -->
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>Leituras do Dia - {{ $liturgiaData['data'] ?? date('d/m/Y') }} | Cor Litúrgica: {{ $liturgiaData['cor'] ?? 'Verde' }}</p>
                <p class="mt-1">Fonte: CNBB - Conferência Nacional dos Bispos do Brasil</p>
            </div>
        </div>
    </div>
</section>
