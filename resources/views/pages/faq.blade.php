@extends('layouts.app')

@section('title', 'FAQ - Domande Frequenti')

@section('content')
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Domande Frequenti</h1>
        </div>
    </section>

    <section class="section">
        <div class="container-elegant max-w-3xl">
            <div x-data="{ active: null }" class="space-y-4">
                @foreach([
                    ['q' => 'Come posso effettuare un ordine?', 'a' => 'Puoi effettuare un ordine direttamente dal nostro sito. Aggiungi i prodotti al carrello e procedi al checkout.'],
                    ['q' => 'Quali sono i tempi di spedizione?', 'a' => 'I tempi di spedizione sono di 3-5 giorni lavorativi per l\'Italia. Per l\'estero potrebbero variare.'],
                    ['q' => 'Posso richiedere un gioiello personalizzato?', 'a' => 'Certamente! Contattaci per discutere la tua richiesta di personalizzazione.'],
                    ['q' => 'Come posso effettuare un reso?', 'a' => 'Hai 14 giorni dalla ricezione per richiedere un reso. Contattaci per avviare la procedura.'],
                    ['q' => 'I gioielli sono davvero fatti a mano?', 'a' => 'Sì, ogni nostro gioiello è realizzato interamente a mano nel nostro laboratorio artigianale.'],
                ] as $index => $faq)
                    <div class="border border-primary-400 rounded-elegant overflow-hidden">
                        <button
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between p-4 text-left bg-white hover:bg-primary-100 transition-colors"
                        >
                            <span class="font-medium text-content">{{ $faq['q'] }}</span>
                            <svg class="w-5 h-5 text-content-muted transition-transform" :class="{ 'rotate-180': active === {{ $index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="active === {{ $index }}" x-collapse class="px-4 pb-4 text-content-light">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
