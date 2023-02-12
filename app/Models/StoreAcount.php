<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreAcount extends Model
{
    use HasFactory;
    protected $table ="store_account";
    protected $primaryKey="account_id";
    protected $fillable =[
        'account_id','account_name'
    ];
   
    public function store()
    {
    return $this->hasMany(Store::class, 'account_id', 'account_id');
    }

    // Model StoreAccount
public function reportProduct()
{
    return $this->hasManyThrough(ReportProduct::class, Store::class, 'account_id', 'store_id', 'account_id', 'store_id');
}

   

}
