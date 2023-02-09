<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Moderator']);
        $role2 = Role::create(['name'=>'Admin',]);
        $role3 = Role::create(['name'=>'Manager']);
        $role4 = Role::create(['name'=>'Receptionist']);
        $role5 = Role::create(['name'=>'Cleaner']);

        //assign roles to the users
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $user4 = User::find(4);
        $user5 = User::find(5);

        $user1->assignRole(1);
        $user2->assignRole(2);
        $user3->assignRole(3);
        $user4->assignRole(4);
        $user5->assignRole(5);

        $role2->assignPermission(14,18,19,20);
    }
}
