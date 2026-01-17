@extends('layouts.app')

@section('title', 'Carrello')

@section('content')
    <section class="section">
        <div class="container-elegant">
            <h1 class="font-display text-display-lg text-content text-center mb-12">Il Tuo Carrello</h1>

            <div x-data x-init="$store.cart.init()">
                {{-- Empty Cart --}}
                <template x-if="$store.cart.items.length === 0">
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-content-subtle mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h2 class="font-heading text-2xl text-content-muted mb-4">Il tuo carrello è vuoto</h2>
                        <p class="text-content-light mb-8">Esplora le nostre collezioni e trova il gioiello perfetto!</p>
                        <a href="{{ route('events.index') }}" class="btn-primary">
                            Inizia lo Shopping
                        </a>
                    </div>
                </template>

                {{-- Cart Items --}}
                <template x-if="$store.cart.items.length > 0">
                    <div class="grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-4">
                            <template x-for="item in $store.cart.items" :key="item.id">
                                <div class="bg-white rounded-elegant shadow-card p-4 flex gap-4">
                                    <div class="w-24 h-24 bg-primary-200 rounded-elegant flex-shrink-0"></div>
                                    <div class="flex-grow">
                                        <h3 class="font-heading font-medium" x-text="item.name"></h3>
                                        <p class="text-secondary-700 font-semibold" x-text="'€' + item.price.toFixed(2)"></p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <button @click="$store.cart.updateQuantity(item.id, item.quantity - 1)" class="px-2 py-1 border rounded">-</button>
                                            <span x-text="item.quantity"></span>
                                            <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="px-2 py-1 border rounded">+</button>
                                        </div>
                                    </div>
                                    <button @click="$store.cart.removeItem(item.id)" class="text-danger-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="bg-white rounded-elegant shadow-card p-6 h-fit sticky top-24">
                            <h2 class="font-heading text-xl font-semibold mb-4">Riepilogo Ordine</h2>
                            <div class="space-y-2 border-b border-primary-300 pb-4 mb-4">
                                <div class="flex justify-between">
                                    <span class="text-content-light">Subtotale</span>
                                    <span x-text="'€' + $store.cart.total.toFixed(2)"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-content-light">Spedizione</span>
                                    <span x-text="$store.cart.total >= 50 ? 'Gratuita' : '€5,00'"></span>
                                </div>
                            </div>
                            <div class="flex justify-between font-semibold text-lg mb-6">
                                <span>Totale</span>
                                <span x-text="'€' + ($store.cart.total + ($store.cart.total >= 50 ? 0 : 5)).toFixed(2)"></span>
                            </div>
                            <button class="btn-primary w-full">Procedi al Checkout</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
@endsection
