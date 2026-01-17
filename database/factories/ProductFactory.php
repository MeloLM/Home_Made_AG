<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(rand(2, 4), true);
        $price = $this->faker->randomFloat(2, 15, 150);
        $hasComparePrice = $this->faker->boolean(30);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'sku' => strtoupper($this->faker->unique()->bothify('HMJ-####-??')),
            'description' => $this->faker->paragraphs(3, true),
            'short_description' => $this->faker->sentence(15),
            'price' => $price,
            'compare_at_price' => $hasComparePrice ? $price * 1.2 : null,
            'stock' => $this->faker->numberBetween(0, 50),
            'is_handmade' => $this->faker->boolean(90),
            'is_active' => $this->faker->boolean(95),
            'is_featured' => $this->faker->boolean(20),
            'main_image' => null,
            'gallery_images' => null,
            'materials' => $this->faker->randomElement([
                'Perle di vetro, filo d\'argento',
                'Cristalli Swarovski, argento 925',
                'Pietre naturali, cordino in seta',
                'Perle d\'acqua dolce, oro rosa',
                'Ametista, argento sterling',
                'Quarzo rosa, catena dorata',
            ]),
            'dimensions' => $this->faker->randomElement([
                'Lunghezza: 45cm',
                'Lunghezza: 18cm (regolabile)',
                'Diametro: 6cm',
                'Lunghezza: 50cm + 5cm estensione',
            ]),
            'weight_grams' => $this->faker->numberBetween(5, 100),
            'meta_title' => ucwords($name) . ' | Gioielli Artigianali',
            'meta_description' => $this->faker->sentence(20),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the product is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the product is handmade.
     */
    public function handmade(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_handmade' => true,
        ]);
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes): array => [
            'stock' => 0,
        ]);
    }

    /**
     * Indicate that the product is on sale.
     */
    public function onSale(): static
    {
        return $this->state(function (array $attributes): array {
            $price = $attributes['price'] ?? 50;

            return [
                'compare_at_price' => $price * 1.25,
            ];
        });
    }
}
