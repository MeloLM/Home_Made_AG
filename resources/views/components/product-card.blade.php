{{-- Product Card Component --}}
@props(['product'])

<article class="card-product group">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        {{-- Product Image --}}
        <div class="relative aspect-product bg-primary-200 overflow-hidden">
            @if($product->main_image)
                <img
                    src="{{ $product->main_image_url }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif

            {{-- Badges --}}
            <div class="absolute top-3 left-3 flex flex-col gap-2">
                @if($product->is_handmade)
                    <span class="badge badge-handmade">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Artigianale
                    </span>
                @endif

                @if($product->on_sale)
                    <span class="badge bg-danger-500 text-white">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif
            </div>

            {{-- Quick Actions --}}
            <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button
                    type="button"
                    class="p-2 bg-white rounded-full shadow-elegant hover:bg-secondary-100 transition-colors"
                    title="Aggiungi ai preferiti"
                >
                    <svg class="w-5 h-5 text-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>
            </div>

            {{-- Out of Stock Overlay --}}
            @if(! $product->in_stock)
                <div class="absolute inset-0 bg-white/80 flex items-center justify-center">
                    <span class="badge badge-out-of-stock text-sm px-4 py-2">Esaurito</span>
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="p-4">
            {{-- Events Tags --}}
            @if($product->activeEvents && $product->activeEvents->count() > 0)
                <div class="flex flex-wrap gap-1 mb-2">
                    @foreach($product->activeEvents->take(2) as $event)
                        <span class="text-xs text-secondary-700 bg-secondary-100 px-2 py-0.5 rounded-full">
                            {{ $event->name }}
                        </span>
                    @endforeach
                    @if($product->activeEvents->count() > 2)
                        <span class="text-xs text-content-muted">+{{ $product->activeEvents->count() - 2 }}</span>
                    @endif
                </div>
            @endif

            {{-- Product Name --}}
            <h3 class="font-heading text-lg font-medium text-content group-hover:text-secondary-700 transition-colors line-clamp-2">
                {{ $product->name }}
            </h3>

            {{-- Short Description --}}
            @if($product->short_description)
                <p class="text-sm text-content-muted mt-1 line-clamp-2">
                    {{ $product->short_description }}
                </p>
            @endif

            {{-- Price --}}
            <div class="mt-3 flex items-center gap-2">
                <span class="price">{{ $product->formatted_price }}</span>
                @if($product->on_sale && $product->formatted_compare_at_price)
                    <span class="price-original">{{ $product->formatted_compare_at_price }}</span>
                @endif
            </div>

            {{-- Stock Status --}}
            <div class="mt-2">
                @if($product->in_stock)
                    <span class="text-sm text-success-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Disponibile
                    </span>
                @else
                    <span class="text-sm text-danger-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Esaurito
                    </span>
                @endif
            </div>
        </div>
    </a>

    {{-- Add to Cart Button --}}
    @if($product->in_stock)
        <div class="px-4 pb-4">
            <button
                type="button"
                class="w-full btn-primary text-sm"
                x-data
                @click.prevent="$dispatch('add-to-cart', { productId: {{ $product->id }} })"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Aggiungi al Carrello
            </button>
        </div>
    @endif
</article>
