<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $admin = \DB::table('users')->where('username', 'paulchen')->first();
        if (!$admin) {
            $user_id = \DB::table('users')->insertGetId([
                'username' => 'paulchen',
                'email' => 'gemini6130@gmail.com',
                'mobile' => '13701960700',
                'password' => \Hash::make('chen123')
            ]);
        } else {
            $user_id = $admin->id;
        }

        $superadmin = \DB::table('roles')->where('slug', 'superadmin')->first();
        if (!$superadmin) {
            $role_id = \DB::table('roles')->insertGetId([
                'title' => '超级管理员',
                'slug' => 'superadmin',
            ]);
        } else {
            $role_id = $superadmin->id;
        }

        $relation = \DB::table('user_role')->where('user_id', $user_id)->where('role_id', $role_id)->first();
        if (!$relation) {
            \DB::table('user_role')->insert([
                'user_id' => $user_id,
                'role_id' => $role_id
            ]);
        }
    }
}
