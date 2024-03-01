<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MilkSell extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'name',
        'sale_date',
        'quantity',
        'price',
        'payment',
        'due',
        'phone_number',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'name'         => 'string',
        'sale_date'    => 'datetime',
        'quantity'     => 'string',
        'price'        => 'integer',
        'payment'      => 'integer',
        'due'          => 'integer',
        'phone_number' => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
