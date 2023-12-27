<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_amount'
    ];
    use HasFactory;

    public function order(){
       return $this->belongsTo(Order::class);

    }

    public function product(){
        return  $this->belongsTo(Product::class,'product_id');
    }

}
