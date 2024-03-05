<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'talla' => $this->faker->randomElement(['S', 'M', 'L']),
            'genero' => $this->faker->randomElement(['Hombre', 'Mujer']),
            'color' => $this->faker->colorName,
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
