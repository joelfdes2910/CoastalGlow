<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;
	
	protected $table = 'booking_services';

    protected $fillable = ['booking_id', 'service_id', 'quantity', 'price'];
	
	public function services() {
		return $this->belongsToMany(Service::class, 'booking_services')
					->using(BookingService::class)
					->withPivot('quantity', 'price')
					->withTimestamps();
	}
}
