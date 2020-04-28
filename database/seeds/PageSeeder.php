<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page')->insert([
            "id" => 1,
            "name" => "kirishima_hot",
            "contents" => "kirishima.blade.php",
            "url" => '/kirishima/hot',
            "category" => 1,
        ]);
    }
}
