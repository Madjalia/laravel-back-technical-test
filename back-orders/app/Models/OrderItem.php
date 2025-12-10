<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'unit',
        'quantity',
        'unit_price',
        'subtotal',
    ];
    // Un produit appartient à une commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}