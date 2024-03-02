<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\poltiSell;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'phone_number',
        'address',
        'balance',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'name'         => 'string',
        'phone_number' => 'string',
        'address'      => 'string',
        'balance'      => 'string',
        'status'       => 'string',
        'flag'         => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function poltiSells()
    {
        return $this->hasMany(poltiSell::class);
    }
}
