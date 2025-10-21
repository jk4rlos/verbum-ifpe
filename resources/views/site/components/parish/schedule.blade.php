<section id="horarios" class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50/30 dark:from-gray-900 dark:via-gray-800 dark:to-blue-900/20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-[#D94052] to-pink-500 mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent mb-4">
                    Horários de Missas
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    Participe das nossas celebrações e fortaleça sua fé
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-[#D94052] to-pink-500 mx-auto rounded-full"></div>
            </div>

            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500">
                <div class="grid md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-200/50 dark:divide-gray-700/50">

                    @foreach(\App\Models\Mass::orderByRaw("FIELD(dayweek, 'Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado')")
                        ->orderBy('time', 'asc')
                        ->get()
                        ->groupBy('dayweek') as $dia => $missas)

                        <div class="group p-8 hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-all duration-300">
                            <div class="flex items-center mb-8">
                                <div class="relative">
                                    <div class="p-4 rounded-2xl shadow-lg
                                        @if($dia === 'Domingo') bg-gradient-to-br from-[#D94052] to-red-500 text-white shadow-red-200
                                        @else bg-gradient-to-br from-blue-500 to-indigo-500 text-white shadow-blue-200
                                        @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    @if($dia === 'Domingo')
                                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full animate-pulse"></div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-[#D94052] transition-colors duration-300">{{ $dia }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $missas->count() }} celebrações</p>
                                </div>
                            </div>

                            <ul class="space-y-3">
                                @foreach($missas as $missa)
                                    <li class="group/item flex justify-between items-center p-4 rounded-xl bg-gray-50/50 dark:bg-gray-700/20 hover:bg-white dark:hover:bg-gray-700/50 border border-transparent hover:border-gray-200 dark:hover:border-gray-600 transition-all duration-300">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <span class="inline-block w-3 h-3 rounded-full shadow-sm
                                                    @if($dia === 'Domingo') bg-gradient-to-r from-[#D94052] to-red-500
                                                    @else bg-gradient-to-r from-blue-500 to-indigo-500
                                                    @endif"></span>
                                                <span class="absolute inset-0 w-3 h-3 rounded-full animate-ping opacity-20
                                                    @if($dia === 'Domingo') bg-[#D94052]
                                                    @else bg-blue-500
                                                    @endif"></span>
                                            </div>
                                            <span class="ml-4 text-gray-700 dark:text-gray-300 group-hover/item:text-gray-900 dark:group-hover/item:text-white transition-colors duration-300">
                                                {{ $missa->description ?? 'Santa Missa' }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center justify-center w-16 h-8 rounded-full font-bold text-sm
                                                @if($dia === 'Domingo') bg-[#D94052]/10 text-[#D94052]
                                                @else bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                                                @endif">
                                                {{ \Carbon\Carbon::parse($missa->time)->format('H:i') }}h
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    @endforeach
                </div>

                <div class="bg-gradient-to-r from-amber-50/80 to-orange-50/80 dark:from-amber-900/20 dark:to-orange-900/20 border-t border-amber-200/50 dark:border-amber-800/50 p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 flex items-center justify-center shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-amber-800 dark:text-amber-200 mb-2">Atenção Especial</h3>
                            <div class="text-amber-700 dark:text-amber-300 leading-relaxed">
                                <p class="mb-2">📿 Nas primeiras sextas-feiras do mês, a missa da noite será seguida de adoração ao Santíssimo Sacramento.</p>
                                <p class="text-sm opacity-90">✨ Venha participar deste momento especial de contemplação e oração.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $confissoes = \App\Models\Confession::orderByRaw("FIELD(dayweek, 'Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado')")
                    ->orderBy('time', 'asc')
                    ->get();
            @endphp

            @if($confissoes->count())
                <div class="mt-16 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-indigo-900/20 dark:via-gray-800 dark:to-purple-900/20 rounded-3xl p-10 shadow-2xl border border-indigo-100/50 dark:border-indigo-800/50">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                        <div class="flex items-center flex-1">
                            <div class="relative">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full animate-pulse"></div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-3">
                                    Sacramento da Confissão
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    @foreach($confissoes as $confissao)
                                        <div class="flex items-center p-3 rounded-lg bg-white/60 dark:bg-gray-700/30 border border-gray-200/50 dark:border-gray-600/50">
                                            <div class="w-2 h-2 rounded-full bg-indigo-500 mr-3"></div>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ $confissao->dayweek }}</span> •
                                                {{ \Carbon\Carbon::parse($confissao->time)->format('H:i') }}h
                                                @if($confissao->end_time)
                                                    - {{ \Carbon\Carbon::parse($confissao->end_time)->format('H:i') }}h
                                                @endif
                                                @if($confissao->description)
                                                    <span class="text-gray-500 dark:text-gray-400 ml-1">{!! $confissao->description !!}</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-shrink-0">
                            <a href="#" class="group inline-flex items-center justify-center px-8 py-4 border-2 border-transparent text-lg font-semibold rounded-2xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                                <span>Agendar Confissão</span>
                                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>