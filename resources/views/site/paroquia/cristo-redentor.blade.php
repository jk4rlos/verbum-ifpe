@extends('site.layouts.parish')

@section('title', 'Paróquia Cristo Redentor')

@section('main')
    <!-- Hero Section -->
    <section id="inicio">
        @include('site.components.parish.hero')
    </section>
    
    <!-- About Section -->
    <section id="sobre">
        @include('site.components.parish.about')
    </section>
    
    <!-- Announcements Section -->
    <section id="avisos">
        @include('site.components.parish.announcements')
    </section>
    
    <!-- Schedule Section -->
    <section id="horarios">
        @include('site.components.parish.schedule')
    </section>
    
    <!-- Media Section -->
    <section id="midias">
        @include('site.components.parish.media')
    </section>

    <!-- Offer Section -->
    <section id="ofertas">
        @include('site.components.parish.offer')
    </section>
    
    <!-- Contact Section -->
    <section id="contato">
        @include('site.components.parish.contact')
    </section>
@endsection

@push('scripts')
<script>
    // Scripts específicos da página da paróquia podem ser adicionados aqui
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializações de componentes podem ser feitas aqui
    });
</script>
@endpush
