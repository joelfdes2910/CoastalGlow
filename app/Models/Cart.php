<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

	protected $fillable = ['customer_id', 'session_id'];

    public function customer() {
        return $this->belongsTo(User::class,'us');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
}
