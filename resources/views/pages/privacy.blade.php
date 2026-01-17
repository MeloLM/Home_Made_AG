@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Privacy Policy</h1>
        </div>
    </section>
    <section class="section">
        <div class="container-elegant max-w-3xl prose prose-lg">
            <p><em>Ultimo aggiornamento: {{ date('d/m/Y') }}</em></p>
            <h2>Raccolta dei Dati</h2>
            <p>Raccogliamo i dati personali necessari per elaborare gli ordini e fornire i nostri servizi.</p>
            <h2>Utilizzo dei Dati</h2>
            <p>I tuoi dati vengono utilizzati esclusivamente per:</p>
            <ul>
                <li>Elaborazione degli ordini</li>
                <li>Comunicazioni relative al servizio</li>
                <li>Miglioramento dell'esperienza utente</li>
            </ul>
            <h2>I Tuoi Diritti</h2>
            <p>Hai diritto di accedere, modificare o cancellare i tuoi dati personali in qualsiasi momento.</p>
        </div>
    </section>
@endsection
