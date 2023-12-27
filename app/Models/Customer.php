<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends  Authenticatable
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $guard = 'customer';
    protected $fillable = [
        'phone',
        'password',
        'point'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
