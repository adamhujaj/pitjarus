<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = "product_brand";
    protected $primaryKey = "brand_id";
    protected $fillable = [
        'brand_id', 'brand_name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }

    public function reportProduct()
    {
        return $this->hasManyThrough(ReportProduct::class, Product::class, 'brand_id', 'product_id', 'brand_id', 'product_id');
    }

}
