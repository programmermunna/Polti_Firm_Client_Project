<?php

namespace App\Models;

use App\Models\Shed;
use App\Models\Branch;
use App\Models\PoltiFeed;
use App\Models\PoltiSell;
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
        'shed_id',
        'weight',
        'transport',
        'total',
        'buy_date',
        'age',
        'deth',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'           => 'integer',
        'branch_id'    => 'integer',
        'price'        => 'integer',
        'category_id'  => 'integer',
        'shed_id'      => 'integer',
        'weight'       => 'string',
        'transport'    => 'integer',
        'total'        => 'integer',
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function PoltiFeeds()
    {
        return $this->hasMany(PoltiFeed::class);
    }

    public function shed()
    {
        return $this->belongsTo(Shed::class, 'shed_id', 'id');
    }
}
