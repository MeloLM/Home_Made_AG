<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/PostgreSQL-Supabase-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
</p>

<p align="center">
  <img src="https://img.shields.io/github/license/MeloLM/Home_Made_AG?style=flat-square" alt="License">
  <img src="https://img.shields.io/github/last-commit/MeloLM/Home_Made_AG?style=flat-square" alt="Last Commit">
  <img src="https://img.shields.io/github/issues/MeloLM/Home_Made_AG?style=flat-square" alt="Issues">
  <img src="https://img.shields.io/github/stars/MeloLM/Home_Made_AG?style=flat-square" alt="Stars">
</p>

<h1 align="center">
  <br>
  <img src="https://raw.githubusercontent.com/MeloLM/Home_Made_AG/main/public/images/logo.png" alt="Gioielli Artigianali" width="200">
  <br>
  Gioielli Artigianali
  <br>
</h1>

<h4 align="center">E-Commerce per Gioielli Fatti a Mano | Collane • Bracciali • Rosari</h4>

<p align="center">
  <a href="#-quick-start">Quick Start</a> •
  <a href="#-features">Features</a> •
  <a href="#-tech-stack">Tech Stack</a> •
  <a href="#-architecture">Architecture</a> •
  <a href="#-roadmap">Roadmap</a> •
  <a href="#-contributing">Contributing</a>
</p>

---

## About

**Gioielli Artigianali** is a monolithic e-commerce application built with Laravel 12, designed for selling handcrafted jewelry. The project combines Italian artisan passion with modern web development practices.

### Key Concepts

| Concept | Description |
|---------|-------------|
| **Craftsmanship First** | Each product is presented as a unique work of art |
| **Shop by Event** | Products categorized by occasion, not by type |
| **Elegant Design** | Neutral, refined color palette that highlights jewelry |
| **Clean Code** | SOLID architecture with professional patterns |

---

## Quick Start

```bash
# Clone the repository
git clone https://github.com/MeloLM/Home_Made_AG.git
cd Home_Made_AG

# Install dependencies
composer install && npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database (configure .env first)
php artisan migrate --seed

# Build & serve
npm run build && php artisan serve
```

> **Note:** See [Installation](#-installation) for detailed Supabase configuration.

---

## Features

### Design & UX

- **Neutral & Elegant Theme** - Beige/Cream palette with Carta da Zucchero accents
- **Responsive Design** - Mobile-first, optimized for all devices
- **Curated Typography** - Great Vibes + Playfair Display + Lato
- **Smooth Animations** - CSS transitions and Alpine.js interactions

### E-Commerce

- **Shop by Event** - Navigation by occasion (7 events)
- **Product Catalog** - Filters, sorting, search
- **Product Detail** - Gallery, materials, dimensions
- **Shopping Cart** - Alpine.js + localStorage management
- **Wishlist** - Coming soon

### Technical

- **Service-Repository Pattern** - Separation of concerns
- **Strategic Caching** - Cache on Service layer
- **PSR-12 Compliant** - PHP coding standard
- **Type Hints** - PHP 8.2+ strict typing
- **Architecture Check** - Custom command for consistency verification

---

## Tech Stack

<table>
<tr>
<td valign="top" width="50%">

### Backend

<img src="https://img.shields.io/badge/Laravel-12.47.0-FF2D20?style=flat&logo=laravel&logoColor=white">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white">

- Eloquent ORM
- Blade Templates
- Artisan CLI
- Service Container

</td>
<td valign="top" width="50%">

### Frontend

<img src="https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=flat&logo=tailwind-css&logoColor=white">
<img src="https://img.shields.io/badge/Alpine.js-3.13-8BC0D0?style=flat&logo=alpine.js&logoColor=white">
<img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=flat&logo=vite&logoColor=white">

- Custom Components
- Reactive JavaScript
- Hot Module Reload

</td>
</tr>
<tr>
<td valign="top" width="50%">

### Database

<img src="https://img.shields.io/badge/PostgreSQL-Supabase-336791?style=flat&logo=postgresql&logoColor=white">

- Cloud hosted
- Session pooler (IPv4)
- Real-time capabilities

</td>
<td valign="top" width="50%">

### DevOps

<img src="https://img.shields.io/badge/Git-GitHub-181717?style=flat&logo=github&logoColor=white">

- Version control
- CI/CD ready
- GitHub Actions compatible

</td>
</tr>
</table>

---

## Architecture

### Service-Repository Pattern

```
Request → Controller → Service → Repository → Model → Database
              ↓            ↓
           Validate    Cache + Logic
```

### Directory Structure

```
app/
├── Console/Commands/        # Artisan commands
├── Http/Controllers/        # Request handlers
├── Models/                  # Eloquent models
├── Providers/               # Service providers
├── Repositories/            # Data access layer
│   └── Contracts/           # Interfaces
├── Services/                # Business logic layer
│   └── Contracts/           # Interfaces
└── View/Composers/          # View data injection
```

### Database Schema

```
events ──────────┐
  │              │
  │    event_product (pivot)
  │              │
products ────────┘

users
cache
jobs
```

---

## Installation

### Prerequisites

| Requirement | Version | Check |
|-------------|---------|-------|
| PHP | 8.2+ | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 18+ | `node -v` |
| npm | 9+ | `npm -v` |

### Supabase Configuration

1. Create a project at [supabase.com](https://supabase.com)
2. Go to **Settings → Database**
3. Select **Session Pooler** (for IPv4)
4. Update your `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.YOUR_PROJECT_REF
DB_PASSWORD=YOUR_PASSWORD
```

### Commands Reference

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start local server |
| `npm run dev` | Vite with hot reload |
| `npm run build` | Production build |
| `php artisan migrate:fresh --seed` | Reset database |
| `php artisan app:check-architecture` | Verify project structure |

---

## Design System

### Color Palette

| Name | Hex | Preview | Usage |
|------|-----|---------|-------|
| Primary | `#F5F5DC` | ![Primary](https://img.shields.io/badge/-F5F5DC-F5F5DC?style=flat-square) | Background, buttons |
| Secondary | `#B0C4DE` | ![Secondary](https://img.shields.io/badge/-B0C4DE-B0C4DE?style=flat-square) | Links, accents |
| Accent | `#D4AF37` | ![Accent](https://img.shields.io/badge/-D4AF37-D4AF37?style=flat-square) | Highlights, badges |
| Content | `#2D2D2D` | ![Content](https://img.shields.io/badge/-2D2D2D-2D2D2D?style=flat-square) | Text, icons |

### Typography

| Font | Type | Usage |
|------|------|-------|
| Great Vibes | Display | Hero titles, brand |
| Playfair Display | Heading | H1, H2, H3 |
| Lato | Body | Paragraphs, UI |
| Montserrat | Body | Buttons, labels |

---

## Roadmap

- [x] **Phase 1: Foundation** - Laravel 12 + Supabase + Service-Repository Pattern
- [ ] **Phase 2: Core E-Commerce** - Cart backend, checkout, orders, auth
- [ ] **Phase 3: Advanced Features** - Admin panel, image upload, emails, reviews
- [ ] **Phase 4: Production** - Tests, CI/CD, performance, SEO

See [TODO.md](TODO.md) for detailed task list.

---

## Testing

```bash
# Run all tests
php artisan test

# With coverage
php artisan test --coverage

# Architecture verification
php artisan app:check-architecture --detailed
```

---

## Contributing

Contributions are welcome! Please read our contributing guidelines first.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards

- PSR-12 for PHP
- Type hints required
- Tests for new features

---

## License

Distributed under the MIT License. See `LICENSE` for more information.

---

## Author

**Carmelo La Mantia** - [@MeloLM](https://github.com/MeloLM)

---

## Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Alpine.js](https://alpinejs.dev) - Lightweight JS framework
- [Supabase](https://supabase.com) - Open source Firebase alternative

---

<p align="center">
  Made with ❤️ for Italian artisans
  <br><br>
  <a href="https://github.com/MeloLM/Home_Made_AG/stargazers">
    <img src="https://img.shields.io/github/stars/MeloLM/Home_Made_AG?style=social" alt="Stars">
  </a>
</p>
