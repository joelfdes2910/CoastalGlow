<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'description', 'duration', 'price', 'status'];

    public function staff() {
        return $this->belongsToMany(Staff::class, 'staff_services')->withTimestamps();
    }


    public function bookings() {
        return $this->belongsToMany(Booking::class, 'booking_services')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
}
