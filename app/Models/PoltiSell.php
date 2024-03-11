<?php

namespace App\Models;

use App\Models\polti;
use App\Models\Buyer;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoltiSell extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'polti_id',
        'buyer_id',
        'category_id',
        'kg',
        'piece',
        'price',
        'payment',
        'due',
        'sell_date',
        'description',
        'status',
        'flag',
    ];

    protected $casts = [
        'id'          => 'integer',
        'branch_id'   => 'integer',
        'polti_id'      => 'integer',
        'buyer_id'    => 'integer',
        'price'       => 'integer',
        'payment'     => 'integer',
        'due'         => 'integer',
        'sell_date'   => 'datetime',
        'description' => 'string',
        'status'      => 'string',
        'flag'        => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
