<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Food::insert([
            [
                'id'           => 1,
                'name'        => 'পানি',
                'status'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 2,
                'name'        => 'খাদ্য',
                'status'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
