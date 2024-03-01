<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'cow_id',
        'milk_date',
        'quantity',
        'flag',
    ];

    protected $casts = [
        'id'         => 'integer',
        'branch_id'  => 'integer',
        'cow_id'     => 'integer',
        'milk_date'  => 'datetime',
        'quantity'   => 'float',
        'flag'       => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
