<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'unidad_medida',
        'capacidad_ml',
        'stock',
        'stock_minimo',
        'activo',
    ];

    public function tieneStockBajo(): bool
    {
        return $this->stock <= $this->stock_minimo;
    }
}
