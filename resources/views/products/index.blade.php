@extends('layouts.app')

@section('title', 'Tutti i Prodotti')
@section('meta_description', 'Esplora tutta la nostra collezione di gioielli artigianali fatti a mano.')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Tutti i Prodotti</h1>
            <p class="text-lg text-content-light max-w-2xl mx-auto">
                Esplora tutta la nostra collezione di gioielli artigianali.
            </p>
        </div>
    </section>

    {{-- Products Section --}}
    <section class="section">
        <div class="container-elegant">
            {{-- Results Count --}}
            <div class="mb-8">
                <p class="text-content-light">
                    <span class="font-semibold text-content">{{ $products->total() }}</span>
                    prodotti disponibili
                </p>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    @include('components.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-content-subtle mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="font-heading text-xl text-content-muted mb-2">Nessun Prodotto</h3>
                        <p class="text-content-subtle">La collezione è in arrivo. Torna presto!</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
