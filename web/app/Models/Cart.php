<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'userid',
    ];

    public function users(){
        return $this->belongsTo(User::class,'userid','id');
    }

    public function cartDetails(){
        return $this->hasMany(CartDetail::class,'cartid','id');
    }
}
