<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'branch_id',
        'shed_id',
        'polti_id',
        'title',
        'food_item',
        'food_period',
        'vaccine_item',
        'vaccine_period',
        'description',
        'date',
        'status'
    ];
}
