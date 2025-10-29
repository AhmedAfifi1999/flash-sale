<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku','name','price_cents','stock','version','meta'];
    protected $casts = ['meta' => 'array'];

    public function flashSales(){ return $this->hasMany(FlashSale::class); }
     public function orders(){ return $this->hasMany(Order::class); }
}
