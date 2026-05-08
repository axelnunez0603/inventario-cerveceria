<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

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

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'activo' => 'boolean',
    ];

    // Método para verificar stock bajo
    public function tieneStockBajo(): bool
    {
        return $this->stock <= $this->stock_minimo;
    }

    // Método para vender (disminuir stock)
    public function vender(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new \InvalidArgumentException('La cantidad a vender debe ser positiva');
        }

        if ($cantidad > $this->stock) {
            throw new \InvalidArgumentException('No hay suficiente stock disponible');
        }

        $this->stock -= $cantidad;
    }

    // Método para aumentar stock (entrada de mercadería)
    public function aumentarStock(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new \InvalidArgumentException('La cantidad debe ser positiva');
        }

        $this->stock += $cantidad;
    }
}