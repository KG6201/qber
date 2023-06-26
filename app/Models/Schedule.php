<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getAllOrderByDepartureTime()
    {
        return self::orderBy('departure_time', 'asc')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
