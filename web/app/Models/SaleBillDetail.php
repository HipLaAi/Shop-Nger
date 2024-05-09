<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleBillDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_bill_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'saleid',
        'name_product',
        'size',
        'color',
        'quantity',
        'price',
        'discount',
        'total',
    ];    

    public function saleBills(){
        return $this->belongsTo(SaleBill::class,'saleid','id');
    }
}
