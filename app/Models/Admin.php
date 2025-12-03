<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'admin_pass', 'remember_token',
    ];

    public function index()
    {
        // Return the admin dashboard view
        return view('admin');
    }

    // Define relationship with the Booking model
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function getAuthIdentifierName()
    {
        return 'admin_email'; // Column name used for identification
    }

    public function getAuthPassword()
    {
        return $this->admin_pass; // Column name for the password
    }

    // Override validateCredentials to use custom 'admin_pass'
    public static function validateCredentials($user, array $credentials)
    {
        return Hash::check($credentials['admin_pass'], $user->getAuthPassword());
    }

    // Hash the password when setting it
    public function setAdminPassAttribute($value)
    {
        $this->attributes['admin_pass'] = Hash::make($value);
    }

}
