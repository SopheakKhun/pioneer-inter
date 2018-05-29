<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'profile_access',],
            ['id' => 18, 'title' => 'requesting_access',],
            ['id' => 19, 'title' => 'requesting_create',],
            ['id' => 20, 'title' => 'requesting_edit',],
            ['id' => 21, 'title' => 'requesting_view',],
            ['id' => 22, 'title' => 'requesting_delete',],
            ['id' => 23, 'title' => 'booking_access',],
            ['id' => 24, 'title' => 'booking_create',],
            ['id' => 25, 'title' => 'booking_edit',],
            ['id' => 26, 'title' => 'booking_view',],
            ['id' => 27, 'title' => 'booking_delete',],
            ['id' => 28, 'title' => 'jobsheet_access',],
            ['id' => 29, 'title' => 'jobsheet_create',],
            ['id' => 30, 'title' => 'jobsheet_edit',],
            ['id' => 31, 'title' => 'jobsheet_view',],
            ['id' => 32, 'title' => 'jobsheet_delete',],
            ['id' => 33, 'title' => 'product_access',],
            ['id' => 34, 'title' => 'warranty_access',],
            ['id' => 35, 'title' => 'internal_notification_access',],
            ['id' => 36, 'title' => 'internal_notification_create',],
            ['id' => 37, 'title' => 'internal_notification_edit',],
            ['id' => 38, 'title' => 'internal_notification_view',],
            ['id' => 39, 'title' => 'internal_notification_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
