<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    //
    protected $fillable = ['product_id','starts_at','ends_at','limit_per_user'];
    protected $casts = ['starts_at'=>'datetime','ends_at'=>'datetime'];

    public function product(){ return $this->belongsTo(Product::class); }
    public function getActiveAttribute(): bool {
        return now()->between($this->starts_at, $this->ends_at);
    }

}
