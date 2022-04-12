<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name' => "admin",
            'email' => "admin@acma.com",
            'password' => md5('!Q@W3e4r'),
        ]);
    }
}
