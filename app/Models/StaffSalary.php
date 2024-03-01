<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'staff_id',
        'salary_date',
        'month',
        'year',
        'amount',
        'paid_on',
    ];

    protected $casts = [
        'id'          => 'integer',
        'branch_id'   => 'integer',
        'staff_id'    => 'integer',
        'salary_date' => 'datetime',
        'month'       => 'integer',
        'year'        => 'integer',
        'amount'      => 'integer',
        'paid_on'     => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
