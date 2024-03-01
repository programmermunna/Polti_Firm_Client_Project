<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'supplier_name',
        'company_name',
        'phone_number',
        'email',
        'adress',
        'supplier_image',
        'status',
    ];

    protected $casts = [
        'id'             => 'integer',
        'branch_id'      => 'integer',
        'supplier_name'  => 'string',
        'company_name'   => 'string',
        'phone_number'   => 'string',
        'email'          => 'string',
        'adress'         => 'string',
        'supplier_image' => 'string',
        'status'         => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];

    // Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}