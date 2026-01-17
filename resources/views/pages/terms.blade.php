@extends('layouts.app')
@section('title', 'Termini e Condizioni')
@section('content')
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Termini e Condizioni</h1>
        </div>
    </section>
    <section class="section">
        <div class="container-elegant max-w-3xl prose prose-lg">
            <p><em>Ultimo aggiornamento: {{ date('d/m/Y') }}</em></p>
            <h2>Accettazione dei Termini</h2>
            <p>Utilizzando questo sito web, accetti i presenti termini e condizioni.</p>
            <h2>Prodotti</h2>
            <p>I nostri gioielli sono realizzati artigianalmente. Possono esserci lievi variazioni tra i prodotti.</p>
            <h2>Prezzi e Pagamenti</h2>
            <p>Tutti i prezzi sono in Euro e includono l'IVA. Accettiamo pagamenti con carta di credito e PayPal.</p>
            <h2>Proprietà Intellettuale</h2>
            <p>Tutti i contenuti del sito sono protetti da copyright.</p>
        </div>
    </section>
@endsection
