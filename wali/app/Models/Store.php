<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table ="store";
    protected $primaryKey="store_id";
    protected $fillable =[
        'store_id','store_name','account_id','area_id','is_active'
    ];
    public function reportProduct()
    {
        return $this->hasMany(ReportProduct::class, 'store_id', 'store_id');
    }
    public function account()
    {
        return $this->belongsTo(StoreAcount::class, 'account_id', 'account_id');
    }
    public function area()
    {
        return $this->belongsTo(StoreArea::class, 'area_id', 'area_id');
    }
}
