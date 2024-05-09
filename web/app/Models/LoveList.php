<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoveList extends Model
{
    use HasFactory;

    protected $table = 'love_lists';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'userid',
    ];    

    public function users(){
        return $this->belongsTo(User::class,'userid','id');
    }

    public function loveListDetails(){
        return $this->hasMany(LoveListDetail::class,'loveid','id');
    }
}
