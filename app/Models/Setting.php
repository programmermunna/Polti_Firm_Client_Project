<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_title',
        'project_phone',
        'project_email',
        'project_address',
        'project_logo',
    ];

    protected $casts = [
        'id'            => 'integer',
        'project_name'  => 'string',
        'project_title' => 'string',
        'project_phone' => 'string',
        'project_email' => 'string',
        'project_address' => 'string',
        'project_logo'  => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}