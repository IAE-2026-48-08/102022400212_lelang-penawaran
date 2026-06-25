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
                'status' => 'losing',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('bids')->updateOrInsert(
            [
                'item_id' => 'ITEM-001',
                'user_id' => 'USR-002'
            ], 
            [
                'bid_amount' => 1020224002121,
                'status' => 'winning',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}