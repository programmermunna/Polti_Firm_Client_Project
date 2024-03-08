<?php

namespace Database\Seeders;
use Carbon\Carbon;

use App\Models\Buyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Buyer::insert([
            [
                'id'           => 1,
                'branch_id'         => 1,
                'name'        => 'সবুজ মিয়া',
                'phone_number' => '012345',
                'address' => 'মিরপুর, ঢাকা, বাংলাদেষ',
                'balance' => 10000,
                'status'     => 1,
                'flag'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 2,
                'branch_id'         => 1,
                'name'        => 'মনির হোসেন',
                'phone_number' => '0154564',
                'address' => 'মিরপুর, ঢাকা, বাংলাদেষ',
                'balance' => 15000,
                'status'     => 1,
                'flag'     => 1,
                'created_at'   => $now
            ],
            [
                'id'           => 3,
                'branch_id'         => 1,
                'name'        => 'রফিকুল ইসলাম',
                'phone_number' => '012545',
                'address' => 'মিরপুর, ঢাকা, বাংলাদেষ',
                'balance' => 20000,
                'status'     => 1,
                'flag'     => 1,
                'created_at'   => $now
            ]
        ]);
    }
}
