<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

        protected $fillable = [
        'user_id','product_id','qty','price_cents',
        'reservation_token','expires_at','currency','status'
    ];
    protected $casts = ['expires_at' => 'datetime'];

    public function user(){ return $this->belongsTo(User::class); }
    public function product(){ return $this->belongsTo(Product::class); }
    // public function payment(){ return $this->hasOne(Payment::class); }

}
