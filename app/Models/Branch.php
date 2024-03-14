<?php

namespace App\Models;

use App\Models\Polti;
use App\Models\Beef;
use App\Models\Cost;
use App\Models\Shed;
use App\Models\Buyer;
use App\Models\Staff;
use App\Models\Income;
use App\Models\Account;
use App\Models\PoltiFeed;
use App\Models\PoltiSell;
use App\Models\Invoice;
use App\Models\BeefSell;
use App\Models\StaffSalary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_name',
        'slug',
        'branch_email',
        'branch_address',
        'branch_image',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'             => 'integer',
        'branch_name'    => 'string',
        'slug'           => 'string',
        'branch_email'   => 'string',
        'branch_address' => 'string',
        'branch_image'   => 'string',
        'status'         => 'string',
        'flag'           => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime'
    ];

    // Relation Start
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function poltis()
    {
        return $this->hasMany(polti::class);
    }

    public function buyers()
    {
        return $this->hasMany(polti::class);
    }

    public function poltiSells()
    {
        return $this->hasMany(poltiSell::class);
    }

    public function beefs()
    {
        return $this->hasMany(Beef::class);
    }

    public function beefSells()
    {
        return $this->hasMany(BeefSell::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function staffSalaries()
    {
        return $this->hasMany(StaffSalary::class);
    }

    public function sheds()
    {
        return $this->hasMany(Shed::class);
    }

    public function poltiFeeds()
    {
        return $this->hasMany(poltiFeed::class);
    }
}
