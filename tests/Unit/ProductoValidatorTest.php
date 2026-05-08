<?php

namespace Tests\Unit;

use App\Services\ProductoValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProductoValidatorTest extends TestCase
{
    private ProductoValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new ProductoValidator();
    }

    #[Test]
    public function valida_que_precio_venta_sea_mayor_que_precio_compra()
    {
        $resultado = $this->validator->validarPrecios(10.00, 15.00);
        $this->assertTrue($resultado);
    }

    #[Test]
    public function rechaza_precio_venta_menor_que_precio_compra()
    {
        $resultado = $this->validator->validarPrecios(10.00, 8.00);
        $this->assertFalse($resultado);
    }
}