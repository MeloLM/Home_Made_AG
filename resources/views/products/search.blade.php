@extends('layouts.app')

@section('title', 'Ricerca: ' . $query)
@section('meta_description', 'Risultati della ricerca per: ' . $query)

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Risultati della Ricerca</h1>
            @if($query)
                <p class="text-lg text-content-light">
                    Risultati per: <span class="font-semibold text-content">"{{ $query }}"</span>
                </p>
            @endif
        </div>
    </section>

    {{-- Search Results --}}
    <section class="section">
        <div class="container-elegant">
            {{-- Search Form --}}
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('products.search') }}" method="GET" class="flex gap-3">
                    <input
                        type="search"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Cerca gioielli, rosari, braccialetti..."
                        class="form-input flex-1"
                    >
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cerca
                    </button>
                </form>
            </div>

            {{-- Results Count --}}
            <div class="mb-8">
                <p class="text-content-light">
                    <span class="font-semibold text-content">{{ $products->total() }}</span>
                    risultati trovati
                </p>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    @include('components.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-content-subtle mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="font-heading text-xl text-content-muted mb-2">Nessun Risultato</h3>
                        <p class="text-content-subtle mb-4">
                            Non abbiamo trovato prodotti per "{{ $query }}".
                        </p>
                        <div class="space-y-2">
                            <p class="text-content-muted text-sm">Prova a:</p>
                            <ul class="text-content-light text-sm">
                                <li>Usare parole diverse o più generiche</li>
                                <li>Controllare l'ortografia</li>
                                <li>Esplorare le nostre categorie per evento</li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('events.index') }}" class="btn-primary">
                                Esplora per Evento
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
