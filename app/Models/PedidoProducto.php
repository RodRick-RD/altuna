<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    use HasFactory;

    protected $table = 'venta_producto';
    protected $primaryKey = null;
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function venta()
    {
        return $this->belongsTo(Pedido::class, 'venta_id');
    }
}
