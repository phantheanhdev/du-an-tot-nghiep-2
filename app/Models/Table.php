<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'qr'
    ];

    public function orders(){
        return $this->hasMany(Order::class,'table_id','id');
    }
}
