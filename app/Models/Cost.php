<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'expense_type',
        'cost_amount',
        'cost_date',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'name'         => 'string',
        'expense_type' => 'integer',
        'cost_amount'  => 'float',
        'cost_date'    => 'datetime',
        'description'  => 'string',
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

    public function expenseTypes()
    {
        return $this->belongsTo(Expense::class, 'expense_type', 'id');
    }
}
