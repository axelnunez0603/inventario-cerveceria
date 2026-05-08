<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Collection;

class ProductoService
{
    private ProductoValidator $validator;

    public function __construct(ProductoValidator $validator)
    {
        $this->validator = $validator;
    }

    // Crear producto
    public function crear(array $datos): Producto
    {
        // Validar precios
        $precioCompra = $datos['precio_compra'] ?? 0;
        $precioVenta = $datos['precio_venta'] ?? 0;

        if (!$this->validator->validarPrecios($precioCompra, $precioVenta)) {
            throw new \InvalidArgumentException('El precio de venta debe ser mayor al precio de compra');
        }

        return Producto::create($datos);
    }

    // Listar todos los productos activos
    public function listar(): Collection
    {
        return Producto::where('activo', true)->get();
    }

    // Obtener un producto por ID
    public function obtener(int $id): ?Producto
    {
        return Producto::where('activo', true)->find($id);
    }

    // Actualizar producto
    public function actualizar(int $id, array $datos): Producto
    {
        $producto = $this->obtener($id);

        if (!$producto) {
            throw new \InvalidArgumentException('Producto no encontrado');
        }

        // Validar precios si vienen en los datos
        if (isset($datos['precio_compra']) || isset($datos['precio_venta'])) {
            $precioCompra = $datos['precio_compra'] ?? $producto->precio_compra;
            $precioVenta = $datos['precio_venta'] ?? $producto->precio_venta;

            if (!$this->validator->validarPrecios($precioCompra, $precioVenta)) {
                throw new \InvalidArgumentException('El precio de venta debe ser mayor al precio de compra');
            }
        }

        $producto->update($datos);
        return $producto;
    }

    // Eliminar producto (borrado lógico)
    public function eliminar(int $id): bool
    {
        $producto = $this->obtener($id);

        if (!$producto) {
            throw new \InvalidArgumentException('Producto no encontrado');
        }

        $producto->activo = false;
        return $producto->save();
    }

    // Vender producto (disminuir stock)
    public function vender(int $id, int $cantidad): Producto
    {
        $producto = $this->obtener($id);

        if (!$producto) {
            throw new \InvalidArgumentException('Producto no encontrado');
        }

        $producto->vender($cantidad);
        $producto->save();

        return $producto;
    }

    // Aumentar stock
    public function aumentarStock(int $id, int $cantidad): Producto
    {
        $producto = $this->obtener($id);

        if (!$producto) {
            throw new \InvalidArgumentException('Producto no encontrado');
        }

        $producto->aumentarStock($cantidad);
        $producto->save();

        return $producto;
    }
}