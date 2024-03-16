<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Unit::insert([
            [
                'id'           => 1,
                'name'        => 'কেজি',
                'status'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 2,
                'name'        => 'গ্রাম',
                'status'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 3,
                'name'        => 'লিটার',
                'status'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
