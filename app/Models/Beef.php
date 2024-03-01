<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beef extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'date',
        'cow_id',
        'total_beef',
    ];

    protected $casts = [
        'id'         => 'integer',
        'branch_id'  => 'integer',
        'date'       => 'datetime',
        'cow_id'     => 'string',
        'total_beef' => 'string',
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
