<?php

namespace App\Services;

class ProductoValidator
{
    public function validarPrecios(float $precioCompra, float $precioVenta): bool
    {
        return $precioVenta > $precioCompra;
    }
}