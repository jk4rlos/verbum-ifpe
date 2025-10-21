<?php

if (!function_exists('convertToYouTubeEmbed')) {
    /**
     * Converte uma URL do YouTube para o formato de embed
     *
     * @param string|null $url
     * @return string|null
     */
    function convertToYouTubeEmbed(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // Padrões de URL do YouTube
        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
            '/youtu\.be\/([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];
                return "https://www.youtube.com/embed/{$videoId}";
            }
        }

        // Se já for uma URL de embed, retorna como está
        if (preg_match('/youtube\.com\/embed\//', $url)) {
            return $url;
        }

        return null;
    }
}

if (!function_exists('convertToSpotifyEmbed')) {
    /**
     * Converte uma URL do Spotify para o formato de embed usando a API oEmbed oficial
     *
     * @param string|null $url
     * @return string|null
     */
    function convertToSpotifyEmbed(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // Padrões de URL do Spotify
        $patterns = [
            '/open\.spotify\.com\/track\/([a-zA-Z0-9]+)/',
            '/open\.spotify\.com\/episode\/([a-zA-Z0-9]+)/',
            '/open\.spotify\.com\/album\/([a-zA-Z0-9]+)/',
            '/open\.spotify\.com\/playlist\/([a-zA-Z0-9]+)/',
            '/open\.spotify\.com\/show\/([a-zA-Z0-9]+)/',
            '/spotify\.com\/track\/([a-zA-Z0-9]+)/',
            '/spotify\.com\/episode\/([a-zA-Z0-9]+)/',
            '/spotify\.com\/album\/([a-zA-Z0-9]+)/',
            '/spotify\.com\/playlist\/([a-zA-Z0-9]+)/',
            '/spotify\.com\/show\/([a-zA-Z0-9]+)/',
        ];

        $spotifyId = null;
        $type = null;

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $spotifyId = $matches[1];
                $type = str_replace(['open.spotify.com/', 'spotify.com/'], '', $matches[0]);
                $type = explode('/', $type)[0]; // Pega apenas o tipo (track, episode, etc.)
                break;
            }
        }

        if (!$spotifyId || !$type) {
            return null;
        }

        // Usar a API oEmbed oficial do Spotify
        $oembedUrl = "https://open.spotify.com/oembed";

        try {
            // Fazer requisição para a API oEmbed do Spotify
            $response = file_get_contents("{$oembedUrl}?url=" . urlencode($url) . "&maxwidth=300&maxheight=80");

            if ($response) {
                $data = json_decode($response, true);

                if (isset($data['html'])) {
                    // Retorna o HTML oficial do Spotify
                    return $data['html'];
                }
            }
        } catch (\Exception $e) {
            // Em caso de erro, loga e continua com método alternativo
            \Log::warning('Erro ao usar API oEmbed do Spotify: ' . $e->getMessage());
        }

        // Método alternativo caso a API oEmbed falhe
        return "https://open.spotify.com/embed/{$type}/{$spotifyId}";
    }
}
