<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('routes')->insert([
            'start_id'=>1,
            'stop_id'=>2,
            'instructions'=>'instructies',
        ]);
        
        DB::table('routes')->insert([
            'start_id'=>3,
            'stop_id'=>4,
            'instructions'=>'instructies2',
        ]);
        
        DB::table('routes')->insert([
            'start_id'=>5,
            'stop_id'=>6,
            'instructions'=>'instructies3',
        ]);
    }
}
