<?php

namespace App\Models;

use App\Models\CowFeed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Relation Start
    public function cowFeeds()
    {
        return $this->hasMany(CowFeed::class);
    }
}