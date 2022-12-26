<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name' => "Northern Region",
                'code' => "NR"
            ],
            [
                'name' => "Southern Region",
                'code' => "SR"
            ],
            [
                'name' => "Eastern Region",
                'code' => "ER"
            ],
            [
                'name' => "Western Region",
                'code' => "WR"
            ],
            [
                'name' => "ACMA Centre of Excellence",
                'code' => "ACOE"
            ],
            [
                'name' => "Young Business Leaders Forum",
                'code' => "YBLF"
            ]
        ]);
    }
}
