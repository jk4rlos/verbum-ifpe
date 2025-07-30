<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME', 'Verbum - Gestão Paroquial') }} - @yield('title')</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        @font-face {
            font-family: 'Momcake Bold';
            src: url('fonts/momcake-bold.otf');
        }

        @font-face {
            font-family: 'Momcake Thin';
            src: url('fonts/momcake-thin.otf');
        }

        @font-face {
            font-family: 'NeulisAlt Regular';
            src: url('fonts/neulisalt-regular.ttf');
        }

        /* Estilo para links ativos no menu */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #D94052;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 70%;
        }

        /* Suporte para scroll suave */
        html {
            scroll-behavior: smooth;
        }

        /* Ajuste para o header fixo */
        section {
            scroll-margin-top: 5rem;
        }
    </style>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body class="antialiased dark:bg-black dark:text-white/50">
    @include('site.components.parish.header')

    <main class="pt-16">
        @yield('main')
    </main>

    @include('site.components.default.footer')

    @stack('scripts')
</body>

</html>
