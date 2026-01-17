# 🏗️ ARCHITECTURE - Dettagli Boutique E-Commerce

> Mappa concettuale del progetto per navigazione e organizzazione rapida

---

## 📐 Struttura Generale

```
┌─────────────────────────────────────────────────────────────────────┐
│                         PRESENTATION LAYER                           │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐ │
│  │   Blade     │  │  Alpine.js  │  │  Tailwind   │  │    Vite     │ │
│  │   Views     │  │  Components │  │     CSS     │  │   Builder   │ │
│  └──────┬──────┘  └──────┬──────┘  └─────────────┘  └─────────────┘ │
└─────────┼────────────────┼──────────────────────────────────────────┘
          │                │
          ▼                ▼
┌─────────────────────────────────────────────────────────────────────┐
│                        APPLICATION LAYER                             │
│  ┌─────────────────────────────────────────────────────────────────┐│
│  │                        CONTROLLERS                               ││
│  │  HomeController │ EventController │ ProductController │ Page... ││
│  └────────────────────────────┬────────────────────────────────────┘│
│                               │                                      │
│  ┌────────────────────────────▼────────────────────────────────────┐│
│  │                         SERVICES                                 ││
│  │     ProductService          │         EventService               ││
│  │  (Business Logic + Cache)   │    (Business Logic + Cache)        ││
│  └────────────────────────────┬────────────────────────────────────┘│
└───────────────────────────────┼─────────────────────────────────────┘
                                │
                                ▼
┌─────────────────────────────────────────────────────────────────────┐
│                          DATA LAYER                                  │
│  ┌─────────────────────────────────────────────────────────────────┐│
│  │                       REPOSITORIES                               ││
│  │   ProductRepository         │        EventRepository             ││
│  │  (Data Access + Filters)    │     (Data Access + Filters)        ││
│  └────────────────────────────┬────────────────────────────────────┘│
│                               │                                      │
│  ┌────────────────────────────▼────────────────────────────────────┐│
│  │                         MODELS                                   ││
│  │      Product     │     Event     │     User    │    (Order)      ││
│  │   belongsToMany  │ belongsToMany │  hasMany    │   belongsTo     ││
│  └────────────────────────────┬────────────────────────────────────┘│
└───────────────────────────────┼─────────────────────────────────────┘
                                │
                                ▼
┌─────────────────────────────────────────────────────────────────────┐
│                      DATABASE (Supabase PostgreSQL)                  │
│  ┌─────────┐ ┌─────────┐ ┌─────────────┐ ┌───────┐ ┌───────────────┐│
│  │ events  │ │products │ │event_product│ │ users │ │ orders (TODO) ││
│  └─────────┘ └─────────┘ └─────────────┘ └───────┘ └───────────────┘│
└─────────────────────────────────────────────────────────────────────┘
```

---

## 📂 File System Map

```pseudocode
HomeMade_web/
│
├── app/                          # APPLICATION CODE
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php         # BASE: Abstract controller
│   │       ├── HomeController.php     # ROUTE: / (homepage)
│   │       ├── EventController.php    # ROUTE: /eventi, /eventi/{slug}
│   │       ├── ProductController.php  # ROUTE: /prodotti, /prodotti/{slug}
│   │       ├── PageController.php     # ROUTE: /chi-siamo, /contatti, etc.
│   │       ├── CartController.php     # TODO: /carrello
│   │       └── OrderController.php    # TODO: /checkout, /ordini
│   │
│   ├── Models/
│   │   ├── Event.php                  # MODEL: Eventi/Occasioni
│   │   │   └── RELATIONS: belongsToMany(Product)
│   │   ├── Product.php                # MODEL: Prodotti gioielli
│   │   │   └── RELATIONS: belongsToMany(Event)
│   │   ├── User.php                   # MODEL: Utenti (Laravel default)
│   │   └── Order.php                  # TODO: Ordini
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php     # Laravel default
│   │   ├── RepositoryServiceProvider.php  # DI: Bind interfaces
│   │   └── ViewServiceProvider.php    # View Composers
│   │
│   ├── Repositories/
│   │   ├── Contracts/
│   │   │   ├── ProductRepositoryInterface.php
│   │   │   └── EventRepositoryInterface.php
│   │   ├── ProductRepository.php      # DATA: Query products
│   │   └── EventRepository.php        # DATA: Query events
│   │
│   ├── Services/
│   │   ├── Contracts/
│   │   │   ├── ProductServiceInterface.php
│   │   │   └── EventServiceInterface.php
│   │   ├── ProductService.php         # LOGIC: Cache 3600s, business rules
│   │   └── EventService.php           # LOGIC: Cache 7200s, business rules
│   │
│   └── View/
│       └── Composers/
│           └── NavigationComposer.php # GLOBAL: $events in header/footer
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php     # Laravel default
│   │   ├── create_events_table.php    # CUSTOM: Eventi
│   │   ├── create_products_table.php  # CUSTOM: Prodotti
│   │   └── create_event_product_table.php  # PIVOT: Many-to-Many
│   │
│   ├── seeders/
│   │   ├── DatabaseSeeder.php         # MAIN: Calls all seeders
│   │   ├── EventSeeder.php            # DATA: 7 eventi italiani
│   │   └── ProductSeeder.php          # DATA: 28 prodotti sample
│   │
│   └── factories/
│       └── ProductFactory.php         # FACTORY: Generate fake products
│
├── resources/
│   ├── css/
│   │   └── app.css                    # TAILWIND: Custom components
│   │
│   ├── js/
│   │   └── app.js                     # ALPINE: Cart store, components
│   │
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php          # LAYOUT: Main wrapper
│       │   └── partials/
│       │       ├── header.blade.php   # PARTIAL: Navigation + search
│       │       ├── footer.blade.php   # PARTIAL: Footer links
│       │       └── search-modal.blade.php
│       │
│       ├── components/
│       │   └── product-card.blade.php # COMPONENT: Reusable card
│       │
│       ├── home.blade.php             # PAGE: Homepage
│       ├── events/
│       │   ├── index.blade.php        # PAGE: All events
│       │   └── show.blade.php         # PAGE: Products by event
│       ├── products/
│       │   ├── index.blade.php        # PAGE: All products
│       │   ├── show.blade.php         # PAGE: Product detail
│       │   └── search.blade.php       # PAGE: Search results
│       ├── pages/
│       │   ├── about.blade.php        # STATIC: Chi siamo
│       │   ├── contact.blade.php      # STATIC: Contatti
│       │   └── ...                    # Other static pages
│       ├── cart/
│       │   └── index.blade.php        # PAGE: Cart (frontend only)
│       └── auth/
│           └── login.blade.php        # TODO: Auth pages
│
├── routes/
│   └── web.php                        # ROUTES: All web routes
│
├── config/                            # Laravel config files
├── public/                            # Public assets + build
├── storage/                           # Logs, cache, uploads
├── vendor/                            # Composer dependencies
│
├── ARCHITECTURE.md                    # THIS FILE
├── TODO.md                            # Tasks and bugs
├── README.md                          # Project documentation
├── .env                               # Environment (git ignored)
├── .env.example                       # Environment template
│
├── tailwind.config.js                 # Tailwind custom config
├── vite.config.js                     # Vite build config
├── package.json                       # NPM dependencies
└── composer.json                      # PHP dependencies
```

---

## 🔄 Request Flow (Pseudocode)

```pseudocode
REQUEST: GET /eventi/matrimonio

1. ROUTER (routes/web.php)
   │
   ├─► MATCH: Route::get('/eventi/{slug}', [EventController::class, 'show'])
   │
   └─► DISPATCH to EventController@show(slug: "matrimonio")

2. CONTROLLER (EventController.php)
   │
   ├─► INJECT: EventServiceInterface $eventService
   ├─► INJECT: ProductServiceInterface $productService
   │
   ├─► CALL: $event = $eventService->getBySlug("matrimonio")
   │         └─► SERVICE checks cache
   │             └─► CACHE MISS: calls EventRepository->findBySlug()
   │                 └─► REPOSITORY: Event::where('slug', $slug)->firstOrFail()
   │                     └─► MODEL: Returns Event with products relation
   │
   ├─► CALL: $products = $productService->getByEvent($event->id, $filters)
   │         └─► Similar flow through Service → Repository → Model
   │
   └─► RETURN: view('events.show', compact('event', 'products'))

3. VIEW (events/show.blade.php)
   │
   ├─► EXTENDS: layouts.app
   │   └─► INCLUDES: partials.header (with $events from NavigationComposer)
   │   └─► INCLUDES: partials.footer
   │
   ├─► LOOPS: @foreach($products as $product)
   │   └─► COMPONENT: components.product-card
   │
   └─► ALPINE.JS: x-data="addToCart()" handles interactions

4. RESPONSE: HTML rendered with Tailwind CSS + Alpine.js
```

---

## 🗃️ Database Schema

```pseudocode
TABLE: events
├── id: BIGINT PRIMARY KEY
├── name: VARCHAR(255)
├── slug: VARCHAR(255) UNIQUE
├── description: TEXT
├── image: VARCHAR(255)
├── meta_title: VARCHAR(255)
├── meta_description: TEXT
├── is_active: BOOLEAN DEFAULT true
├── sort_order: INTEGER DEFAULT 0
├── created_at: TIMESTAMP
├── updated_at: TIMESTAMP
└── deleted_at: TIMESTAMP (soft delete)

TABLE: products
├── id: BIGINT PRIMARY KEY
├── name: VARCHAR(255)
├── slug: VARCHAR(255) UNIQUE
├── description: TEXT
├── short_description: VARCHAR(500)
├── price: DECIMAL(10,2)
├── sale_price: DECIMAL(10,2) NULLABLE
├── sku: VARCHAR(100) UNIQUE
├── stock_quantity: INTEGER DEFAULT 0
├── is_active: BOOLEAN DEFAULT true
├── is_featured: BOOLEAN DEFAULT false
├── is_handmade: BOOLEAN DEFAULT true
├── main_image: VARCHAR(255)
├── gallery_images: JSON
├── materials: VARCHAR(255)
├── dimensions: VARCHAR(255)
├── weight: DECIMAL(8,2)
├── meta_title: VARCHAR(255)
├── meta_description: TEXT
├── created_at: TIMESTAMP
├── updated_at: TIMESTAMP
└── deleted_at: TIMESTAMP

TABLE: event_product (PIVOT)
├── id: BIGINT PRIMARY KEY
├── event_id: BIGINT FOREIGN KEY → events.id
├── product_id: BIGINT FOREIGN KEY → products.id
├── is_featured_in_event: BOOLEAN DEFAULT false
├── sort_order: INTEGER DEFAULT 0
├── created_at: TIMESTAMP
└── updated_at: TIMESTAMP

TABLE: users (Laravel default)
├── id, name, email, password, etc.

TABLE: orders (TODO)
├── id, user_id, status, total, shipping_address, etc.

TABLE: order_items (TODO)
├── id, order_id, product_id, quantity, price, etc.
```

---

## 🎨 Design System

```pseudocode
COLORS:
├── primary: Beige/Cream (#F5F5DC → #FAF0E6)
│   └── Used for: backgrounds, buttons, accents
├── secondary: Carta da Zucchero (#B0C4DE → #87CEEB)
│   └── Used for: links, highlights, secondary buttons
├── content: Dark Grey (#2D2D2D → #6B7280)
│   └── Used for: text, icons
├── accent: Gold (#D4AF37)
│   └── Used for: special elements, badges
├── success: Green (#10B981)
├── warning: Amber (#F59E0B)
└── danger: Red (#EF4444)

TYPOGRAPHY:
├── display: "Great Vibes" (cursive)
│   └── Used for: hero titles, special headings
├── heading: "Playfair Display" (serif)
│   └── Used for: h1, h2, h3
├── body: "Lato", "Montserrat" (sans-serif)
│   └── Used for: paragraphs, UI text
└── mono: System monospace
    └── Used for: code, SKU

COMPONENTS (Tailwind @apply):
├── .btn-primary: Beige button with hover
├── .btn-secondary: Outlined button
├── .btn-ghost: Transparent button
├── .card-product: Product card with shadow
├── .card-event: Event card with overlay
├── .nav-link: Navigation links
├── .badge-*: Status badges
└── .form-*: Form inputs
```

---

## ⚡ Service Layer Rules

```pseudocode
SERVICE PATTERN:
│
├── INTERFACE: app/Services/Contracts/*Interface.php
│   └── Define method signatures
│
├── IMPLEMENTATION: app/Services/*Service.php
│   ├── INJECT: Repository via constructor
│   ├── CACHE: Use Cache::remember() for read operations
│   │   └── TTL: Products = 3600s, Events = 7200s
│   ├── VALIDATE: Business rules before operations
│   ├── TRANSFORM: Format data for presentation
│   └── CLEAR CACHE: On create/update/delete
│
└── BINDING: app/Providers/RepositoryServiceProvider.php
    └── $this->app->bind(Interface::class, Implementation::class)

REPOSITORY PATTERN:
│
├── INTERFACE: app/Repositories/Contracts/*Interface.php
│   └── Define data access methods
│
├── IMPLEMENTATION: app/Repositories/*Repository.php
│   ├── INJECT: Model via constructor
│   ├── QUERY: Use Eloquent for database access
│   ├── FILTER: applyFilters() method
│   ├── SORT: applySorting() method
│   └── PAGINATE: Return LengthAwarePaginator
│
└── NO CACHING: Cache only in Service layer
```

---

## 🔌 Dependency Injection Map

```pseudocode
PROVIDERS REGISTERED (bootstrap/providers.php):
├── AppServiceProvider
├── RepositoryServiceProvider
└── ViewServiceProvider

BINDINGS (RepositoryServiceProvider):
├── ProductRepositoryInterface → ProductRepository
├── EventRepositoryInterface → EventRepository
├── ProductServiceInterface → ProductService
└── EventServiceInterface → EventService

COMPOSERS (ViewServiceProvider):
└── NavigationComposer → ['layouts.partials.header', 'layouts.partials.footer']
    └── Shares: $events (all active events for nav menu)
```

---

## 🧪 Testing Strategy (TODO)

```pseudocode
tests/
├── Feature/
│   ├── HomePageTest.php
│   │   └── test_homepage_displays_events_and_products()
│   ├── EventTest.php
│   │   └── test_event_page_shows_related_products()
│   ├── ProductTest.php
│   │   └── test_product_detail_page_loads()
│   └── CartTest.php (TODO)
│
└── Unit/
    ├── ProductServiceTest.php
    │   └── test_featured_products_are_cached()
    ├── EventServiceTest.php
    └── RepositoryTest.php
```

---

## 🚀 Commands Reference

```bash
# Development
php artisan serve              # Start dev server
npm run dev                    # Vite dev mode (hot reload)
npm run build                  # Build for production

# Database
php artisan migrate            # Run migrations
php artisan migrate:fresh --seed  # Reset + seed
php artisan db:seed            # Seed only

# Cache
php artisan cache:clear        # Clear app cache
php artisan config:clear       # Clear config cache
php artisan view:clear         # Clear compiled views
php artisan optimize           # Optimize for production

# Architecture Check
php artisan app:check-architecture  # Verify project structure
```

---

## 📋 Verification Checklist

```pseudocode
ARCHITECTURE CHECK:
│
├── MODELS: Verify all models exist and have correct relations
├── CONTROLLERS: Verify all controllers extend base Controller
├── SERVICES: Verify all services implement their interface
├── REPOSITORIES: Verify all repositories implement their interface
├── VIEWS: Verify all routes have corresponding views
├── ROUTES: Verify all routes point to existing controllers
├── MIGRATIONS: Verify all tables exist in database
├── SEEDERS: Verify seeders don't throw errors
└── CONFIG: Verify .env has all required variables

OUTPUT: Updates TODO.md with issues found
```
