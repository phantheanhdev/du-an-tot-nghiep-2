<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'table_id',
        'note',
        'total_price',
        'status',
        'phone',
        'customer_phone',
        'order_day',
        'customer_id'
    ];
    public function orderdetails(){
       return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
