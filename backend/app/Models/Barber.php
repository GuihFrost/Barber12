<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialties',
        'bio',
        'avatar',
        'is_active',
        'experience_years',
        'rating',
    ];

    protected $casts = [
        'specialties' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySpecialty($query, $specialty)
    {
        return $query->whereJsonContains('specialties', $specialty);
    }

    public function getAvailableTimeSlots($date)
    {
        $workingHours = ['09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];
        $bookedSlots = $this->appointments()
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(fn($time) => $time->format('H:i'))
            ->toArray();

        return array_diff($workingHours, $bookedSlots);
    }
}