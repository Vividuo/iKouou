<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \DB::table('users')->where('username', 'paulchen')->first();
        if (!$admin) {
            \DB::table('users')->insert([
                'username' => 'paulchen',
                'email' => 'gemini6130@gmail.com',
                'mobile' => '13701960700',
                'password' => \Hash::make('chen123')
            ]);
        }
    }
}
