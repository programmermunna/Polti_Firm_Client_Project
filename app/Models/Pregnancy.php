<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'cow_id',
        'pregnancy_type',
        'semen_id',
        'push_date',
        'start_date',
        'semen_cost',
        'other_cost',
        'due',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'             => 'integer',
        'branch_id'      => 'integer',
        'cow_id'         => 'integer',
        'pregnancy_type' => 'string',
        'semen_id'       => 'integer',
        'push_date'      => 'datetime',
        'start_date'     => 'datetime',
        'semen_cost'     => 'integer',
        'other_cost'     => 'integer',
        'due'            => 'integer',
        'status'         => 'string',
        'flag'           => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function cow()
    {
        return $this->belongsTo(Cow::class, 'cow_id', 'id');
    }
}
