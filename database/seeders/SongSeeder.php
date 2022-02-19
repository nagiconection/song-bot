<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            'lyrics' => "歌詞的ななんか",
            'state_fl' => "0",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
