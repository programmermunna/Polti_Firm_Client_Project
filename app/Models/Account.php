<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy_id',
        'branch_id',
        'expense_type',
        'amount',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'buy_id'       => 'integer',
        'branch_id'    => 'integer',
        'expense_type' => 'integer',
        'amount'       => 'float',
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

    public function expenseType()
    {
        return $this->belongsTo(Expense::class, 'expense_type', 'id');
    }
}