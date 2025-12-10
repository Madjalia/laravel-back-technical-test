<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'total',
    ];
// Une commande peut avoir plusieurs produits
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
