<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'descripcion' => fake()->text(),
            'precio_compra' => fake()->randomFloat(2, 1, 100),
            'precio_venta' => fake()->randomFloat(2, 1, 150),
            'unidad_medida' => fake()->randomElement(['Botella', 'Lata', 'Vaso']),
            'capacidad_ml' => fake()->numberBetween(300, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'stock_minimo' => fake()->numberBetween(5, 15),
            'activo' => true,
        ];
    }
}
