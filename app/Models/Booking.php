<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//jgn edit yg ada sbb admin nk guna
class Booking extends Model
{
    protected $primaryKey = 'booking_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['user_id', 'room_id', 'check_in_date', 'check_out_date', 'guest_count' , 'booking_status', 'guest_count','booking_status',];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_id)) {
                $model->booking_id = 'BOOK-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'booking_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }

}
