<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_factory_puede_crear_un_modelo_producto(): void
    {
        $producto = Producto::factory()->make();

        $this->assertInstanceOf(Producto::class, $producto);
        $this->assertNotEmpty($producto->nombre);
        $this->assertNotEmpty($producto->precio_venta);
        $this->assertNotEmpty($producto->precio_compra);
        $this->assertNotEmpty($producto->stock);
        $this->assertNotEmpty($producto->stock_minimo);
    }

    public function test_un_producto_puede_guardarse_en_la_base_de_datos(): void
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Cerveza Artesanal IPA',
            'precio_venta' => 18.50,
            'precio_compra' => 12.50,
            'stock' => 30,
            'stock_minimo' => 5,
            'activo' => true,
        ]);

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Cerveza Artesanal IPA',
            'precio_venta' => 18.50,
            'precio_compra' => 12.50,
            'stock' => 30,
            'stock_minimo' => 5,
            'activo' => true,
        ]);
    }

    public function test_determina_cuando_un_producto_tiene_stock_bajo(): void
    {
        $producto = Producto::factory()->make([
            'stock' => 3,
            'stock_minimo' => 5,
        ]);

        $this->assertTrue($producto->tieneStockBajo());
    }
}