<?php

namespace Database\Seeders;
use Carbon\Carbon;

use App\Models\Branch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Branch::insert([
            [
                'id'           => 1,
                'branch_name'         => 'Branch 1',
                'slug'        => 'branch-1',
                'branch_email' => 'admin@gmail.com',
                'branch_address'     => 'Dhaka, Bangladesh',
                'branch_image'     => 'branch-image.jpg',
                'status'     => 1,
                'flag'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
