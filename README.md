<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/PostgreSQL-Supabase-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
</p>

<h1 align="center">💎 Gioielli Artigianali</h1>

<p align="center">
  <strong>E-Commerce per Gioielli Fatti a Mano</strong><br>
  Collane • Bracciali • Rosari • Creazioni Uniche
</p>

<p align="center">
  <a href="#-caratteristiche">Caratteristiche</a> •
  <a href="#-demo">Demo</a> •
  <a href="#-installazione">Installazione</a> •
  <a href="#-architettura">Architettura</a> •
  <a href="#-roadmap">Roadmap</a>
</p>

---

## 📖 Descrizione

**Gioielli Artigianali** è un'applicazione e-commerce monolitica sviluppata con Laravel 12, progettata specificamente per la vendita di gioielli artigianali fatti a mano. Il progetto nasce dalla passione per l'artigianato italiano e dalla volontà di creare una piattaforma elegante che valorizzi ogni creazione unica.

### 🎯 Filosofia del Progetto

- **Artigianalità Prima**: Ogni prodotto è presentato come opera d'arte unica
- **Shop by Event**: I prodotti sono categorizzati per occasione (Battesimo, Matrimonio, Laurea...) non per tipo
- **Design Elegante**: Palette colori neutra e raffinata che esalta i gioielli
- **Codice Pulito**: Architettura SOLID con pattern professionali

---

## ✨ Caratteristiche

### 🎨 Design & UX
| Feature | Descrizione |
|---------|-------------|
| **Tema Neutral & Elegant** | Palette Beige/Cream con accenti Carta da Zucchero |
| **Responsive Design** | Mobile-first, ottimizzato per tutti i dispositivi |
| **Tipografia Curata** | Great Vibes + Playfair Display + Lato |
| **Animazioni Fluide** | Transizioni CSS e interazioni Alpine.js |

### 🛍️ E-Commerce
| Feature | Descrizione |
|---------|-------------|
| **Shop by Event** | Navigazione per occasione (7 eventi) |
| **Catalogo Prodotti** | Filtri, ordinamento, ricerca |
| **Dettaglio Prodotto** | Gallery, materiali, dimensioni |
| **Carrello** | Gestione con Alpine.js + localStorage |
| **Wishlist** | Lista desideri (Coming Soon) |

### ⚙️ Tecnico
| Feature | Descrizione |
|---------|-------------|
| **Service-Repository Pattern** | Separazione responsabilità |
| **Caching Strategico** | Cache su Service layer |
| **PSR-12 Compliant** | Standard PHP coding style |
| **Type Hints** | PHP 8.2+ strict typing |
| **Architecture Check** | Comando per verificare coerenza |

---

## 🎬 Demo

> 🚧 **Demo live coming soon!**

### Screenshots

<details>
<summary>📸 Clicca per vedere gli screenshots</summary>

#### Homepage
```
┌─────────────────────────────────────────┐
│  🏠 GIOIELLI ARTIGIANALI               │
│  ════════════════════════════════════  │
│                                         │
│  ┌─────────────────────────────────┐   │
│  │                                 │   │
│  │         HERO SECTION            │   │
│  │    "Creazioni Uniche per        │   │
│  │     Momenti Speciali"           │   │
│  │                                 │   │
│  └─────────────────────────────────┘   │
│                                         │
│  ═══ SHOP BY EVENT ═══                 │
│  ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐      │
│  │Batt.│ │Comun│ │Matri│ │Laure│      │
│  └─────┘ └─────┘ └─────┘ └─────┘      │
│                                         │
│  ═══ PRODOTTI IN EVIDENZA ═══          │
│  ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐      │
│  │ 💎  │ │ 📿  │ │ 💍  │ │ ✨  │      │
│  │€45  │ │€38  │ │€52  │ │€29  │      │
│  └─────┘ └─────┘ └─────┘ └─────┘      │
└─────────────────────────────────────────┘
```

#### Pagina Evento
```
┌─────────────────────────────────────────┐
│  MATRIMONIO 💒                          │
│  ════════════════════════════════════  │
│                                         │
│  Filtri: [Prezzo ▼] [Materiale ▼]      │
│                                         │
│  ┌─────┐ ┌─────┐ ┌─────┐              │
│  │Colla│ │Bracc│ │Orecch│              │
│  │na   │ │iale │ │ini   │              │
│  │€89  │ │€65  │ │€45   │              │
│  └─────┘ └─────┘ └─────┘              │
│                                         │
│  [1] [2] [3] ... [Prossima →]          │
└─────────────────────────────────────────┘
```

</details>

---

## 🛠️ Stack Tecnologico

### Backend
```
Laravel 12.47.0          Framework PHP
├── Eloquent ORM         Database abstraction
├── Blade Templates      View engine
├── Artisan CLI          Command line tools
└── Service Container    Dependency injection
```

### Frontend
```
Tailwind CSS 3.4         Utility-first CSS
├── Custom Components    .btn-*, .card-*, .nav-*
├── Custom Colors        primary, secondary, accent
└── Custom Fonts         Great Vibes, Playfair Display

Alpine.js 3.13           Reactive JavaScript
├── x-data              Component state
├── $store.cart         Global cart state
└── @click, x-show      Event handling
```

### Database
```
PostgreSQL (Supabase)    Cloud database
├── events              7 occasioni
├── products            Catalogo gioielli
├── event_product       Pivot many-to-many
├── users               Autenticazione
├── cache               Session/cache store
└── jobs                Queue system
```

### DevOps
```
Vite 5.x                Asset bundling
├── Hot Module Reload   Dev experience
└── Production Build    Optimized assets

Git + GitHub            Version control
└── CI/CD ready         GitHub Actions compatible
```

---

## 📦 Installazione

### Prerequisiti

| Requisito | Versione | Verifica |
|-----------|----------|----------|
| PHP | 8.2+ | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 18+ | `node -v` |
| npm | 9+ | `npm -v` |

### Quick Start

```bash
# 1. Clona il repository
git clone https://github.com/MeloLM/Home_Made_AG.git
cd Home_Made_AG

# 2. Installa dipendenze
composer install
npm install

# 3. Configura ambiente
cp .env.example .env
php artisan key:generate

# 4. Configura database (vedi sezione Supabase)
# Modifica .env con le tue credenziali

# 5. Migra e popola database
php artisan migrate --seed

# 6. Compila assets
npm run build

# 7. Avvia server
php artisan serve
```

### Configurazione Supabase

1. Crea un progetto su [supabase.com](https://supabase.com)
2. Vai su **Settings → Database**
3. Seleziona **Session Pooler** (per IPv4)
4. Copia i parametri nel tuo `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.YOUR_PROJECT_REF
DB_PASSWORD=YOUR_PASSWORD
```

### Comandi Utili

```bash
# Development
php artisan serve              # Server locale (http://127.0.0.1:8000)
npm run dev                    # Vite con hot reload

# Production
npm run build                  # Build ottimizzata
php artisan optimize           # Cache config/routes/views

# Database
php artisan migrate:fresh --seed   # Reset completo
php artisan db:seed               # Solo seeding

# Manutenzione
php artisan cache:clear        # Pulisci cache
php artisan app:check-architecture  # Verifica struttura
```

---

## 🏗️ Architettura

### Pattern: Service-Repository

```
┌─────────────────────────────────────────────────────────────┐
│                      REQUEST                                 │
└─────────────────────────┬───────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                     CONTROLLER                               │
│  • Riceve request                                           │
│  • Valida input                                             │
│  • Chiama Service                                           │
│  • Ritorna View/Response                                    │
└─────────────────────────┬───────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                      SERVICE                                 │
│  • Business logic                                           │
│  • Caching (Cache::remember)                                │
│  • Validazione regole business                              │
│  • Trasformazione dati                                      │
└─────────────────────────┬───────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                    REPOSITORY                                │
│  • Data access                                              │
│  • Query Eloquent                                           │
│  • Filtri e ordinamento                                     │
│  • Paginazione                                              │
└─────────────────────────┬───────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                       MODEL                                  │
│  • Eloquent ORM                                             │
│  • Relazioni                                                │
│  • Accessors/Mutators                                       │
│  • Scopes                                                   │
└─────────────────────────────────────────────────────────────┘
```

### Struttura Directory

```
app/
├── Console/Commands/
│   └── CheckArchitecture.php    # Verifica coerenza progetto
│
├── Http/Controllers/
│   ├── Controller.php           # Base controller
│   ├── HomeController.php       # Homepage
│   ├── EventController.php      # Shop by Event
│   ├── ProductController.php    # Catalogo prodotti
│   └── PageController.php       # Pagine statiche
│
├── Models/
│   ├── Event.php                # belongsToMany(Product)
│   ├── Product.php              # belongsToMany(Event)
│   └── User.php                 # Laravel default
│
├── Providers/
│   ├── RepositoryServiceProvider.php  # DI bindings
│   └── ViewServiceProvider.php        # View composers
│
├── Repositories/
│   ├── Contracts/               # Interfacce
│   ├── ProductRepository.php
│   └── EventRepository.php
│
├── Services/
│   ├── Contracts/               # Interfacce
│   ├── ProductService.php       # Cache TTL: 3600s
│   └── EventService.php         # Cache TTL: 7200s
│
└── View/Composers/
    └── NavigationComposer.php   # $events globale
```

### Database Schema

```sql
-- Eventi (Occasioni)
events
├── id, name, slug, description
├── image, meta_title, meta_description
├── is_active, sort_order
└── timestamps, soft_deletes

-- Prodotti
products
├── id, name, slug, description, short_description
├── price, sale_price, sku, stock_quantity
├── is_active, is_featured, is_handmade
├── main_image, gallery_images (JSON)
├── materials, dimensions, weight
├── meta_title, meta_description
└── timestamps, soft_deletes

-- Pivot (Many-to-Many)
event_product
├── event_id, product_id
├── is_featured_in_event, sort_order
└── timestamps
```

---

## 🎨 Design System

### Palette Colori

| Nome | Colore | Uso |
|------|--------|-----|
| **Primary** | ![#F5F5DC](https://via.placeholder.com/15/F5F5DC/F5F5DC.png) `#F5F5DC` Beige | Background, buttons |
| **Secondary** | ![#B0C4DE](https://via.placeholder.com/15/B0C4DE/B0C4DE.png) `#B0C4DE` Carta da Zucchero | Links, accents |
| **Accent** | ![#D4AF37](https://via.placeholder.com/15/D4AF37/D4AF37.png) `#D4AF37` Gold | Highlights, badges |
| **Content** | ![#2D2D2D](https://via.placeholder.com/15/2D2D2D/2D2D2D.png) `#2D2D2D` Dark Grey | Text, icons |

### Tipografia

| Font | Tipo | Uso |
|------|------|-----|
| **Great Vibes** | Display (Cursive) | Hero titles, brand |
| **Playfair Display** | Heading (Serif) | H1, H2, H3 |
| **Lato** | Body (Sans-serif) | Paragraphs, UI |
| **Montserrat** | Body (Sans-serif) | Buttons, labels |

### Componenti CSS

```css
/* Buttons */
.btn-primary    /* Beige filled */
.btn-secondary  /* Outlined */
.btn-ghost      /* Transparent */

/* Cards */
.card-product   /* Product card con shadow */
.card-event     /* Event card con overlay */

/* Navigation */
.nav-link       /* Link navigazione */

/* Forms */
.form-input     /* Input fields */
.form-select    /* Select dropdown */
```

---

## 🗺️ Roadmap

### ✅ Fase 1: Fondamenta (Completata)
- [x] Setup Laravel 12 + Supabase
- [x] Service-Repository Pattern
- [x] Modelli Event e Product
- [x] Homepage e catalogo
- [x] Design Tailwind + Alpine.js

### 🔄 Fase 2: Core E-Commerce (In Progress)
- [ ] Backend carrello (sessioni)
- [ ] Checkout flow
- [ ] Sistema ordini
- [ ] Autenticazione utenti

### 📋 Fase 3: Features Avanzate
- [ ] Pannello Admin
- [ ] Upload immagini
- [ ] Email transazionali
- [ ] Sistema recensioni
- [ ] Wishlist

### 🚀 Fase 4: Production
- [ ] Test suite
- [ ] CI/CD Pipeline
- [ ] Performance optimization
- [ ] SEO avanzato
- [ ] Analytics

---

## 🧪 Testing

```bash
# Esegui tutti i test
php artisan test

# Test con coverage
php artisan test --coverage

# Test specifico
php artisan test --filter=ProductServiceTest
```

### Verifica Architettura

Il progetto include un comando custom per verificare la coerenza:

```bash
php artisan app:check-architecture

# Output dettagliato
php artisan app:check-architecture --detailed
```

Questo comando verifica:
- ✅ Esistenza di tutti i Models, Controllers, Services
- ✅ Tabelle database presenti
- ✅ Views Blade esistenti
- ✅ Route definite
- ✅ Binding DI configurati
- 📝 Genera report in `TODO.md`

---

## 📁 File Importanti

| File | Descrizione |
|------|-------------|
| `ARCHITECTURE.md` | Mappa concettuale del progetto |
| `TODO.md` | Task list con priorità |
| `.env.example` | Template variabili ambiente |
| `tailwind.config.js` | Configurazione Tailwind custom |
| `vite.config.js` | Configurazione build |

---

## 🤝 Contributing

Le contribuzioni sono benvenute! Per contribuire:

1. Fork del repository
2. Crea un branch (`git checkout -b feature/AmazingFeature`)
3. Commit delle modifiche (`git commit -m 'Add AmazingFeature'`)
4. Push al branch (`git push origin feature/AmazingFeature`)
5. Apri una Pull Request

### Coding Standards

- PSR-12 per PHP
- Type hints obbligatori
- Commenti in italiano o inglese
- Test per nuove features

---

## 📄 Licenza

Distribuito sotto licenza MIT. Vedi `LICENSE` per maggiori informazioni.

---

## 👤 Autore

**Carmelo La Mantia** - [@MeloLM](https://github.com/MeloLM)

---

## 🙏 Ringraziamenti

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Alpine.js](https://alpinejs.dev) - Lightweight JS framework
- [Supabase](https://supabase.com) - Open source Firebase alternative
- [Heroicons](https://heroicons.com) - Beautiful hand-crafted SVG icons

---

<p align="center">
  Creato con ❤️ per gli artigiani italiani
</p>

<p align="center">
  <a href="https://github.com/MeloLM/Home_Made_AG">⭐ Star this repo</a> •
  <a href="https://github.com/MeloLM/Home_Made_AG/issues">🐛 Report Bug</a> •
  <a href="https://github.com/MeloLM/Home_Made_AG/issues">💡 Request Feature</a>
</p>
