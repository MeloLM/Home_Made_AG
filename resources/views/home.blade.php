@extends('layouts.app')

@section('title', 'Dettagli Boutique - Gioielli Artigianali')
@section('meta_description', 'Dettagli Boutique - Scopri la nostra collezione di gioielli artigianali fatti a mano. Rosari, braccialetti e collane per Battesimo, Comunione, Matrimonio e ogni occasione speciale.')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-elegant overflow-hidden">
        <div class="container-elegant py-20 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="font-display text-display-xl text-content mb-6 text-balance">
                        Gioielli Unici per Momenti Speciali
                    </h1>
                    <p class="text-xl text-content-light mb-8 max-w-lg mx-auto lg:mx-0">
                        Creazioni artigianali fatte a mano con amore e passione.
                        Ogni pezzo racconta una storia unica, perfetto per celebrare
                        i momenti più importanti della tua vita.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('events.index') }}" class="btn-primary">
                            Scopri per Evento
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('products.index') }}" class="btn-secondary">
                            Tutti i Prodotti
                        </a>
                    </div>
                </div>
                <div class="relative">
                    {{-- Placeholder per immagine hero --}}
                    <div class="aspect-square bg-secondary-200/50 rounded-full max-w-md mx-auto flex items-center justify-center">
                        <div class="text-center p-8">
                            <svg class="w-24 h-24 text-secondary-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            <p class="text-content-muted">Immagine Hero</p>
                        </div>
                    </div>
                    {{-- Elementi decorativi --}}
                    <div class="absolute top-10 right-10 w-20 h-20 bg-secondary-300/30 rounded-full blur-xl"></div>
                    <div class="absolute bottom-10 left-10 w-32 h-32 bg-secondary-400/20 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Shop by Event Section --}}
    <section class="section bg-white">
        <div class="container-elegant">
            <h2 class="section-title">Shop per Evento</h2>
            <p class="section-subtitle">
                Trova il gioiello perfetto per ogni occasione speciale della tua vita.
                Dalle cerimonie religiose ai momenti di festa.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($events as $event)
                    <a href="{{ route('events.show', $event->slug) }}" class="card-event group">
                        <div class="aspect-event bg-primary-300 relative overflow-hidden">
                            @if($event->image)
                                <img
                                    src="{{ asset('storage/' . $event->image) }}"
                                    alt="{{ $event->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-accent">
                                    <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="card-event-overlay">
                                <div class="text-center">
                                    <h3 class="card-event-title">{{ $event->name }}</h3>
                                    @if(isset($event->products_count))
                                        <p class="text-white/80 text-sm mt-1">{{ $event->products_count }} prodotti</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-content-muted">Nessun evento disponibile al momento.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('events.index') }}" class="btn-secondary">
                    Vedi Tutti gli Eventi
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section class="section">
        <div class="container-elegant">
            <h2 class="section-title">I Nostri Preferiti</h2>
            <p class="section-subtitle">
                Una selezione dei nostri gioielli più amati,
                scelti con cura per te.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-content-muted">Nessun prodotto in evidenza al momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Why Handmade Section --}}
    <section class="section bg-white">
        <div class="container-elegant">
            <h2 class="section-title">Perché Artigianale</h2>
            <p class="section-subtitle">
                Ogni gioiello è realizzato a mano con passione e attenzione ai dettagli.
            </p>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Fatto con Amore</h3>
                    <p class="text-content-light">
                        Ogni pezzo è creato con dedizione e passione,
                        rendendo ogni gioiello unico e speciale.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Qualità Artigianale</h3>
                    <p class="text-content-light">
                        Materiali selezionati con cura e lavorazione
                        meticolosa per garantire durabilità e bellezza.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Regalo Perfetto</h3>
                    <p class="text-content-light">
                        Confezionamento elegante incluso,
                        perfetto per ogni occasione speciale.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest Products Section --}}
    @if($latestProducts->count() > 0)
        <section class="section">
            <div class="container-elegant">
                <h2 class="section-title">Nuovi Arrivi</h2>
                <p class="section-subtitle">
                    Le ultime creazioni aggiunte alla nostra collezione.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($latestProducts as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Newsletter Section --}}
    <section class="section bg-secondary-200">
        <div class="container-elegant max-w-2xl text-center">
            <h2 class="font-heading text-3xl font-semibold text-content mb-4">Resta Aggiornato</h2>
            <p class="text-content-light mb-6">
                Iscriviti alla newsletter per ricevere novità, offerte esclusive
                e ispirazioni per i tuoi momenti speciali.
            </p>
            <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                @csrf
                <input
                    type="email"
                    name="email"
                    placeholder="La tua email"
                    required
                    class="form-input flex-1"
                >
                <button type="submit" class="btn-primary whitespace-nowrap">
                    Iscriviti
                </button>
            </form>
            <p class="text-sm text-content-muted mt-3">
                Rispettiamo la tua privacy. Niente spam, promesso.
            </p>
        </div>
    </section>
@endsection
