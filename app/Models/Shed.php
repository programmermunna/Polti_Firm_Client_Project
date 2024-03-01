<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Branch;
use App\Models\CowFeed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shed extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'          => 'integer',
        'branch_id'   => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'status'      => 'string',
        'flag'        => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function cows()
    {
        return $this->hasMany(Cow::class);
    }

    public function cowFeeds()
    {
        return $this->hasMany(CowFeed::class);
    }
}