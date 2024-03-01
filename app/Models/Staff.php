<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\StaffSalary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'salary',
        'father_name',
        'mother_name',
        'email',
        'nid_no',
        'birth_certificate',
        'present_address',
        'permanent_address',
        'blood_group',
        'gender',
        'birth_date',
        'staff_image',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'                => 'integer',
        'branch_id'         => 'integer',
        'name'              => 'string',
        'salary'            => 'integer',
        'father_name'       => 'string',
        'mother_name'       => 'string',
        'email'             => 'string',
        'nid_no'            => 'string',
        'birth_certificate' => 'string',
        'present_address'   => 'string',
        'permanent_address' => 'string',
        'blood_group'       => 'string',
        'gender'            => 'string',
        'birth_date'        => 'datetime',
        'staff_image'       => 'string',
        'status'            => 'string',
        'flag'              => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    // Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function staffSalaries()
    {
        return $this->hasMany(StaffSalary::class);
    }
}