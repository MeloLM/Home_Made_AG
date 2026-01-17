@extends('layouts.app')

@section('title', $event->meta_title ?? $event->name)
@section('meta_description', $event->meta_description ?? $event->description)

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-elegant py-12 lg:py-16">
        <div class="container-elegant">
            {{-- Breadcrumb --}}
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-content-muted hover:text-content transition-colors">
                            Home
                        </a>
                    </li>
                    <li class="text-content-subtle">/</li>
                    <li>
                        <a href="{{ route('events.index') }}" class="text-content-muted hover:text-content transition-colors">
                            Eventi
                        </a>
                    </li>
                    <li class="text-content-subtle">/</li>
                    <li class="text-content font-medium">{{ $event->name }}</li>
                </ol>
            </nav>

            <div class="text-center max-w-3xl mx-auto">
                <h1 class="font-display text-display-lg text-content mb-4">{{ $event->name }}</h1>
                @if($event->description)
                    <p class="text-lg text-content-light">{{ $event->description }}</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section class="section">
        <div class="container-elegant">
            {{-- Filters & Sort Bar --}}
            <div
                x-data="{ filtersOpen: false }"
                class="mb-8"
            >
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    {{-- Results Count --}}
                    <p class="text-content-light">
                        <span class="font-semibold text-content">{{ $products->total() }}</span>
                        prodotti trovati
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        {{-- Mobile Filter Toggle --}}
                        <button
                            @click="filtersOpen = !filtersOpen"
                            class="lg:hidden btn-ghost flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filtri
                        </button>

                        {{-- Sort Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open"
                                class="flex items-center gap-2 px-4 py-2 bg-white border border-primary-400 rounded-elegant hover:border-secondary-400 transition-colors"
                            >
                                <span class="text-content-light">Ordina per:</span>
                                <span class="font-medium">{{ $sortOptions[$filters['sort'] ?? 'default'] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-elegant shadow-elegant-lg py-2 z-10"
                            >
                                @foreach($sortOptions as $value => $label)
                                    <a
                                        href="{{ request()->fullUrlWithQuery(['sort' => $value]) }}"
                                        class="block px-4 py-2 hover:bg-primary-200 transition-colors {{ ($filters['sort'] ?? 'default') === $value ? 'bg-secondary-100 text-secondary-800' : 'text-content-light' }}"
                                    >
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filters Panel --}}
                <div
                    x-show="filtersOpen"
                    x-collapse
                    class="lg:hidden mt-4 p-4 bg-white rounded-elegant shadow-card"
                >
                    <form action="" method="GET" class="space-y-4">
                        <input type="hidden" name="sort" value="{{ $filters['sort'] ?? 'default' }}">

                        {{-- Price Range --}}
                        <div>
                            <label class="form-label">Prezzo</label>
                            <div class="flex items-center gap-2">
                                <input
                                    type="number"
                                    name="min_price"
                                    placeholder="Min"
                                    value="{{ $filters['min_price'] ?? '' }}"
                                    class="form-input w-24"
                                >
                                <span class="text-content-muted">-</span>
                                <input
                                    type="number"
                                    name="max_price"
                                    placeholder="Max"
                                    value="{{ $filters['max_price'] ?? '' }}"
                                    class="form-input w-24"
                                >
                            </div>
                        </div>

                        {{-- Checkboxes --}}
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="handmade"
                                    value="1"
                                    {{ ($filters['handmade'] ?? false) ? 'checked' : '' }}
                                    class="rounded border-primary-500 text-secondary-500 focus:ring-secondary-400"
                                >
                                <span class="ml-2 text-content-light">Solo artigianali</span>
                            </label>
                            <label class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="in_stock"
                                    value="1"
                                    {{ ($filters['in_stock'] ?? false) ? 'checked' : '' }}
                                    class="rounded border-primary-500 text-secondary-500 focus:ring-secondary-400"
                                >
                                <span class="ml-2 text-content-light">Solo disponibili</span>
                            </label>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="btn-primary flex-1">Applica Filtri</button>
                            <a href="{{ route('events.show', $event->slug) }}" class="btn-ghost">Reset</a>
                        </div>
                    </form>
                </div>
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
                        <h3 class="font-heading text-xl text-content-muted mb-2">Nessun Prodotto Trovato</h3>
                        <p class="text-content-subtle mb-4">Non ci sono prodotti che corrispondono ai filtri selezionati.</p>
                        <a href="{{ route('events.show', $event->slug) }}" class="btn-secondary">
                            Rimuovi Filtri
                        </a>
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

    {{-- Other Events --}}
    <section class="section bg-white">
        <div class="container-elegant">
            <h2 class="section-title">Esplora Altri Eventi</h2>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                @foreach($navigationEvents ?? [] as $navEvent)
                    @if($navEvent->slug !== $event->slug)
                        <a
                            href="{{ route('events.show', $navEvent->slug) }}"
                            class="flex-shrink-0 px-6 py-3 bg-primary-300 hover:bg-secondary-200 rounded-full transition-colors"
                        >
                            {{ $navEvent->name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
