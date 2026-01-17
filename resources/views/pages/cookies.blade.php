@extends('layouts.app')
@section('title', 'Cookie Policy')
@section('content')
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Cookie Policy</h1>
        </div>
    </section>
    <section class="section">
        <div class="container-elegant max-w-3xl prose prose-lg">
            <p><em>Ultimo aggiornamento: {{ date('d/m/Y') }}</em></p>
            <h2>Cosa sono i Cookie</h2>
            <p>I cookie sono piccoli file di testo che vengono salvati sul tuo dispositivo durante la navigazione.</p>
            <h2>Cookie Utilizzati</h2>
            <ul>
                <li><strong>Cookie Tecnici:</strong> Necessari per il funzionamento del sito</li>
                <li><strong>Cookie di Sessione:</strong> Per mantenere il carrello e l'accesso</li>
                <li><strong>Cookie Analitici:</strong> Per analizzare il traffico (Google Analytics)</li>
            </ul>
            <h2>Gestione dei Cookie</h2>
            <p>Puoi gestire i cookie attraverso le impostazioni del tuo browser.</p>
        </div>
    </section>
@endsection
