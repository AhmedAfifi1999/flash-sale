<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id','provider','amount_cents','currency','status','external_id','meta'
    ];
    protected $casts = ['meta' => 'array'];

    public function order(){ return $this->belongsTo(Order::class); }
}
