@extends('layouts.app')

@section('title', 'Contatti')
@section('meta_description', 'Contattaci per informazioni sui nostri gioielli artigianali. Siamo a tua disposizione.')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-elegant py-12">
        <div class="container-elegant text-center">
            <h1 class="font-display text-display-lg text-content mb-4">Contattaci</h1>
            <p class="text-lg text-content-light max-w-2xl mx-auto">
                Hai domande sui nostri gioielli? Vuoi un pezzo personalizzato?
                Siamo qui per aiutarti.
            </p>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="section">
        <div class="container-elegant">
            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Contact Form --}}
                <div class="bg-white rounded-elegant shadow-card p-8">
                    <h2 class="font-heading text-2xl font-semibold text-content mb-6">Inviaci un Messaggio</h2>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="name" class="form-label">Nome *</label>
                                <input type="text" id="name" name="name" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="surname" class="form-label">Cognome *</label>
                                <input type="text" id="surname" name="surname" required class="form-input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" id="email" name="email" required class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Oggetto *</label>
                            <select id="subject" name="subject" required class="form-input">
                                <option value="">Seleziona un oggetto</option>
                                <option value="info">Informazioni prodotti</option>
                                <option value="order">Domande su un ordine</option>
                                <option value="custom">Richiesta personalizzazione</option>
                                <option value="wholesale">Richiesta B2B</option>
                                <option value="other">Altro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Messaggio *</label>
                            <textarea id="message" name="message" rows="5" required class="form-input"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="flex items-start">
                                <input type="checkbox" name="privacy" required class="mt-1 rounded border-primary-500 text-secondary-500 focus:ring-secondary-400">
                                <span class="ml-2 text-sm text-content-light">
                                    Ho letto e accetto la <a href="{{ route('privacy') }}" class="underline-elegant">Privacy Policy</a> *
                                </span>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Invia Messaggio
                        </button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-8">
                    <div>
                        <h2 class="font-heading text-2xl font-semibold text-content mb-6">Informazioni di Contatto</h2>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-secondary-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-content">Email</h3>
                                    <a href="mailto:info@gioielliartigianali.it" class="text-content-light hover:text-secondary-700">
                                        info@gioielliartigianali.it
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-secondary-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-content">Telefono</h3>
                                    <a href="tel:+390123456789" class="text-content-light hover:text-secondary-700">
                                        +39 012 345 6789
                                    </a>
                                    <p class="text-sm text-content-muted">Lun-Ven: 9:00-18:00</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-secondary-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-content">Indirizzo</h3>
                                    <p class="text-content-light">
                                        Via Roma, 123<br>
                                        00100 Roma, Italia
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div>
                        <h3 class="font-heading text-xl font-semibold text-content mb-4">Seguici</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-primary-300 hover:bg-secondary-300 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-content" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-primary-300 hover:bg-secondary-300 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-content" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.27.2-6.78,2.71-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.27,2.71,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.27-.2,6.78-2.71,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.27-2.71-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-primary-300 hover:bg-secondary-300 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5 text-content" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Map Placeholder --}}
                    <div class="bg-primary-300 rounded-elegant aspect-video flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-content-muted mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-content-muted">Mappa Google Maps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
