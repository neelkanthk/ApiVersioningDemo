<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SongsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $songs = array();
        for ($i = 0; $i <= 10; $i++) {
            $genres = ['rock', 'pop', 'indian', 'classical'];

            array_push($songs, [
                'title' => 'Song-' . Str::random(5),
                'artist' => 'Artist-' . Str::random(5),
                'genre' => $genres[array_rand($genres)],
                'duration' => rand(90, 600),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        DB::table('songs')->insert($songs);
    }

}
