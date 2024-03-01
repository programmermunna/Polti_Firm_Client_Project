<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Food;
use App\Models\Shed;
use App\Models\Unit;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CowFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'cow_tag',
        'description',
        'shed_id',
        'food_id',
        'food_quantity',
        'unit_id',
    ];

    protected $casts = [
        'id'            => 'integer',
        'branch_id'     => 'integer',
        'cow_tag'       => 'integer',
        'description'   => 'string',
        'shed_id'       => 'integer',
        'food_id'       => 'integer',
        'food_quantity' => 'string',
        'unit_id'       => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    // Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function cow()
    {
        return $this->belongsTo(Cow::class, 'cow_tag', 'id');
    }

    public function shed()
    {
        return $this->belongsTo(Shed::class, 'shed_id', 'id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}