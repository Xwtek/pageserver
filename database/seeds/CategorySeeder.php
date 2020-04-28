<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            "id" => 1,
            "name" => "kirishima"
        ]);
        DB::table('category')->insert([
            "id" => 2,
            "name" => "bakugou"
        ]);
    }
}
