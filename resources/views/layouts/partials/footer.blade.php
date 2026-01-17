{{-- Footer --}}
<footer class="bg-primary-300 border-t border-primary-400">
    {{-- Main Footer --}}
    <div class="container-elegant py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('Logo_main.jpeg') }}" alt="Dettagli Boutique" class="h-10 w-10 rounded-full object-cover">
                    <span class="font-display text-2xl text-content">Dettagli Boutique</span>
                </a>
                <p class="mt-4 text-content-light leading-relaxed">
                    Creazioni uniche fatte a mano con amore e passione.
                    Ogni gioiello racconta una storia speciale.
                </p>
                {{-- Social Links --}}
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="p-2 bg-primary-400 hover:bg-secondary-300 rounded-full text-content-light hover:text-content transition-colors" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                        </svg>
                    </a>
                    <a href="#" class="p-2 bg-primary-400 hover:bg-secondary-300 rounded-full text-content-light hover:text-content transition-colors" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.27.2-6.78,2.71-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.27,2.71,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.27-.2,6.78-2.71,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.27-2.71-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z"/>
                        </svg>
                    </a>
                    <a href="#" class="p-2 bg-primary-400 hover:bg-secondary-300 rounded-full text-content-light hover:text-content transition-colors" aria-label="Pinterest">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,0A12,12,0,0,0,7.46,23.2c-.05-.94-.01-2.07.24-3.09l1.77-7.53s-.44-.88-.44-2.19c0-2.05,1.19-3.58,2.67-3.58,1.26,0,1.87.95,1.87,2.08,0,1.27-.81,3.17-1.22,4.93-.35,1.47.74,2.67,2.19,2.67,2.63,0,4.4-3.38,4.4-7.39,0-3.05-2.06-5.33-5.8-5.33a6.57,6.57,0,0,0-6.84,6.63,3.85,3.85,0,0,0,.89,2.6.75.75,0,0,1,.17.72c-.08.29-.25.99-.32,1.27a.53.53,0,0,1-.77.38c-1.91-.78-2.79-2.88-2.79-5.25,0-3.9,3.29-8.58,9.82-8.58,5.25,0,8.7,3.8,8.7,7.88,0,5.38-2.99,9.41-7.39,9.41a3.93,3.93,0,0,1-3.33-1.69s-.79,3.17-.96,3.78a11.11,11.11,0,0,1-1.42,2.98A12,12,0,1,0,12,0Z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Shop per Evento --}}
            <div>
                <h3 class="font-heading text-lg font-semibold text-content mb-4">Shop per Evento</h3>
                <ul class="space-y-2">
                    @foreach($navigationEvents ?? [] as $event)
                        <li>
                            <a href="{{ route('events.show', $event->slug) }}" class="text-content-light hover:text-content transition-colors">
                                {{ $event->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Informazioni --}}
            <div>
                <h3 class="font-heading text-lg font-semibold text-content mb-4">Informazioni</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('about') }}" class="text-content-light hover:text-content transition-colors">
                            Chi Siamo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-content-light hover:text-content transition-colors">
                            Contatti
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}" class="text-content-light hover:text-content transition-colors">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shipping') }}" class="text-content-light hover:text-content transition-colors">
                            Spedizioni
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('returns') }}" class="text-content-light hover:text-content transition-colors">
                            Resi e Rimborsi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contatti --}}
            <div>
                <h3 class="font-heading text-lg font-semibold text-content mb-4">Contattaci</h3>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-secondary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:info@gioielliartigianali.it" class="text-content-light hover:text-content transition-colors">
                            info@gioielliartigianali.it
                        </a>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-secondary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+390123456789" class="text-content-light hover:text-content transition-colors">
                            +39 012 345 6789
                        </a>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-secondary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-content-light">
                            Via Roma, 123<br>
                            00100 Roma, Italia
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-primary-400 bg-primary-400/50">
        <div class="container-elegant py-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                <p class="text-sm text-content-muted">
                    &copy; {{ date('Y') }} Dettagli Boutique. Tutti i diritti riservati.
                </p>
                <div class="flex space-x-4 text-sm">
                    <a href="{{ route('privacy') }}" class="text-content-muted hover:text-content transition-colors">
                        Privacy Policy
                    </a>
                    <a href="{{ route('terms') }}" class="text-content-muted hover:text-content transition-colors">
                        Termini e Condizioni
                    </a>
                    <a href="{{ route('cookies') }}" class="text-content-muted hover:text-content transition-colors">
                        Cookie Policy
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
