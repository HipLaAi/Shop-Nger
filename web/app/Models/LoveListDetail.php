<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoveListDetail extends Model
{
    use HasFactory;

    protected $table = 'love_list_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'loveid',
        'proid',
        'price',
        'discount',
        'status',
    ];

    public function loves(){
        return $this->belongsTo(Love::class,'loveid','id');
    }

    public function products(){
        return $this->belongsTo(Product::class,'proid','id');
    }
}
