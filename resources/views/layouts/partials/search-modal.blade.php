{{-- Search Modal --}}
<div
    x-data="{ open: false, query: '' }"
    @open-search.window="open = true; $nextTick(() => $refs.searchInput.focus())"
    @keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-[60]"
>
    {{-- Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="absolute inset-0 bg-content/40 backdrop-blur-sm"
    ></div>

    {{-- Search Panel --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-8"
        class="relative max-w-2xl mx-auto mt-20 px-4"
    >
        <form action="{{ route('products.search') }}" method="GET" class="bg-white rounded-elegant shadow-elegant-lg overflow-hidden">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-content-muted ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    x-ref="searchInput"
                    type="search"
                    name="q"
                    x-model="query"
                    placeholder="Cerca gioielli, rosari, braccialetti..."
                    class="flex-1 px-4 py-4 border-0 focus:ring-0 text-lg placeholder-content-subtle"
                >
                <button
                    type="submit"
                    class="px-6 py-4 bg-secondary-300 hover:bg-secondary-400 text-content font-medium transition-colors"
                >
                    Cerca
                </button>
            </div>

            {{-- Ricerche suggerite --}}
            <div class="border-t border-primary-300 px-4 py-3">
                <p class="text-sm text-content-muted mb-2">Ricerche popolari:</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('products.search', ['q' => 'rosario']) }}" class="text-sm px-3 py-1 bg-primary-300 hover:bg-primary-400 rounded-full transition-colors">
                        Rosari
                    </a>
                    <a href="{{ route('products.search', ['q' => 'bracciale']) }}" class="text-sm px-3 py-1 bg-primary-300 hover:bg-primary-400 rounded-full transition-colors">
                        Braccialetti
                    </a>
                    <a href="{{ route('products.search', ['q' => 'collana']) }}" class="text-sm px-3 py-1 bg-primary-300 hover:bg-primary-400 rounded-full transition-colors">
                        Collane
                    </a>
                    <a href="{{ route('events.show', 'battesimo') }}" class="text-sm px-3 py-1 bg-primary-300 hover:bg-primary-400 rounded-full transition-colors">
                        Battesimo
                    </a>
                    <a href="{{ route('events.show', 'matrimonio') }}" class="text-sm px-3 py-1 bg-primary-300 hover:bg-primary-400 rounded-full transition-colors">
                        Matrimonio
                    </a>
                </div>
            </div>
        </form>

        {{-- Tasto chiudi --}}
        <button
            @click="open = false"
            class="absolute -top-12 right-4 text-white hover:text-primary-200 transition-colors"
        >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
