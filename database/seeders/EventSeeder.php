<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Event Seeder
 *
 * Seeds the database with common life events for jewelry shopping.
 */
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Battesimo',
                'slug' => 'battesimo',
                'description' => 'Gioielli artigianali per celebrare il sacramento del Battesimo. Rosari, braccialetti e collane perfetti per questo momento speciale.',
                'meta_title' => 'Gioielli per Battesimo | Creazioni Artigianali',
                'meta_description' => 'Scopri la nostra collezione di gioielli artigianali per il Battesimo. Rosari, braccialetti e collane realizzati a mano con amore.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Prima Comunione',
                'slug' => 'prima-comunione',
                'description' => 'Collezione dedicata alla Prima Comunione. Gioielli delicati e significativi per accompagnare i bambini in questo importante giorno.',
                'meta_title' => 'Gioielli per Prima Comunione | Creazioni Artigianali',
                'meta_description' => 'Gioielli artigianali per la Prima Comunione. Rosari e braccialetti creati con cura per un giorno indimenticabile.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Cresima',
                'slug' => 'cresima',
                'description' => 'Gioielli per la Confermazione. Pezzi eleganti che simboleggiano la maturità spirituale e il cammino di fede.',
                'meta_title' => 'Gioielli per Cresima | Creazioni Artigianali',
                'meta_description' => 'Scopri i nostri gioielli per la Cresima. Creazioni artigianali eleganti per celebrare questo importante sacramento.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Matrimonio',
                'slug' => 'matrimonio',
                'description' => 'Gioielli nuziali artigianali. Collane, braccialetti e accessori unici per la sposa e le damigelle.',
                'meta_title' => 'Gioielli per Matrimonio | Creazioni Artigianali',
                'meta_description' => 'Gioielli artigianali per il tuo matrimonio. Pezzi unici per la sposa, le damigelle e regali speciali.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Laurea',
                'slug' => 'laurea',
                'description' => 'Celebra il traguardo accademico con i nostri gioielli. Regali significativi per commemorare anni di impegno.',
                'meta_title' => 'Gioielli per Laurea | Creazioni Artigianali',
                'meta_description' => 'Regali di laurea unici e artigianali. Gioielli che celebrano il successo accademico con stile ed eleganza.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Anniversario',
                'slug' => 'anniversario',
                'description' => 'Gioielli per celebrare gli anniversari. Pezzi romantici e significativi per ricordare momenti speciali.',
                'meta_title' => 'Gioielli per Anniversario | Creazioni Artigianali',
                'meta_description' => 'Festeggia il vostro anniversario con gioielli artigianali unici. Regali romantici creati con amore.',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Regalo Speciale',
                'slug' => 'regalo-speciale',
                'description' => 'La collezione perfetta per ogni occasione speciale. Gioielli artigianali che esprimono affetto e cura.',
                'meta_title' => 'Gioielli Regalo | Creazioni Artigianali',
                'meta_description' => 'Trova il regalo perfetto tra i nostri gioielli artigianali. Pezzi unici per ogni occasione speciale.',
                'is_active' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
