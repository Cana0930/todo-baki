<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('colors')->insert([
            ['color_name' => 'red'],
            ['color_name' => 'blue'],
            ['color_name' => 'green'],
            ['color_name' => 'yellow'],
            ['color_name' => 'orange'],
        ]);
    }
}
