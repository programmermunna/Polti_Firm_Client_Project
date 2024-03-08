<?php

namespace Database\Seeders;
use Carbon\Carbon;

use App\Models\Shed;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Shed::insert([
            [
                'id'           => 1,
                'branch_id'    => 1,
                'name'        => 'লাল শেড',
                'description' => 'লাল শেড',
                'status'     => 1,
                'flag'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
