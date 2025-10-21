<section id="midias" class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50/30 dark:from-gray-900 dark:via-gray-800 dark:to-blue-900/20">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-[#D94052] to-pink-500 mb-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 dark:from-white dark:via-gray-100 dark:to-gray-300 bg-clip-text text-transparent mb-4">
                    Nossas Mídias
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    Acompanhe nossos conteúdos, reflexões e momentos especiais
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-[#D94052] to-pink-500 mx-auto rounded-full"></div>
            </div>

            @php
                $medias = \App\Models\Media::orderBy('created_at', 'desc')->limit(6)->get();
            @endphp

            <!-- Media Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @forelse($medias as $media)
                    @switch($media->type)
                        @case('video_youtube')
                            <!-- YouTube Video Card -->
                            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                                <div class="relative aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600">
                                    @if($media->link_url)
                                        <iframe
                                            class="absolute inset-0 w-full h-full rounded-t-3xl"
                                            src="{{ convertToYouTubeEmbed($media->link_url) }}"
                                            title="{{ $media->title }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                            <span>Link do YouTube não disponível</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                </svg>
                                                Vídeo
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-[#D94052] transition-colors duration-300">
                                        {{ $media->title }}
                                    </h3>
                                    @if($media->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                            {{ Str::limit($media->description, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @break

                        @case('audio_spotify')
                            <!-- Spotify Podcast Card -->
                            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                                <div class="relative aspect-video flex items-center justify-center">
                                    <!-- Player do Spotify no cabeçalho se houver link -->
                                    @if($media->link_url)
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            {!! convertToSpotifyEmbed($media->link_url) !!}
                                        </div>
                                    @else
                                        <!-- Ícone padrão se não houver link -->
                                        <div class="relative z-10">
                                            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white shadow-2xl">
                                                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                                Podcast
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                                        {{ $media->title }}
                                    </h3>
                                    @if($media->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                            {{ Str::limit($media->description, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @break

                        @case('audio_file')
                            <!-- Audio File Card -->
                            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                                <div class="relative aspect-video bg-gradient-to-br from-purple-100 via-indigo-50 to-blue-100 dark:from-purple-900/30 dark:via-indigo-900/20 dark:to-blue-900/30 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-indigo-500/10 dark:from-purple-400/10 dark:to-indigo-400/10"></div>
                                    <div class="relative z-10">
                                        <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-32 h-32 border-2 border-purple-300/30 rounded-full animate-ping"></div>
                                        <div class="absolute w-40 h-40 border border-indigo-300/20 rounded-full animate-ping animation-delay-1000"></div>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                                Áudio
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">
                                        {{ $media->title }}
                                    </h3>
                                    @if($media->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                            {{ Str::limit($media->description, 100) }}
                                        </p>
                                    @endif

                                    @if($media->file_url)
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                                            <audio controls class="w-full h-10">
                                                <source src="{{ asset('storage/' . $media->file_url) }}" type="audio/mpeg">
                                                Seu navegador não suporta o elemento de áudio.
                                            </audio>
                                        </div>
                                    @else
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600 text-center text-gray-500">
                                            Arquivo de áudio não disponível
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @break

                        @case('image')
                            <!-- Image Card -->
                            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                                <div class="relative aspect-[4/3]">
                                    @php
                                        $fileUrls = $media->file_urls;
                                        $isMultiple = count($fileUrls) > 1;
                                        $totalImages = count($fileUrls);
                                    @endphp

                                    @if($fileUrls && $totalImages > 0)
                                        @if($isMultiple)
                                            <!-- Galeria de múltiplas imagens com layout otimizado -->
                                            <div class="grid gap-1 h-full {{ $totalImages === 2 ? 'grid-cols-2' : ($totalImages === 3 ? 'grid-cols-2' : 'grid-cols-2') }}">
                                                @foreach(array_slice($fileUrls, 0, 4) as $index => $fileUrl)
                                                    <div class="relative group/image overflow-hidden">
                                                        <img src="{{ asset('storage/' . $fileUrl) }}"
                                                             alt="{{ $media->title }} - Foto {{ $index + 1 }}"
                                                             class="w-full h-full object-cover transition-transform duration-500 group-hover/image:scale-110">
                                                        @if($index === 3 && $totalImages > 4)
                                                            <!-- Overlay para indicar mais imagens -->
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end justify-center pb-2">
                                                                <span class="text-white font-bold text-sm bg-black/60 px-2 py-1 rounded-full">
                                                                    +{{ $totalImages - 3 }} mais
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Para 3 imagens: layout especial -->
                                            @if($totalImages === 3)
                                                <style>
                                                    .grid-cols-2:nth-child(3) { grid-column: span 2; }
                                                </style>
                                            @endif
                                        @else
                                            <!-- Imagem única com zoom elegante -->
                                            <div class="relative overflow-hidden h-full">
                                                <img src="{{ asset('storage/' . $fileUrls[0]) }}"
                                                     alt="{{ $media->title }}"
                                                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Estado vazio -->
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 flex items-center justify-center text-gray-400">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-sm font-medium">Imagem não disponível</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $isMultiple ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' }}">
                                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $isMultiple ? 'Galeria' : 'Imagem' }}
                                            </span>
                                            @if($isMultiple)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $totalImages }} foto{{ $totalImages > 1 ? 's' : '' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 leading-tight">
                                        {{ $media->title }}
                                    </h3>

                                    @if($media->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed line-clamp-2">
                                            {{ Str::limit($media->description, 120) }}
                                        </p>
                                    @endif

                                    @if($fileUrls && $totalImages > 0)
                                        <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                                            @if($isMultiple)
                                                <!-- Botão para galeria completa -->
                                                <a href="?#"
                                                   class="group/btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>Ver Galeria</span>
                                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            @else
                                                <!-- Botão para imagem individual -->
                                                <a href="/#"
                                                   target="_blank"
                                                   class="group/btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                    <span>Ver Completa</span>
                                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <!-- Indicador de data -->
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $media->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @break

                        @default
                            <!-- Default Card for Unknown Types -->
                            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                                <div class="relative aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                        <p class="text-sm">Tipo de mídia desconhecido</p>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $media->title }}
                                    </h3>
                                    @if($media->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">
                                            {{ Str::limit($media->description, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                    @endswitch
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Nenhuma mídia disponível
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            As mídias aparecerão aqui quando forem adicionadas no painel administrativo.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="bg-gradient-to-r from-gray-100 via-white to-blue-50 dark:from-gray-800 dark:via-gray-700 dark:to-blue-900/20 rounded-3xl p-8 shadow-2xl border border-gray-200/50 dark:border-gray-700/50">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-[#D94052] to-pink-500 mb-4 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Explore Mais Conteúdos
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                        Descubra homilias, podcasts, galerias de fotos e muito mais conteúdo para fortalecer sua jornada espiritual.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 mb-6">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            Vídeos semanais
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                            </svg>
                            Podcasts mensais
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Galerias de eventos
                        </div>
                    </div>
                    <a href="/#"
                       class="group inline-flex items-center justify-center px-8 py-4 border-2 border-transparent text-lg font-semibold rounded-2xl text-white bg-gradient-to-r from-[#D94052] to-pink-600 hover:from-[#C41E3A] hover:to-pink-700 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <span>Explorar Mídias</span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
