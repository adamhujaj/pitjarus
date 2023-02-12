<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ="product";
    protected $primaryKey="product_id";
    protected $fillable =[
        'product_id','product_name','brand_id'
    ];
    public function reportProduct()
    {
        return $this->hasMany(ReportProduct::class, 'product_id', 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}

