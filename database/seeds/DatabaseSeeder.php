<?php

use Illuminate\Database\Seeder;
use SongsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SongsTableSeeder::class);
    }
}
