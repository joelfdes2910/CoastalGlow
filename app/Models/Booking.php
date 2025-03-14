<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

	protected $fillable = ['customer_id', 'staff_id', 'date', 'time', 'total_price', 'status'];

    // Customer Relation (Now Refers to Users Table)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class, 'booking_services')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }


    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
