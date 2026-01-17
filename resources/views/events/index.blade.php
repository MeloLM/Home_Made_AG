@extends('layouts.app')

@section('title', 'Shop per Evento')
@section('meta_description', 'Esplora i nostri gioielli artigianali organizzati per evento: Battesimo, Comunione, Cresima, Matrimonio e altro.')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Shop per Evento</h1>
            <p class="text-lg text-content-light max-w-2xl mx-auto">
                Trova il gioiello perfetto per ogni occasione speciale.
                Sfoglia le nostre collezioni organizzate per evento.
            </p>
        </div>
    </section>

    {{-- Events Grid --}}
    <section class="section">
        <div class="container-elegant">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($events as $event)
                    <a href="{{ route('events.show', $event->slug) }}" class="card-event group">
                        <div class="aspect-video bg-primary-300 relative overflow-hidden">
                            @if($event->image)
                                <img
                                    src="{{ asset('storage/' . $event->image) }}"
                                    alt="{{ $event->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-accent">
                                    <svg class="w-20 h-20 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="card-event-overlay">
                                <div class="text-center">
                                    <h2 class="card-event-title">{{ $event->name }}</h2>
                                    @if(isset($event->products_count))
                                        <p class="text-white/80 mt-1">{{ $event->products_count }} prodotti</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($event->description)
                            <div class="p-4 bg-white">
                                <p class="text-content-light line-clamp-2">{{ $event->description }}</p>
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-content-subtle mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="font-heading text-xl text-content-muted mb-2">Nessun Evento Disponibile</h3>
                        <p class="text-content-subtle">Stiamo preparando nuove collezioni. Torna a trovarci presto!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
