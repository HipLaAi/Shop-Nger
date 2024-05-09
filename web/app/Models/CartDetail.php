<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'cart_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cartid',
        'prodid',
        'price',
        'total',
        'quantity',
        'status',
    ];

    public function carts(){
        return $this->belongsTo(Cart::class,'cartid','id');
    }

    public function productDetails(){
        return $this->belongsTo(ProductDetail::class,'prodid','id');
    }
}
