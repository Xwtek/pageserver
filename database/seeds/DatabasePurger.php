<?php

use Illuminate\Database\Seeder;

class DatabasePurger extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table("category")->truncate();
        DB::table("page")->truncate();
        Schema::enableForeignKeyConstraints();  
    }
}
