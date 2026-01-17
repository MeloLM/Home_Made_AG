@extends('layouts.app')

@section('title', 'Chi Siamo')
@section('meta_description', 'Scopri la storia di Gioielli Artigianali. Passione, tradizione e artigianalità italiana.')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-elegant py-16 lg:py-24">
        <div class="container-elegant">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="font-display text-display-xl text-content mb-6">Chi Siamo</h1>
                <p class="text-xl text-content-light">
                    Creiamo gioielli artigianali con amore e passione, per rendere
                    ogni tuo momento speciale ancora più prezioso.
                </p>
            </div>
        </div>
    </section>

    {{-- Our Story --}}
    <section class="section">
        <div class="container-elegant">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-heading text-3xl font-semibold text-content mb-6">La Nostra Storia</h2>
                    <div class="space-y-4 text-content-light">
                        <p>
                            La nostra avventura è iniziata con una semplice passione: creare gioielli unici
                            che raccontino storie speciali. Ogni pezzo che realizziamo è frutto di ore
                            di lavoro meticoloso, amore per i dettagli e rispetto per la tradizione artigianale.
                        </p>
                        <p>
                            Crediamo che i momenti più importanti della vita meritino gioielli altrettanto speciali.
                            Per questo ogni nostro rosario, braccialetto o collana è pensato per accompagnare
                            battesimi, comunioni, matrimoni e tutte le occasioni che restano nel cuore.
                        </p>
                        <p>
                            Utilizziamo solo materiali di qualità, selezionati con cura: perle, cristalli,
                            argento e pietre naturali. Ogni gioiello è realizzato a mano, pezzo per pezzo,
                            garantendo unicità e attenzione ai dettagli.
                        </p>
                    </div>
                </div>
                <div class="bg-primary-300 rounded-elegant aspect-square flex items-center justify-center">
                    <div class="text-center p-8">
                        <svg class="w-24 h-24 text-secondary-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <p class="text-content-muted">Immagine del Laboratorio</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="section bg-white">
        <div class="container-elegant">
            <h2 class="section-title">I Nostri Valori</h2>

            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Artigianalità</h3>
                    <p class="text-content-light">
                        Ogni gioiello è creato a mano con tecniche tradizionali,
                        garantendo pezzi unici e irripetibili.
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Qualità</h3>
                    <p class="text-content-light">
                        Selezioniamo solo i migliori materiali per garantire
                        bellezza e durabilità nel tempo.
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-secondary-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold mb-2">Passione</h3>
                    <p class="text-content-light">
                        Ogni creazione nasce dalla passione per il bello
                        e dal desiderio di rendere speciali i tuoi momenti.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="section bg-secondary-200">
        <div class="container-elegant text-center">
            <h2 class="font-heading text-3xl font-semibold text-content mb-4">
                Pronto a Scoprire le Nostre Creazioni?
            </h2>
            <p class="text-content-light mb-8 max-w-2xl mx-auto">
                Esplora la nostra collezione di gioielli artigianali e trova
                il pezzo perfetto per il tuo prossimo momento speciale.
            </p>
            <a href="{{ route('events.index') }}" class="btn-primary">
                Esplora la Collezione
            </a>
        </div>
    </section>
@endsection
