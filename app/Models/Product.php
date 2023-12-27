<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'image',
        'status',
        'description',
        'category_id',
        'purchases',
    ];

    public function orderdetails()
    {
        return  $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
