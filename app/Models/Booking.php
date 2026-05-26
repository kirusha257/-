<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_name',
        'phone',
        'email',
        'date',
        'time',
        'guests_count',
        'status',
        'internal_comment',
        'table_number'
    ];
}