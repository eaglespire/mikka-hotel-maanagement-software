<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'create-booking','guard_name'=>'web']);
        Permission::create(['name'=>'read-bookings','guard_name'=>'web']);
        Permission::create(['name'=>'update-booking','guard_name'=>'web']);
        Permission::create(['name'=>'delete-booking','guard_name'=>'web']);

        Permission::create(['name'=>'create-customer','guard_name'=>'web']);
        Permission::create(['name'=>'read-customers','guard_name'=>'web']);
        Permission::create(['name'=>'update-customer','guard_name'=>'web']);
        Permission::create(['name'=>'delete-customer','guard_name'=>'web']);

        Permission::create(['name'=>'create-room','guard_name'=>'web']);
        Permission::create(['name'=>'read-rooms','guard_name'=>'web']);
        Permission::create(['name'=>'update-room','guard_name'=>'web']);
        Permission::create(['name'=>'delete-room','guard_name'=>'web']);

        Permission::create(['name'=>'create-employee','guard_name'=>'web']);
        Permission::create(['name'=>'read-employees','guard_name'=>'web']);
        Permission::create(['name'=>'update-employee','guard_name'=>'web']);
        Permission::create(['name'=>'delete-employee','guard_name'=>'web']);

        Permission::create(['name'=>'create-role','guard_name'=>'web']);
        Permission::create(['name'=>'read-roles','guard_name'=>'web']);
        Permission::create(['name'=>'update-role','guard_name'=>'web']);
        Permission::create(['name'=>'delete-role','guard_name'=>'web']);

        Permission::create(['name'=>'create-blog-post','guard_name'=>'web']);
        Permission::create(['name'=>'read-blog-posts','guard_name'=>'web']);
        Permission::create(['name'=>'update-blog-post','guard_name'=>'web']);
        Permission::create(['name'=>'delete-blog-post','guard_name'=>'web']);

        Permission::create(['name'=>'download-invoice','guard_name'=>'web']);
        Permission::create(['name'=>'read-invoices','guard_name'=>'web']);
        Permission::create(['name'=>'update-invoice','guard_name'=>'web']);
        Permission::create(['name'=>'delete-invoice','guard_name'=>'web']);

        Permission::create(['name'=>'create-expense','guard_name'=>'web']);
        Permission::create(['name'=>'read-expenses','guard_name'=>'web']);
        Permission::create(['name'=>'update-expense','guard_name'=>'web']);
        Permission::create(['name'=>'delete-expense','guard_name'=>'web']);

        Permission::create(['name'=>'create-payroll','guard_name'=>'web']);
        Permission::create(['name'=>'read-payrolls','guard_name'=>'web']);
        Permission::create(['name'=>'update-payroll','guard_name'=>'web']);
        Permission::create(['name'=>'delete-payroll','guard_name'=>'web']);

        Permission::create(['name'=>'create-asset','guard_name'=>'web']);
        Permission::create(['name'=>'read-assets','guard_name'=>'web']);
        Permission::create(['name'=>'update-asset','guard_name'=>'web']);
        Permission::create(['name'=>'delete-asset','guard_name'=>'web']);

        Permission::create(['name'=>'read-activities','guard_name'=>'web']);
        Permission::create(['name'=>'delete-activity','guard_name'=>'web']);

        Permission::create(['name'=>'create-expense-report','guard_name'=>'web']);
        Permission::create(['name'=>'read-expense-report','guard_name'=>'web']);
        Permission::create(['name'=>'update-expense-report','guard_name'=>'web']);
        Permission::create(['name'=>'delete-expense-report','guard_name'=>'web']);

        Permission::create(['name'=>'create-invoice-report','guard_name'=>'web']);
        Permission::create(['name'=>'read-invoice-report','guard_name'=>'web']);
        Permission::create(['name'=>'update-invoice-report','guard_name'=>'web']);
        Permission::create(['name'=>'delete-invoice-report','guard_name'=>'web']);

        Permission::create(['name'=>'manage-settings','guard_name'=>'web']);

    }
}
