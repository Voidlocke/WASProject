<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'admin';

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_pass',
        'booking_id',
    ];

    protected $hidden = [
        'admin_pass',
    ];


    // Define relationship with the Booking model
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function getAuthIdentifierName()
    {
        return 'admin_email'; // Column name used for identification (login)
    }

    public function getAuthIdentifier()
    {
        return $this->admin_id; // Return the ID (integer) for session storage
    }

    public function getAuthPassword()
    {
        return $this->admin_pass; // Column name for the password
    }

    // Hash the password when setting it
    public function setAdminPassAttribute($value)
    {
        $this->attributes['admin_pass'] = Hash::make($value);
    }

}
