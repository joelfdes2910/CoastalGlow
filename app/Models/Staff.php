<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'gender', 'status'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class, 'staff_services')->withTimestamps();
    }

}
