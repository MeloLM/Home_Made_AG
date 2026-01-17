@extends('layouts.app')

@section('title', $product->meta_title ?? $product->name)
@section('meta_description', $product->meta_description ?? $product->short_description)

@section('content')
    <section class="section pt-8">
        <div class="container-elegant">
            {{-- Breadcrumb --}}
            <nav class="mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-content-muted hover:text-content transition-colors">
                            Home
                        </a>
                    </li>
                    @if($product->activeEvents->first())
                        <li class="text-content-subtle">/</li>
                        <li>
                            <a href="{{ route('events.show', $product->activeEvents->first()->slug) }}" class="text-content-muted hover:text-content transition-colors">
                                {{ $product->activeEvents->first()->name }}
                            </a>
                        </li>
                    @endif
                    <li class="text-content-subtle">/</li>
                    <li class="text-content font-medium truncate max-w-xs">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Product Gallery --}}
                <div x-data="{ activeImage: 0 }">
                    {{-- Main Image --}}
                    <div class="aspect-square bg-white rounded-elegant shadow-card overflow-hidden mb-4">
                        @if($product->main_image)
                            <img
                                :src="[
                                    '{{ $product->main_image_url }}',
                                    @foreach($product->gallery_images ?? [] as $image)
                                        '{{ asset('storage/' . $image) }}',
                                    @endforeach
                                ][activeImage]"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-contain"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-32 h-32 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Thumbnails --}}
                    @if($product->gallery_images && count($product->gallery_images) > 0)
                        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                            <button
                                @click="activeImage = 0"
                                :class="{ 'ring-2 ring-secondary-400': activeImage === 0 }"
                                class="flex-shrink-0 w-20 h-20 rounded-elegant overflow-hidden bg-white shadow-card"
                            >
                                <img
                                    src="{{ $product->main_image_url }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >
                            </button>
                            @foreach($product->gallery_images as $index => $image)
                                <button
                                    @click="activeImage = {{ $index + 1 }}"
                                    :class="{ 'ring-2 ring-secondary-400': activeImage === {{ $index + 1 }} }"
                                    class="flex-shrink-0 w-20 h-20 rounded-elegant overflow-hidden bg-white shadow-card"
                                >
                                    <img
                                        src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->name }} - Immagine {{ $index + 2 }}"
                                        class="w-full h-full object-cover"
                                    >
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div>
                    {{-- Badges --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($product->is_handmade)
                            <span class="badge badge-handmade">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Fatto a Mano
                            </span>
                        @endif
                        @if($product->on_sale)
                            <span class="badge bg-danger-500 text-white">
                                -{{ $product->discount_percentage }}% SCONTO
                            </span>
                        @endif
                    </div>

                    {{-- Product Name --}}
                    <h1 class="font-heading text-3xl lg:text-4xl font-semibold text-content mb-4">
                        {{ $product->name }}
                    </h1>

                    {{-- Events --}}
                    @if($product->activeEvents->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="text-content-muted">Perfetto per:</span>
                            @foreach($product->activeEvents as $event)
                                <a
                                    href="{{ route('events.show', $event->slug) }}"
                                    class="text-secondary-700 hover:text-secondary-800 underline-elegant"
                                >
                                    {{ $event->name }}
                                </a>
                                @if(!$loop->last)<span class="text-content-subtle">•</span>@endif
                            @endforeach
                        </div>
                    @endif

                    {{-- Price --}}
                    <div class="flex items-baseline gap-3 mb-6">
                        <span class="text-4xl font-heading font-bold text-content">
                            {{ $product->formatted_price }}
                        </span>
                        @if($product->on_sale && $product->formatted_compare_at_price)
                            <span class="text-xl text-content-muted line-through">
                                {{ $product->formatted_compare_at_price }}
                            </span>
                            <span class="text-danger-600 font-medium">
                                Risparmi {{ number_format($product->compare_at_price - $product->price, 2, ',', '.') }}€
                            </span>
                        @endif
                    </div>

                    {{-- Stock Status --}}
                    <div class="mb-6">
                        @if($product->in_stock)
                            <div class="flex items-center text-success-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Disponibile</span>
                                @if($product->stock <= 5)
                                    <span class="ml-2 text-warning-600">(Solo {{ $product->stock }} rimasti!)</span>
                                @endif
                            </div>
                        @else
                            <div class="flex items-center text-danger-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Temporaneamente Esaurito</span>
                            </div>
                        @endif
                    </div>

                    {{-- Short Description --}}
                    @if($product->short_description)
                        <p class="text-content-light text-lg mb-6">
                            {{ $product->short_description }}
                        </p>
                    @endif

                    {{-- Add to Cart Form --}}
                    @if($product->in_stock)
                        <form
                            x-data="{ quantity: 1 }"
                            action="#"
                            method="POST"
                            class="mb-8"
                        >
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="flex items-center gap-4 mb-4">
                                {{-- Quantity Selector --}}
                                <div class="flex items-center border border-primary-400 rounded-elegant">
                                    <button
                                        type="button"
                                        @click="quantity = Math.max(1, quantity - 1)"
                                        class="px-4 py-2 hover:bg-primary-200 transition-colors"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <input
                                        type="number"
                                        name="quantity"
                                        x-model="quantity"
                                        min="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center border-0 focus:ring-0"
                                    >
                                    <button
                                        type="button"
                                        @click="quantity = Math.min({{ $product->stock }}, quantity + 1)"
                                        class="px-4 py-2 hover:bg-primary-200 transition-colors"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" class="btn-primary flex-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Aggiungi al Carrello
                                </button>
                                <button type="button" class="btn-secondary px-4" title="Aggiungi ai preferiti">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif

                    {{-- Product Details --}}
                    <div class="border-t border-primary-400 pt-6 space-y-4">
                        @if($product->materials)
                            <div class="flex">
                                <span class="w-32 text-content-muted">Materiali:</span>
                                <span class="text-content">{{ $product->materials }}</span>
                            </div>
                        @endif
                        @if($product->dimensions)
                            <div class="flex">
                                <span class="w-32 text-content-muted">Dimensioni:</span>
                                <span class="text-content">{{ $product->dimensions }}</span>
                            </div>
                        @endif
                        @if($product->weight_grams)
                            <div class="flex">
                                <span class="w-32 text-content-muted">Peso:</span>
                                <span class="text-content">{{ $product->weight_grams }}g</span>
                            </div>
                        @endif
                        @if($product->sku)
                            <div class="flex">
                                <span class="w-32 text-content-muted">SKU:</span>
                                <span class="text-content font-mono text-sm">{{ $product->sku }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Full Description --}}
            @if($product->description)
                <div class="mt-12 max-w-4xl">
                    <h2 class="font-heading text-2xl font-semibold text-content mb-4">Descrizione</h2>
                    <div class="prose prose-lg text-content-light">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="section bg-white">
            <div class="container-elegant">
                <h2 class="section-title">Potrebbe Piacerti Anche</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        @include('components.product-card', ['product' => $related])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
