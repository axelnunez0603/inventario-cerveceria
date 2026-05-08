<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        $precioCompra = $this->faker->randomFloat(2, 5, 15);
        $precioVenta = $precioCompra + $this->faker->randomFloat(2, 2, 10);

        return [
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph(),
            'precio_compra' => $precioCompra,
            'precio_venta' => $precioVenta,
            'unidad_medida' => $this->faker->randomElement(['Botella', 'Lata', 'Vaso']),
            'capacidad_ml' => $this->faker->numberBetween(300, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'stock_minimo' => $this->faker->numberBetween(5, 15),
            'activo' => true,
        ];
    }
}