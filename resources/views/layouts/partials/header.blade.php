{{-- Header con navigazione "Shop by Event" --}}
<header
    x-data="{ mobileMenuOpen: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="{ 'shadow-elegant bg-primary-100/95 backdrop-blur-sm': scrolled, 'bg-transparent': !scrolled }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="container-elegant">
        <nav class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('Logo_main.jpeg') }}" alt="Dettagli Boutique" class="h-12 w-12 rounded-full object-cover shadow-elegant">
                <span class="font-display text-2xl text-content group-hover:text-secondary-700 transition-colors">
                    Dettagli Boutique
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-8">
                {{-- Shop by Event Dropdown --}}
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button
                        class="nav-link flex items-center space-x-1 py-2"
                        :class="{ 'nav-link-active': open }"
                    >
                        <span>Shop per Evento</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': open }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-0 w-64 mt-2 bg-white rounded-elegant shadow-elegant-lg overflow-hidden"
                    >
                        <div class="py-2">
                            @foreach($navigationEvents ?? [] as $event)
                                <a
                                    href="{{ route('events.show', $event->slug) }}"
                                    class="flex items-center px-4 py-3 hover:bg-primary-200 transition-colors group"
                                >
                                    @if($event->image)
                                        <img
                                            src="{{ asset('storage/' . $event->image) }}"
                                            alt="{{ $event->name }}"
                                            class="w-10 h-10 rounded-full object-cover mr-3"
                                        >
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-secondary-200 flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="font-medium text-content-light group-hover:text-content transition-colors">
                                        {{ $event->name }}
                                    </span>
                                </a>
                            @endforeach

                            <div class="border-t border-primary-300 mt-2 pt-2">
                                <a
                                    href="{{ route('events.index') }}"
                                    class="flex items-center justify-center px-4 py-2 text-secondary-700 hover:text-secondary-800 font-medium transition-colors"
                                >
                                    Vedi Tutti gli Eventi
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="nav-link py-2">Tutti i Prodotti</a>
                <a href="{{ route('about') }}" class="nav-link py-2">Chi Siamo</a>
                <a href="{{ route('contact') }}" class="nav-link py-2">Contatti</a>
            </div>

            {{-- Right Side Actions --}}
            <div class="flex items-center space-x-4">
                {{-- Search Button --}}
                <button
                    x-data
                    @click="$dispatch('open-search')"
                    class="p-2 text-content-light hover:text-content transition-colors"
                    aria-label="Cerca"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                {{-- Cart Button --}}
                <a
                    href="{{ route('cart.index') }}"
                    class="relative p-2 text-content-light hover:text-content transition-colors"
                    aria-label="Carrello"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    {{-- Cart Count Badge --}}
                    @if(session('cart_count', 0) > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-secondary-400 text-content text-xs font-bold rounded-full flex items-center justify-center">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </a>

                {{-- User Menu --}}
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="p-2 text-content-light hover:text-content transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </button>
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-elegant shadow-elegant-lg py-2"
                        >
                            <a href="{{ route('account.orders') }}" class="block px-4 py-2 hover:bg-primary-200 transition-colors">I Miei Ordini</a>
                            <a href="{{ route('account.profile') }}" class="block px-4 py-2 hover:bg-primary-200 transition-colors">Profilo</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-primary-200 transition-colors text-danger-600">
                                    Esci
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost text-sm">Accedi</a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 text-content-light hover:text-content transition-colors"
                    aria-label="Menu"
                >
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        x-cloak
        class="lg:hidden bg-white shadow-elegant-lg"
    >
        <div class="container-elegant py-4 space-y-4">
            {{-- Events Accordion --}}
            <div x-data="{ expanded: false }">
                <button
                    @click="expanded = !expanded"
                    class="w-full flex items-center justify-between py-2 font-medium text-content"
                >
                    <span>Shop per Evento</span>
                    <svg
                        class="w-5 h-5 transition-transform duration-200"
                        :class="{ 'rotate-180': expanded }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="expanded" x-collapse class="pl-4 space-y-2 mt-2">
                    @foreach($navigationEvents ?? [] as $event)
                        <a
                            href="{{ route('events.show', $event->slug) }}"
                            class="block py-2 text-content-light hover:text-content transition-colors"
                        >
                            {{ $event->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="block py-2 font-medium text-content">Tutti i Prodotti</a>
            <a href="{{ route('about') }}" class="block py-2 font-medium text-content">Chi Siamo</a>
            <a href="{{ route('contact') }}" class="block py-2 font-medium text-content">Contatti</a>
        </div>
    </div>
</header>

{{-- Spacer per l'header fisso --}}
<div class="h-20"></div>

{{-- Search Modal --}}
@include('layouts.partials.search-modal')
