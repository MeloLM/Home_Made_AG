<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Product Seeder
 *
 * Seeds the database with sample handmade jewelry products.
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Rosaries
            [
                'name' => 'Rosario Celestiale',
                'slug' => 'rosario-celestiale',
                'sku' => 'HMJ-ROS-001',
                'description' => 'Un rosario elegante realizzato a mano con perle di vetro celeste e croce in argento 925. Ogni grano è accuratamente selezionato per garantire uniformità e bellezza. Perfetto per il Battesimo o la Prima Comunione.',
                'short_description' => 'Rosario artigianale con perle celesti e croce in argento.',
                'price' => 45.00,
                'stock' => 15,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => true,
                'materials' => 'Perle di vetro, argento 925',
                'dimensions' => 'Lunghezza: 45cm',
                'weight_grams' => 35,
                'events' => ['battesimo', 'prima-comunione'],
            ],
            [
                'name' => 'Rosario della Grazia',
                'slug' => 'rosario-della-grazia',
                'sku' => 'HMJ-ROS-002',
                'description' => 'Rosario raffinato con grani in cristallo bianco e dettagli dorati. La croce centrale è impreziosita da incisioni tradizionali. Un simbolo di fede e devozione.',
                'short_description' => 'Rosario in cristallo bianco con dettagli dorati.',
                'price' => 55.00,
                'stock' => 12,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => true,
                'materials' => 'Cristallo, metallo dorato',
                'dimensions' => 'Lunghezza: 48cm',
                'weight_grams' => 40,
                'events' => ['cresima', 'prima-comunione'],
            ],
            // Bracelets
            [
                'name' => 'Bracciale Armonia',
                'slug' => 'bracciale-armonia',
                'sku' => 'HMJ-BRA-001',
                'description' => 'Bracciale delicato con perle d\'acqua dolce e piccoli cristalli. Il ciondolo a forma di cuore aggiunge un tocco romantico. Ideale come regalo per damigelle o per un anniversario speciale.',
                'short_description' => 'Bracciale con perle d\'acqua dolce e ciondolo a cuore.',
                'price' => 35.00,
                'compare_at_price' => 42.00,
                'stock' => 20,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => true,
                'materials' => 'Perle d\'acqua dolce, argento 925',
                'dimensions' => 'Lunghezza: 18cm (regolabile)',
                'weight_grams' => 15,
                'events' => ['matrimonio', 'anniversario'],
            ],
            [
                'name' => 'Bracciale Prima Luce',
                'slug' => 'bracciale-prima-luce',
                'sku' => 'HMJ-BRA-002',
                'description' => 'Bracciale per bambini realizzato con perline colorate e un piccolo angelo custode. Perfetto per celebrare il Battesimo di una bambina.',
                'short_description' => 'Bracciale per bambini con angelo custode.',
                'price' => 25.00,
                'stock' => 25,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => false,
                'materials' => 'Perline di vetro, metallo anallergico',
                'dimensions' => 'Lunghezza: 14cm (regolabile)',
                'weight_grams' => 8,
                'events' => ['battesimo'],
            ],
            // Necklaces
            [
                'name' => 'Collana Serenità',
                'slug' => 'collana-serenita',
                'sku' => 'HMJ-COL-001',
                'description' => 'Collana elegante con pendente in quarzo rosa naturale. La catena in argento sterling è realizzata con maglie delicate. Un regalo perfetto che simboleggia amore e serenità.',
                'short_description' => 'Collana in argento con pendente in quarzo rosa.',
                'price' => 65.00,
                'stock' => 10,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => true,
                'materials' => 'Quarzo rosa, argento sterling',
                'dimensions' => 'Lunghezza: 50cm + 5cm estensione',
                'weight_grams' => 25,
                'events' => ['regalo-speciale', 'anniversario', 'laurea'],
            ],
            [
                'name' => 'Collana Nuziale Eterna',
                'slug' => 'collana-nuziale-eterna',
                'sku' => 'HMJ-COL-002',
                'description' => 'Collana da sposa con perle Swarovski e cristalli. Design raffinato che incornicia il décolleté con eleganza senza tempo. Ogni pezzo è unico.',
                'short_description' => 'Collana da sposa con perle Swarovski.',
                'price' => 120.00,
                'stock' => 5,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => true,
                'materials' => 'Perle Swarovski, cristalli, argento 925',
                'dimensions' => 'Lunghezza: 42cm',
                'weight_grams' => 45,
                'events' => ['matrimonio'],
            ],
            [
                'name' => 'Collana Successo',
                'slug' => 'collana-successo',
                'sku' => 'HMJ-COL-003',
                'description' => 'Collana con pendente a libro aperto, simbolo di conoscenza e successo. Realizzata in argento con dettagli dorati. Il regalo perfetto per celebrare una laurea.',
                'short_description' => 'Collana con pendente libro per celebrare la laurea.',
                'price' => 48.00,
                'stock' => 18,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => false,
                'materials' => 'Argento 925, dettagli dorati',
                'dimensions' => 'Lunghezza: 45cm',
                'weight_grams' => 20,
                'events' => ['laurea', 'regalo-speciale'],
            ],
            [
                'name' => 'Bracciale Comunione Angelica',
                'slug' => 'bracciale-comunione-angelica',
                'sku' => 'HMJ-BRA-003',
                'description' => 'Bracciale elegante per la Prima Comunione con perle bianche e un piccolo calice in argento. Simboleggia la purezza e il sacramento dell\'Eucaristia.',
                'short_description' => 'Bracciale per Prima Comunione con calice in argento.',
                'price' => 32.00,
                'stock' => 22,
                'is_handmade' => true,
                'is_active' => true,
                'is_featured' => false,
                'materials' => 'Perle di vetro bianco, argento 925',
                'dimensions' => 'Lunghezza: 16cm (regolabile)',
                'weight_grams' => 12,
                'events' => ['prima-comunione'],
            ],
        ];

        foreach ($products as $productData) {
            $eventSlugs = $productData['events'] ?? [];
            unset($productData['events']);

            $product = Product::create($productData);

            // Attach events
            if (! empty($eventSlugs)) {
                $eventIds = Event::whereIn('slug', $eventSlugs)->pluck('id');
                $product->events()->attach($eventIds);
            }
        }

        // Create additional random products using factory
        Product::factory()
            ->count(20)
            ->create()
            ->each(function (Product $product): void {
                // Attach random events
                $eventIds = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $product->events()->attach($eventIds);
            });
    }
}
