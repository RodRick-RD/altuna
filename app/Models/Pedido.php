<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table='venta';
    protected $fillable = [
        'comprobante',
        'estado',
        'user_id',
        'latitud',
        'longitud',
        'factura',
        'razon_social',
        'nit',
        'total',
        'descuento',
    ];
    protected $casts = [
        'fecha' => 'timestamp',
    ];
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
        {
            return $this->belongsToMany(Producto::class, 'venta_producto', 'venta_id', 'producto_id')
                        ->withPivot('cantidad', 'precio');
        }
}
