<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleBill extends Model
{
    use HasFactory;

    protected $table = 'sale_bills';

    protected $primaryKey = 'id';

    protected $fillable = [
        'userid',
        'fullname',
        'address',
        'email',
        'phone',
        'province',
        'district',
        'ward',
        'street',
        'zip',
        'moneytotal',
        'pay',
        'status', 
    ];    

    public function users(){
        return $this->belongsTo(User::class,'userid','id');
    }

    public function saleBillDetails(){
        return $this->hasMany(SaleBillDetail::class,'saleid','id');
    }
}