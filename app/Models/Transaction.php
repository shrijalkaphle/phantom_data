<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'payment_id',
        'coupon_id',
        'obtained_credits',
        'amount',
        'transaction_status',
    ];
}
