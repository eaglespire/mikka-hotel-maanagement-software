<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user1 = User::create([
            'firstname'=>'John',
            'lastname'=>'Doe',
            'email'=>'moderator@site.test',
            'password' => \Hash::make('admin123'),
            'password_text'=>'admin123'
        ]);
        $user2 = User::create([
            'firstname'=>'Richard',
            'lastname'=>'Babbage',
            'email'=>'admin@site.test',
            'password' => \Hash::make('password'),
            'password_text'=>'password'
        ]);
        $user3 = User::create([
            'firstname'=>'Mike',
            'lastname'=>'Novick',
            'email'=>'manager@site.test',
            'password' => \Hash::make('password'),
            'password_text'=>'password'
        ]);
        $user4 = User::create([
            'firstname'=>'Sarah',
            'lastname'=>'Gaines',
            'email'=>'receptionist@site.test',
            'password' => \Hash::make('password'),
            'password_text'=>'password'
        ]);
        $user5 = User::create([
            'firstname'=>'Jane',
            'lastname'=>'Gates',
            'email'=>'cleaner@site.test',
            'password' => \Hash::make('password'),
            'password_text'=>'password'
        ]);
    }
}
