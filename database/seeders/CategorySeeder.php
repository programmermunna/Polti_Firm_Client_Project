<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Category::insert([
            [
                'id'           => 1,
                'name'        => 'দেশি',
                'status'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 2,
                'name'        => 'সোনালি',
                'status'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 3,
                'name'        => 'গলাছিলা',
                'status'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
