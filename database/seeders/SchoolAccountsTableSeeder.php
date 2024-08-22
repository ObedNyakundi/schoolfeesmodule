<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Get the application name
        $appName = config('app.name');

        // Create and insert the data
        DB::table('school_accounts')->insert([
            'created_at' => now(),
            'name' => $appName,
            'income' => 0.0,
            'expenses' => 0.0,
            'balance' => 0.0,
        ]);
    }
}
