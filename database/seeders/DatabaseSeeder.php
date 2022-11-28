<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //insert 3 users
        DB::table('users')->insert([
            'name' => 'abhinna',
            'email' => 'abhinna@oic.com',
            'password' => bcrypt('111111111')
        ]);
        DB::table('users')->insert([
            'name' => 'maniram',
            'email' => 'maniram@oic.com',
            'password' => bcrypt('111111111')
        ]);
        DB::table('users')->insert([
            'name' => 'durga',
            'email' => 'durga@oic.com',
            'password' => bcrypt('111111111')
        ]);
        //making 'abhinna' admin
        DB::table('admins')->insert([
            'user' => '1'
        ]);
        //making default payment
        DB::table('payments')->insert([
            'amount' => -1,
            'mode' => -1,
            'reference' => 'na',
        ]);
    }
}
