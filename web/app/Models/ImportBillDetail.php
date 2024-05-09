<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportBillDetail extends Model
{
    use HasFactory;

    protected $table = 'import_bill_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'impid',
        'prodid',
        'quantity',
        'price',
        'moneytotal',
        'discount',
    ];

    public function productDetails(){
        return $this->belongsTo(ProductDetail::class,'prodid','id');
    }

    public function importBills(){
        return $this->belongsTo(ImportBill::class,'impid','id');
    }
}
