<?php

namespace Tests\Unit;

use App\Models\Producto;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StockTest extends TestCase
{
    #[Test]
    public function venta_disminuye_stock_correctamente()
    {
        // Crear un producto real (sin base de datos)
        $producto = new Producto();
        $producto->stock = 10;
        
        $producto->vender(3);
        
        $this->assertEquals(7, $producto->stock);
    }

    #[Test]
    public function aumento_stock_correctamente()
    {
        $producto = new Producto();
        $producto->stock = 5;
        
        $producto->aumentarStock(10);
        
        $this->assertEquals(15, $producto->stock);
    }

    #[Test]
    public function no_permite_vender_mas_del_stock_disponible()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No hay suficiente stock disponible');
        
        $producto = new Producto();
        $producto->stock = 5;
        
        $producto->vender(10);
    }
}