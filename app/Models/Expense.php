<?php

namespace App\Models;

use App\Models\Cost;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'status'     => 'string',
        'flag'       => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Relation Start
    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function accounts()
    {
        return $this->hasMany(Cost::class);
    }
}