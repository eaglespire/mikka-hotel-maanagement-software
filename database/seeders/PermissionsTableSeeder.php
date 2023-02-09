<?php /** @noinspection DuplicatedCode */

namespace Database\Seeders;

use App\Services\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>Permissions::CAN_CREATE_BOOKING]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_BOOKING]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_BOOKING]);
        Permission::create(['name'=>Permissions::CAN_DELETE_BOOKING]);

        Permission::create(['name'=>Permissions::CAN_CREATE_CUSTOMERS]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_CUSTOMERS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_CUSTOMERS]);
        Permission::create(['name'=>Permissions::CAN_DELETE_CUSTOMERS]);

        Permission::create(['name'=>Permissions::CAN_CREATE_ROOMS]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_ROOMS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_ROOMS]);
        Permission::create(['name'=>Permissions::CAN_DELETE_ROOMS]);

        Permission::create(['name'=>Permissions::CAN_CREATE_EMPLOYEES]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_EMPLOYEES]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_EMPLOYEES]);
        Permission::create(['name'=>Permissions::CAN_DELETE_EMPLOYEES]);

        Permission::create(['name'=>Permissions::CAN_CREATE_ROLES]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_ROLES]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_ROLES]);
        Permission::create(['name'=>Permissions::CAN_DELETE_ROLES]);

        Permission::create(['name'=>Permissions::CAN_CREATE_BLOG]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_BLOG]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_BLOG]);
        Permission::create(['name'=>Permissions::CAN_DELETE_BLOG]);

        Permission::create(['name'=>Permissions::CAN_DOWNLOAD_INVOICE]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_INVOICES]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_INVOICE]);
        Permission::create(['name'=>Permissions::CAN_DELETE_INVOICE]);

        Permission::create(['name'=>Permissions::CAN_CREATE_EXPENSE]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_EXPENSES]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_EXPENSE]);
        Permission::create(['name'=>Permissions::CAN_DELETE_EXPENSE]);

        Permission::create(['name'=>Permissions::CAN_CREATE_PAYROLLS]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_PAYROLLS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_PAYROLLS]);
        Permission::create(['name'=>Permissions::CAN_DELETE_PAYROLLS]);

        Permission::create(['name'=>Permissions::CAN_CREATE_ASSETS]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_ASSETS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_ASSETS]);
        Permission::create(['name'=>Permissions::CAN_DELETE_ASSETS]);

        Permission::create(['name'=>Permissions::CAN_ACCESS_ACTIVITIES]);
        Permission::create(['name'=>Permissions::CAN_DELETE_ACTIVITIES]);

        Permission::create(['name'=>Permissions::CAN_CREATE_EXPENSE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_EXPENSE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_EXPENSE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_DELETE_EXPENSE_REPORT]);

        Permission::create(['name'=>Permissions::CAN_CREATE_INVOICE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_INVOICE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_INVOICE_REPORT]);
        Permission::create(['name'=>Permissions::CAN_DELETE_INVOICE_REPORT]);

        Permission::create(['name'=>Permissions::CAN_CREATE_EVENTS]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_EVENTS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_EVENTS]);
        Permission::create(['name'=>Permissions::CAN_DELETE_EVENTS]);

        Permission::create(['name'=>Permissions::CAN_CREATE_ROOM_FEATURES]);
        Permission::create(['name'=>Permissions::CAN_ACCESS_ROOM_FEATURES]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_ROOM_FEATURES]);
        Permission::create(['name'=>Permissions::CAN_DELETE_ROOM_FEATURES]);

        Permission::create(['name'=>Permissions::CAN_ACCESS_SETTINGS]);
        Permission::create(['name'=>Permissions::CAN_UPDATE_SETTINGS]);


    }
}
