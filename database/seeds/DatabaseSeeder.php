<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(geoadminseeder::class);
         $this->call(geo::class);
        //  $this->call(masterseeder::class);
        }
}
