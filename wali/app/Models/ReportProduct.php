<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProduct extends Model
{
    use HasFactory;
    public $table ="report_product";
    protected $primaryKey="report_id";
    protected $fillable =[
        'report_id','store_id','product_id','compliance','tanggal'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
