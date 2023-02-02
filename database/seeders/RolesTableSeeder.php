<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'Moderator','guard_name'=>'web']);
        Role::create(['name'=>'Admin','guard_name'=>'web']);
        Role::create(['name'=>'Manager','guard_name'=>'web']);
        Role::create(['name'=>'Receptionist','guard_name'=>'web']);
        Role::create(['name'=>'Cleaner','guard_name'=>'web']);

        //assign roles to the users
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $user4 = User::find(4);
        $user5 = User::find(5);

        $user1->assignRole('Moderator');
        $user2->assignRole('Admin');
        $user3->assignRole('Manager');
        $user4->assignRole('Receptionist');
        $user5->assignRole('Cleaner');
    }
}
