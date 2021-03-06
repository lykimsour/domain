<?php

use Illuminate\Database\Seeder;

class permissiontableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'permission_title' => 'Manage_User',
            'permission_slug' => 'manage_user',
           	'permission_description' => 'Only for super admin user',
             ]);
		 DB::table('permissions')->insert([
            'permission_title' => 'View_Cashier',
            'permission_slug' => 'view_cashier',
           	'permission_description' => 'Only for cashier user',
        ]);
		 DB::table('permissions')->insert([
            'permission_title' => 'Inser_Cashier',
            'permission_slug' => 'insert_cashier',
           	'permission_description' => 'Only for cashier user',
        ]); 
		 DB::table('permissions')->insert([
            'permission_title' => 'Delete_Cashier',
            'permission_slug' => 'delete_cashier',
           	'permission_description' => 'Only for cashier user',
        ]);
		DB::table('permissions')->insert([
            'permission_title' => 'Update_Cashier',
            'permission_slug' => 'update_cashier',
           	'permission_description' => 'Only for cashier user',
        ]); 




         DB::table('permissions')->insert([
            'permission_title' => 'View_Service',
            'permission_slug' => 'view_service',
           	'permission_description' => 'Only for service user',
        ]);
          DB::table('permissions')->insert([
            'permission_title' => 'Insert_Service',
            'permission_slug' => 'insert_service',
           	'permission_description' => 'Only for service user',
        ]); 
           DB::table('permissions')->insert([
            'permission_title' => 'Delete_Service',
            'permission_slug' => 'delete_service',
           	'permission_description' => 'Only for service user',
        ]); 
            DB::table('permissions')->insert([
            'permission_title' => 'Update_Service',
            'permission_slug' => 'update_service',
           	'permission_description' => 'Only for service user',
        ]); 



         DB::table('permissions')->insert([
            'permission_title' => 'View_OnlineShop',
            'permission_slug' => 'view_onlineshop',
           	'permission_description' => 'Only for onlineshop user',
        ]);
        DB::table('permissions')->insert([
            'permission_title' => 'Inser_OnlineShop',
            'permission_slug' => 'insert_onlineshop',
           	'permission_description' => 'Only for onlineshop user',
        ]);
         
         DB::table('permissions')->insert([
            'permission_title' => 'Delete_OnlineShop',
            'permission_slug' => 'delete_onlineshop',
           	'permission_description' => 'Only for onlineshop user',
        ]);

           DB::table('permissions')->insert([
            'permission_title' => 'Update_OnlineShop',
            'permission_slug' => 'update_onlineshop',
           	'permission_description' => 'Only for onlineshop user',
        ]);


        DB::table('permissions')->insert([
            'permission_title' => 'View_Promotion',
            'permission_slug' => 'view_promotion',
            'permission_description' => 'Only for promotion user',
        ]);
        DB::table('permissions')->insert([
            'permission_title' => 'Inser_Promotion',
            'permission_slug' => 'insert_promotion',
            'permission_description' => 'Only for promotion user',
        ]);
         
        DB::table('permissions')->insert([
            'permission_title' => 'Delete_Promotion',
            'permission_slug' => 'delete_promotion',
            'permission_description' => 'Only for promotion user',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Update_Promotion',
            'permission_slug' => 'update_promotion',
            'permission_description' => 'Only for promotion user',
        ]); 

        DB::table('permissions')->insert([
            'permission_title' => 'View_Merchant',
            'permission_slug' => 'view_Merchant',
            'permission_description' => 'Only for promotion user',
        ]);
        DB::table('permissions')->insert([
            'permission_title' => 'Inser_Merchant',
            'permission_slug' => 'insert_merchant',
            'permission_description' => 'Only for merchant user',
        ]);
         
        DB::table('permissions')->insert([
            'permission_title' => 'Delete_Merchant',
            'permission_slug' => 'delete_merchant',
            'permission_description' => 'Only for merchant user',
        ]);

        DB::table('permissions')->insert([
            'permission_title' => 'Update_Merchant',
            'permission_slug' => 'update_merchant',
            'permission_description' => 'Only for merchant user',
        ]); 
    }
}
