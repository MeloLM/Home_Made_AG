@extends('layouts.app')
@section('title', 'Spedizioni')
@section('content')
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Spedizioni</h1>
        </div>
    </section>
    <section class="section">
        <div class="container-elegant max-w-3xl prose prose-lg">
            <h2>Tempi di Spedizione</h2>
            <p>Tutti i nostri gioielli sono realizzati a mano. I tempi di preparazione sono di 2-3 giorni lavorativi.</p>
            <ul>
                <li><strong>Italia:</strong> 3-5 giorni lavorativi</li>
                <li><strong>Europa:</strong> 5-7 giorni lavorativi</li>
                <li><strong>Resto del mondo:</strong> 10-15 giorni lavorativi</li>
            </ul>
            <h2>Costi di Spedizione</h2>
            <p>Spedizione gratuita per ordini superiori a €50 in Italia. Per ordini inferiori, il costo è di €5,00.</p>
        </div>
    </section>
@endsection
