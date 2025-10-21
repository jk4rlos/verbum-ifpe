<section id="avisos" class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Avisos Paroquiais</h2>
                <p class="text-gray-600 dark:text-gray-300">Fique por dentro das novidades e eventos da nossa paróquia</p>
                <div class="w-24 h-1 bg-[#D94052] mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (\App\Models\WeeklyWarning::orderBy('startDate', 'asc')->get() as $aviso)
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-2 rounded-lg bg-[#D94052]/10 text-[#D94052] mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($aviso->startDate)->translatedFormat('d \d\e F, Y') }}</span>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $aviso->title }}</h3>
                                </div>
                            </div>

                            @if($aviso->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $aviso->image) }}" alt="{{ $aviso->title }}" class="w-full h-48 object-cover rounded-lg">
                                </div>
                            @endif

                            <p class="text-gray-600 dark:text-gray-300 text-sm">
                                {!! $aviso->content !!}
                            </p>

                            @if($aviso->link)
                                <a href="{{ $aviso->link }}" class="mt-4 inline-flex items-center text-[#D94052] hover:text-[#C41E3A] text-sm font-medium" target="_blank" rel="noopener">
                                    Saiba mais
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#D94052] hover:bg-[#C41E3A] transition-colors duration-200">
                    Ver todos os avisos
                </a>
            </div>
        </div>
    </div>
</section>
