<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'user_id',
        'user_name',
        'rating',
        'review_text',
        'review_date',
    ];

    protected $casts = [
        'review_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->review_id = Str::random(8);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
