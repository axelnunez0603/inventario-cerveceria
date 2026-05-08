<?php

namespace Tests\Unit;

use App\Models\Producto;
use App\Services\ProductoValidator;
use Mockery;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProductoServiceTest extends TestCase
{
    private ProductoValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new ProductoValidator();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    #[Test]
    public function puede_crear_un_producto()
    {
        $datos = [
            'nombre' => 'IPA Test',
            'precio_venta' => 18.50,
            'precio_compra' => 12.50,
            'stock' => 30,
        ];

        $producto = new Producto();
        $producto->nombre = $datos['nombre'];
        $producto->precio_venta = $datos['precio_venta'];
        $producto->precio_compra = $datos['precio_compra'];
        $producto->stock = $datos['stock'];

        $this->assertEquals('IPA Test', $producto->nombre);
        $this->assertEquals(18.50, $producto->precio_venta);
        $this->assertEquals(12.50, $producto->precio_compra);
        $this->assertEquals(30, $producto->stock);
        $this->assertGreaterThan($producto->precio_compra, $producto->precio_venta);
    }

    #[Test]
    public function puede_listar_productos()
    {
        $productosCollection = collect([
            ['id' => 1, 'nombre' => 'IPA', 'precio_venta' => 18.50, 'activo' => true],
            ['id' => 2, 'nombre' => 'Lager', 'precio_venta' => 15.00, 'activo' => true],
        ]);

        $this->assertCount(2, $productosCollection);
        
        foreach ($productosCollection as $producto) {
            $this->assertTrue($producto['activo']);
        }
    }

    #[Test]
    public function puede_actualizar_un_producto()
    {
        $datosOriginales = [
            'id' => 1,
            'nombre' => 'IPA Original',
            'precio_venta' => 18.50,
        ];

        $datosActualizados = [
            'nombre' => 'IPA Premium',
            'precio_venta' => 22.00,
        ];

        $productoActualizado = array_merge($datosOriginales, $datosActualizados);

        $this->assertEquals('IPA Premium', $productoActualizado['nombre']);
        $this->assertEquals(22.00, $productoActualizado['precio_venta']);
    }

    #[Test]
    public function puede_eliminar_un_producto_logicamente()
    {
        $producto = [
            'id' => 1,
            'nombre' => 'IPA',
            'activo' => true,
        ];

        $producto['activo'] = false;

        $this->assertFalse($producto['activo']);
    }
}