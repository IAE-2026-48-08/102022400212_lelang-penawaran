<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bids')->updateOrInsert(
            [
                'item_id' => 'ITEM-001' 
            ], 
            [
                'user_id' => 'USR-001', 
                'bid_amount' => 102022400212,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}