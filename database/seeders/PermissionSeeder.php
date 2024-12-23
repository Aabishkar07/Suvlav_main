<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permission = [
            [
                'name' => 'View Dashboard',
                'guard_name' => 'web',
                'parent' => 'Dashboard'
            ],
            [
                'name' => 'View Banner',
                'guard_name' => 'web',
                'parent' => 'Banner'
            ],
            [
                'name' => 'Add Banner',
                'guard_name' => 'web',
                'parent' => 'Banner'
            ],
            [
                'name' => 'Edit Banner',
                'guard_name' => 'web',
                'parent' => 'Banner'
            ],
            [
                'name' => 'Delete Banner',
                'guard_name' => 'web',
                'parent' => 'Banner'
            ],


            [
                'name' => 'View Product',
                'guard_name' => 'web',
                'parent' => 'Product'
            ],
            [
                'name' => 'Add Product',
                'guard_name' => 'web',
                'parent' => 'Product'
            ],
            [
                'name' => 'Edit Product',
                'guard_name' => 'web',
                'parent' => 'Product'
            ],
            [
                'name' => 'Delete Product',
                'guard_name' => 'web',
                'parent' => 'Product'
            ],

            [
                'name' => 'View Categories',
                'guard_name' => 'web',
                'parent' => 'Categories'
            ],
            [
                'name' => 'Add Categories',
                'guard_name' => 'web',
                'parent' => 'Categories'
            ],
            [
                'name' => 'Edit Categories',
                'guard_name' => 'web',
                'parent' => 'Categories'
            ],
            [
                'name' => 'Delete Categories',
                'guard_name' => 'web',
                'parent' => 'Categories'
            ],



            [
                'name' => 'View Brands',
                'guard_name' => 'web',
                'parent' => 'Brands'
            ],
            [
                'name' => 'Add Brands',
                'guard_name' => 'web',
                'parent' => 'Brands'
            ],
            [
                'name' => 'Edit Brands',
                'guard_name' => 'web',
                'parent' => 'Brands'
            ],
            [
                'name' => 'Delete Brands',
                'guard_name' => 'web',
                'parent' => 'Brands'
            ],



            [
                'name' => 'View Product Colors',
                'guard_name' => 'web',
                'parent' => 'Product Colors'
            ],
            [
                'name' => 'Add Product Colors',
                'guard_name' => 'web',
                'parent' => 'Product Colors'
            ],
            [
                'name' => 'Edit Product Colors',
                'guard_name' => 'web',
                'parent' => 'Product Colors'
            ],
            [
                'name' => 'Delete Product Colors',
                'guard_name' => 'web',
                'parent' => 'Product Colors'
            ],


            [
                'name' => 'View Sizes',
                'guard_name' => 'web',
                'parent' => 'Sizes'
            ],
            [
                'name' => 'Add Sizes',
                'guard_name' => 'web',
                'parent' => 'Sizes'
            ],
            [
                'name' => 'Edit Sizes',
                'guard_name' => 'web',
                'parent' => 'Sizes'
            ],
            [
                'name' => 'Delete Sizes',
                'guard_name' => 'web',
                'parent' => 'Sizes'
            ],



            [
                'name' => 'View Page',
                'guard_name' => 'web',
                'parent' => 'Page'
            ],
            [
                'name' => 'Add Page',
                'guard_name' => 'web',
                'parent' => 'Page'
            ],
            [
                'name' => 'Edit Page',
                'guard_name' => 'web',
                'parent' => 'Page'
            ],
            [
                'name' => 'Delete Page',
                'guard_name' => 'web',
                'parent' => 'Page'
            ],




            [
                'name' => 'View Create',
                'guard_name' => 'web',
                'parent' => 'Create'
            ],
            [
                'name' => 'Add Create',
                'guard_name' => 'web',
                'parent' => 'Create'
            ],
            [
                'name' => 'Edit Create',
                'guard_name' => 'web',
                'parent' => 'Create'
            ],
            [
                'name' => 'Delete Create',
                'guard_name' => 'web',
                'parent' => 'Create'
            ],


            [
                'name' => 'View Faqs',
                'guard_name' => 'web',
                'parent' => 'Faqs'
            ],
            [
                'name' => 'Add Faqs',
                'guard_name' => 'web',
                'parent' => 'Faqs'
            ],
            [
                'name' => 'Edit Faqs',
                'guard_name' => 'web',
                'parent' => 'Faqs'
            ],
            [
                'name' => 'Delete Faqs',
                'guard_name' => 'web',
                'parent' => 'Faqs'
            ],



            [
                'name' => 'View Blogs',
                'guard_name' => 'web',
                'parent' => 'Blogs'
            ],
            [
                'name' => 'Add Blogs',
                'guard_name' => 'web',
                'parent' => 'Blogs'
            ],
            [
                'name' => 'Edit Blogs',
                'guard_name' => 'web',
                'parent' => 'Blogs'
            ],
            [
                'name' => 'Delete Blogs',
                'guard_name' => 'web',
                'parent' => 'Blogs'
            ],



            [
                'name' => 'View Posts',
                'guard_name' => 'web',
                'parent' => 'Posts'
            ],
            [
                'name' => 'Add Posts',
                'guard_name' => 'web',
                'parent' => 'Posts'
            ],
            [
                'name' => 'Edit Posts',
                'guard_name' => 'web',
                'parent' => 'Posts'
            ],
            [
                'name' => 'Delete Posts',
                'guard_name' => 'web',
                'parent' => 'Posts'
            ],



            [
                'name' => 'View Order',
                'guard_name' => 'web',
                'parent' => 'Order'
            ],
            [
                'name' => 'Add Order',
                'guard_name' => 'web',
                'parent' => 'Order'
            ],
            [
                'name' => 'Edit Order',
                'guard_name' => 'web',
                'parent' => 'Order'
            ],
            [
                'name' => 'Delete Order',
                'guard_name' => 'web',
                'parent' => 'Order'
            ],



            [
                'name' => 'View AdminUser',
                'guard_name' => 'web',
                'parent' => 'AdminUser'
            ],
            [
                'name' => 'Add AdminUser',
                'guard_name' => 'web',
                'parent' => 'AdminUser'
            ],
            [
                'name' => 'Edit AdminUser',
                'guard_name' => 'web',
                'parent' => 'AdminUser'
            ],
            [
                'name' => 'Delete AdminUser',
                'guard_name' => 'web',
                'parent' => 'AdminUser'
            ],

            

            [
                'name' => 'View ShopUsers',
                'guard_name' => 'web',
                'parent' => 'ShopUsers'
            ],
            [
                'name' => 'Add ShopUsers',
                'guard_name' => 'web',
                'parent' => 'ShopUsers'
            ],
            [
                'name' => 'Edit ShopUsers',
                'guard_name' => 'web',
                'parent' => 'ShopUsers'
            ],
            [
                'name' => 'Delete ShopUsers',
                'guard_name' => 'web',
                'parent' => 'ShopUsers'
            ],



            [
                'name' => 'View Settings',
                'guard_name' => 'web',
                'parent' => 'Settings'
            ],



            [
                'name' => 'View Users',
                'guard_name' => 'web',
                'parent' => 'Users'
            ],
            
            [
                'name' => 'View Roles',
                'guard_name' => 'web',
                'parent' => 'Roles'
            ],


            

           

        ];
        Permission::insert($permission);
    }
}
