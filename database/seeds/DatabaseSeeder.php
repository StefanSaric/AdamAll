<?php

use Illuminate\Database\Seeder;
//use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@adamall.rs',
            'password' => bcrypt('asdf4321'),

        ]);
    }
}
