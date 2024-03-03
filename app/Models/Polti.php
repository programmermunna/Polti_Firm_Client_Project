<?php

namespace App\Models;

use App\Models\Shed;
use App\Models\Branch;
use App\Models\poltiFeed;
use App\Models\poltiSell;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class polti extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'price',
        'piece',
        'category_id',
        'expense_type',
        'shed_id',
        'tag',
        'caste',
        'weight',
        'transport',
        'hasil',
        'total',
        'color',
        'buy_date',
        'age',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'price'        => 'integer',
        'category_id'  => 'integer',
        'expense_type' => 'integer',
        'shed_id'      => 'integer',
        'tag'          => 'string',
        'caste'        => 'string',
        'weight'       => 'string',
        'transport'    => 'integer',
        'hasil'        => 'integer',
        'total'        => 'integer',
        'color'        => 'string',
        'buy_date'     => 'datetime',
        'age'          => 'string',
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

    public function poltiSells()
    {
        return $this->hasMany(poltiSell::class);
    }

    public function milks()
    {
        return $this->hasMany(Milk::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function pregnancies()
    {
        return $this->hasMany(Pregnancy::class);
    }

    public function poltiFeeds()
    {
        return $this->hasMany(poltiFeed::class);
    }

    public function shed()
    {
        return $this->belongsTo(Shed::class, 'shed_id', 'id');
    }
}
