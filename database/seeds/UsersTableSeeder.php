<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'role_id'=> 1,
            'email' => 'admin@blog.com',
            'image' => 'avatar.png',
            'password' => bcrypt('admin'),
        ]);

        $user = User::create([
            'name' => 'User1',
            'role_id'=> 2,
            'email' => 'user1@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $user = User::create([
            'name' => 'User2',
            'role_id'=> 2,
            'email' => 'user2@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
