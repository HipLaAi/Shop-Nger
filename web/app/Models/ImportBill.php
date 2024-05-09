<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportBill extends Model
{
    use HasFactory;

    protected $table = 'import_bills';

    protected $primaryKey = 'id';

    protected $fillable = [
        'provid',
        'userid',
        'moneytotal',
    ];

    public function users(){
        return $this->belongsTo(User::class,'userid','id');
    }

    public function providers(){
        return $this->belongsTo(Provider::class,'provid','id');
    }

    public function importBillDetails(){
        return $this->hasMany(ImportBillDetail::class,'impid','id');
    }
}
