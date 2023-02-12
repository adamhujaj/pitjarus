<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreArea extends Model
{
    use HasFactory;
    protected $table ="store_area";
    protected $primaryKey="area_id";
    protected $fillable =[
        'area_id','area_name'
    ];

    public function store()
    {
    return $this->hasMany(Store::class, 'area_id', 'area_id');
    }

    public function reportProduct()
    {
    return $this->hasManyThrough(ReportProduct::class, Store::class, 'area_id', 'store_id', 'area_id', 'store_id');
    }
}

