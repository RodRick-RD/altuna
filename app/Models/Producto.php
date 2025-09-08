<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto';
    protected $fillable=['nombre','descripcion','datostecnicos','cantidad','vendidos','precio','descuento','img','estado','tipo'];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'venta_producto')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }

}

