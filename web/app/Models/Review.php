<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = 'id';

    protected $fillable = [
        'proid',
        'userid',
        'review',
        'comment',
        'status',        
    ];

    public function products(){
        return $this->belongsTo(Product::class,'proid','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'userid','id');
    }
}
