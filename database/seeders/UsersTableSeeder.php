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
            'email'=>'mod@site.test',
            'password' => \Hash::make('super'),
            'password_text'=>'super'
        ]);
        $user2 = User::create([
            'firstname'=>'Richard',
            'lastname'=>'Babbage',
            'email'=>'admin@site.test',
            'password' => \Hash::make('admin'),
            'password_text'=>'admin',
            'dob'=>now()
        ]);
        $user3 = User::create([
            'firstname'=>'Mike',
            'lastname'=>'Novick',
            'email'=>'manager@site.test',
            'password' => \Hash::make('manager'),
            'password_text'=>'manager',
            'dob'=>now()
        ]);
        $user4 = User::create([
            'firstname'=>'Sarah',
            'lastname'=>'Gaines',
            'email'=>'receptionist@site.test',
            'password' => \Hash::make('receptionist'),
            'password_text'=>'receptionist',
            'dob'=>now()
        ]);
        $user5 = User::create([
            'firstname'=>'Jane',
            'lastname'=>'Gates',
            'email'=>'cleaner@site.test',
            'password' => \Hash::make('cleaner'),
            'password_text'=>'cleaner',
            'dob'=>now()
        ]);
    }
}
