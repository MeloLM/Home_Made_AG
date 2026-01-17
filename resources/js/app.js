/**
 * Gioielli Artigianali - Main JavaScript
 *
 * Stack: Alpine.js per interattività client-side
 */

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Registra il plugin collapse per Alpine.js
Alpine.plugin(collapse);

// Rendi Alpine disponibile globalmente
window.Alpine = Alpine;

/**
 * Store globale per il carrello
 */
Alpine.store('cart', {
    items: [],
    count: 0,
    total: 0,

    init() {
        // Carica il carrello dalla sessione se disponibile
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            try {
                const data = JSON.parse(savedCart);
                this.items = data.items || [];
                this.count = data.count || 0;
                this.total = data.total || 0;
            } catch (e) {
                console.error('Errore nel caricamento del carrello:', e);
            }
        }
    },

    addItem(product) {
        const existingItem = this.items.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += product.quantity || 1;
        } else {
            this.items.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: product.quantity || 1
            });
        }

        this.updateTotals();
        this.save();
        this.showNotification('Prodotto aggiunto al carrello!');
    },

    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.updateTotals();
        this.save();
    },

    updateQuantity(productId, quantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, quantity);
            this.updateTotals();
            this.save();
        }
    },

    updateTotals() {
        this.count = this.items.reduce((sum, item) => sum + item.quantity, 0);
        this.total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    save() {
        localStorage.setItem('cart', JSON.stringify({
            items: this.items,
            count: this.count,
            total: this.total
        }));
    },

    clear() {
        this.items = [];
        this.count = 0;
        this.total = 0;
        localStorage.removeItem('cart');
    },

    showNotification(message) {
        // Dispatch evento per mostrare notifica
        window.dispatchEvent(new CustomEvent('show-notification', {
            detail: { message, type: 'success' }
        }));
    }
});

/**
 * Store per le notifiche toast
 */
Alpine.store('notifications', {
    items: [],

    add(message, type = 'info') {
        const id = Date.now();
        this.items.push({ id, message, type });

        // Rimuovi automaticamente dopo 3 secondi
        setTimeout(() => {
            this.remove(id);
        }, 3000);
    },

    remove(id) {
        this.items = this.items.filter(item => item.id !== id);
    }
});

/**
 * Componente per gestire l'aggiunta al carrello
 */
Alpine.data('addToCart', () => ({
    loading: false,

    async add(productId, quantity = 1) {
        this.loading = true;

        try {
            // In futuro, questa sarà una chiamata API
            // Per ora simula un delay
            await new Promise(resolve => setTimeout(resolve, 300));

            // Aggiungi al carrello locale
            Alpine.store('cart').addItem({
                id: productId,
                quantity: quantity
            });

        } catch (error) {
            console.error('Errore:', error);
            Alpine.store('notifications').add('Errore durante l\'aggiunta al carrello', 'error');
        } finally {
            this.loading = false;
        }
    }
}));

/**
 * Componente per la gallery delle immagini prodotto
 */
Alpine.data('productGallery', (images = []) => ({
    images: images,
    activeIndex: 0,

    setActive(index) {
        this.activeIndex = index;
    },

    next() {
        this.activeIndex = (this.activeIndex + 1) % this.images.length;
    },

    prev() {
        this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    }
}));

/**
 * Listener per eventi custom
 */
window.addEventListener('add-to-cart', (event) => {
    const { productId, quantity } = event.detail;
    Alpine.store('cart').addItem({ id: productId, quantity: quantity || 1 });
});

window.addEventListener('show-notification', (event) => {
    const { message, type } = event.detail;
    Alpine.store('notifications').add(message, type);
});

// Inizializza Alpine
Alpine.start();
