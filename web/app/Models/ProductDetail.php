<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'proid',
        'size',
        'color',
        'quantity',
    ];

    public $timestamps = false;

    public function products(){
        return $this->belongsTo(Product::class,'proid','id');
    }

    public function cartDetails(){
        return $this->hasMany(CartDetail::class,'prodid','id');
    }

    public function importBillDetails(){
        return $this->hasMany(ImportBillDetail::class,'prodid','id');
    }
}
