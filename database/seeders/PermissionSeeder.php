<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $User_permissions = [
        'update_User', 
        'show_User', 
        'create_cart',
        'update_cart', 
        'delete_cart',
        'show_cart',
        'create_order',
        'update_order', 
        'show_order',
        'show_order_against_orderid',
        'show_order_against_userid',
        'delete_orderitem',
        'show_orderitem',
        'show_orderitem_against_id',
        'rating',
        'review',
        'add_wishlist',
        'remove_wishlist',
        'show_wishlist',
    ];


    $admin_permissions = [
        'delete_User',
        'delete_order',
        'update_order_status',
        'delete_review',
        'create_bookcatalog',
        'update_bookcatalog',
        'delete_bookcatalog',
    ];
        foreach ( $User_permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        foreach ( $admin_permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $role =Role::create(['name'=>'User']);
        $role->givePermissionTo($User_permissions);

        $role =Role::create(['name'=>'Admin']);
        $role->givePermissionTo($admin_permissions);

    }
}
