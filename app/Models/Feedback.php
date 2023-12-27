<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = [
        'customer_id',
        'rating',
        'comment',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
