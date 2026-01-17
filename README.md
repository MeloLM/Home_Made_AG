# 💎 Gioielli Artigianali - E-Commerce

Un'applicazione e-commerce monolitica per la vendita di gioielli artigianali fatti a mano (collane, bracciali, rosari).

## ✨ Caratteristiche

- 🎨 **Design Elegante**: Tema "Neutral & Elegant" con palette Beige/Cream e Carta da Zucchero
- 🛍️ **Shop by Event**: Prodotti categorizzati per evento (Battesimo, Comunione, Matrimonio, etc.)
- 🏗️ **Architettura Pulita**: Service-Repository Pattern con PSR-12 e principi SOLID
- 📱 **Responsive**: Design mobile-first con Tailwind CSS
- ⚡ **Performante**: Caching strategico e ottimizzazioni

## 🛠️ Stack Tecnologico

- **Backend**: Laravel 11.x
- **Frontend**: Tailwind CSS 3.4 + Alpine.js 3.x
- **Database**: PostgreSQL (Supabase)
- **Build Tool**: Vite 5.x

## 📦 Installazione

### Prerequisiti

- PHP 8.2+
- Composer
- Node.js 18+
- Account Supabase

### Setup

1. **Clona il repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/HomeMade_web.git
   cd HomeMade_web
   ```

2. **Installa le dipendenze PHP**
   ```bash
   composer install
   ```

3. **Installa le dipendenze Node.js**
   ```bash
   npm install
   ```

4. **Configura l'ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configura Supabase**
   
   Nel file `.env`, configura le credenziali del database:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=db.YOUR_PROJECT_REF.supabase.co
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres
   DB_PASSWORD=YOUR_PASSWORD
   ```

6. **Esegui le migrazioni**
   ```bash
   php artisan migrate --seed
   ```

7. **Compila gli asset**
   ```bash
   npm run dev
   ```

8. **Avvia il server**
   ```bash
   php artisan serve
   ```

## 🗂️ Struttura del Progetto

```
├── app/
│   ├── Http/Controllers/     # Controller (Home, Event, Product, Page)
│   ├── Models/               # Eloquent Models (Event, Product)
│   ├── Providers/            # Service Providers
│   ├── Repositories/         # Repository Pattern
│   │   └── Contracts/        # Interfacce Repository
│   └── Services/             # Business Logic Layer
│       └── Contracts/        # Interfacce Service
├── database/
│   ├── factories/            # Model Factories
│   ├── migrations/           # Database Migrations
│   └── seeders/              # Database Seeders
├── resources/
│   ├── css/                  # Tailwind CSS
│   ├── js/                   # Alpine.js
│   └── views/                # Blade Templates
│       ├── components/       # Componenti riutilizzabili
│       ├── events/           # Viste eventi
│       ├── layouts/          # Layout base
│       ├── pages/            # Pagine statiche
│       └── products/         # Viste prodotti
└── routes/
    └── web.php               # Route definitions
```

## 🎨 Design System

### Palette Colori

| Colore | Variabile | Hex |
|--------|-----------|-----|
| Primary (Beige) | `primary-500` | `#F5F5DC` |
| Secondary (Carta da Zucchero) | `secondary-500` | `#B0C4DE` |
| Content | `content-700` | `#4A4A4A` |
| Accent | `accent-500` | `#D4AF37` |

### Tipografia

- **Display**: Great Vibes (corsivo elegante)
- **Headings**: Playfair Display (serif)
- **Body**: Lato, Montserrat (sans-serif)

## 📝 Eventi Disponibili

- 🍼 Battesimo
- ✝️ Prima Comunione
- ⛪ Cresima
- 💒 Matrimonio
- 🎓 Laurea
- 💍 Anniversario
- 🎁 Regalo Speciale

## 🔗 Integrazione Supabase

Questo progetto utilizza **Supabase** come database PostgreSQL:

1. Crea un nuovo progetto su [supabase.com](https://supabase.com)
2. Vai su **Settings > Database** e copia le credenziali
3. Configura le variabili nel `.env`
4. Connetti GitHub al progetto Supabase per deployment automatici

## 🚀 Deployment

### Con Supabase + Vercel/Railway

1. Collega il repository GitHub a Supabase
2. Configura le variabili d'ambiente sulla piattaforma di hosting
3. Deploy automatico ad ogni push

## 📄 Licenza

Questo progetto è sotto licenza MIT.

---

Creato con ❤️ per gli artigiani italiani
