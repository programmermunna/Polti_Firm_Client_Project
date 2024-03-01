<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'sell_id',
        'amount',
        'due',
        'flag',
    ];

    protected $casts = [
        'id'         => 'integer',
        'branch_id'  => 'integer',
        'sell_id'    => 'integer',
        'amount'     => 'float',
        'due'        => 'float',
        'flag'       => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}