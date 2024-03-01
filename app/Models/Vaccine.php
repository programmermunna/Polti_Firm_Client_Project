<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'period_days',
        'repeat_vaccine',
        'dose_qty',
        'note',
        'status',
        'flag',
        'created_by',
    ];

    protected $casts = [
        'id'             => 'integer',
        'name'           => 'string',
        'slug'           => 'string',
        'period_days'    => 'string',
        'repeat_vaccine' => 'string',
        'dose_qty'       => 'string',
        'note'           => 'string',
        'status'         => 'string',
        'flag'           => 'string',
        'created_by'     => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];
}