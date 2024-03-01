<?php

namespace App\Models;

use App\Models\Cow;
use App\Models\Shed;
use App\Models\Branch;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CowVaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'cow_tag',
        'shed_id',
        'push_date',
        'note',
        'vaccine_id',
        'remarks',
        'given_time',
    ];

    protected $casts = [
        'id'         => 'integer',
        'branch_id'  => 'integer',
        'cow_tag'    => 'integer',
        'shed_id'    => 'integer',
        'push_date'  => 'datetime',
        'note'       => 'string',
        'vaccine_id' => 'integer',
        'remarks'    => 'string',
        'given_time' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Relation Start
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function cow()
    {
        return $this->belongsTo(Cow::class, 'cow_tag', 'id');
    }

    public function shed()
    {
        return $this->belongsTo(Shed::class, 'shed_id', 'id');
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id', 'id');
    }
}