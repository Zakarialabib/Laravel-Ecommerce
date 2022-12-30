<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'section_access',
            ],
            [
                'id'    => 2,
                'title' => 'section_create',
            ],
            [
                'id'    => 3,
                'title' => 'section_update',
            ],
            [
                'id'    => 4,
                'title' => 'section_delete',
            ],
            [
                'id'    => 5,
                'title' => 'section_show',
            ],
            [
                'id'    => 6,
                'title' => 'role_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_update',
            ],
            [
                'id'    => 9,
                'title' => 'role_delete',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'permission_access',
            ],
            [
                'id'    => 12,
                'title' => 'permission_create',
            ],
            [
                'id'    => 13,
                'title' => 'permission_update',
            ],
            [
                'id'    => 14,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 15,
                'title' => 'permission_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_update',
            ],
            [
                'id'    => 19,
                'title' => 'user_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'product_create',
            ],
            [
                'id'    => 23,
                'title' => 'product_update',
            ],
            [
                'id'    => 24,
                'title' => 'product_delete',
            ],
            [
                'id'    => 25,
                'title' => 'product_show',
            ],
            [
                'id'    => 26,
                'title' => 'blog_access',
            ],
            [
                'id'    => 27,
                'title' => 'blog_create',
            ],
            [
                'id'    => 28,
                'title' => 'blog_update',
            ],
            [
                'id'    => 29,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 30,
                'title' => 'blog_show',
            ],
            [
                'id'    => 31,
                'title' => 'order_access',
            ],
            [
                'id'    => 32,
                'title' => 'order_create',
            ],
            [
                'id'    => 33,
                'title' => 'order_update',
            ],
            [
                'id'    => 34,
                'title' => 'order_delete',
            ],
            [
                'id'    => 35,
                'title' => 'order_show',
            ],
            [
                'id'    => 36,
                'title' => 'subcategory_access',
            ],
            [
                'id'    => 37,
                'title' => 'subcategory_create',
            ],
            [
                'id'    => 38,
                'title' => 'subcategory_update',
            ],
            [
                'id'    => 39,
                'title' => 'subcategory_delete',
            ],
            [
                'id'    => 40,
                'title' => 'subcategory_show',
            ],
            [
                'id'    => 41,
                'title' => 'setting_access',
            ],
            [
                'id'    => 42,
                'title' => 'dashboard_access',
            ],
            [
                'id'    => 43,
                'title' => 'page_access',
            ],
            [
                'id'    => 44,
                'title' => 'page_settings',
            ],
            [
                'id'    => 45,
                'title' => 'category_access',
            ],
            [
                'id'    => 46,
                'title' => 'category_create',
            ],
            [
                'id'    => 47,
                'title' => 'category_update',
            ],
            [
                'id'    => 48,
                'title' => 'category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'category_show',
            ],
            [
                'id'    => 50,
                'title' => 'brand_access',
            ],
            [
                'id'    => 51,
                'title' => 'brand_create',
            ],
            [
                'id'    => 52,
                'title' => 'brand_update',
            ],
            [
                'id'    => 53,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 54,
                'title' => 'brand_show',
            ],
            [
                'id'    => 55,
                'title' => 'slider_access',
            ],
            [
                'id'    => 56,
                'title' => 'slider_create',
            ],
            [
                'id'    => 57,
                'title' => 'slider_update',
            ],
            [
                'id'    => 58,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 59,
                'title' => 'slider_show',
            ],
            [
                'id'    => 60,
                'title' => 'featuredbanner_access',
            ],
            [
                'id'    => 61,
                'title' => 'featuredbanner_create',
            ],
            [
                'id'    => 62,
                'title' => 'featuredbanner_update',
            ],
            [
                'id'    => 63,
                'title' => 'featuredbanner_delete',
            ],
            [
                'id'    => 64,
                'title' => 'featuredbanner_show',
            ],
            [
                'id'    => 65,
                'title' => 'subcategory_access',
            ],
            [
                'id'    => 66,
                'title' => 'subcategory_create',
            ],
            [
                'id'    => 67,
                'title' => 'subcategory_update',
            ],
            [
                'id'    => 68,
                'title' => 'subcategory_delete',
            ],
            [
                'id'    => 69,
                'title' => 'subcategory_show',
            ],
            [
                'id'    => 70,
                'title' => 'blogcategory_access',
            ],
            [
                'id'    => 71,
                'title' => 'blogcategory_create',
            ],
            [
                'id'    => 72,
                'title' => 'blogcategory_update',
            ],
            [
                'id'    => 73,
                'title' => 'blogcategory_delete',
            ],
            [
                'id'    => 74,
                'title' => 'blogcategory_show',
            ],
            [
                'id'    => 75,
                'title' => 'currency_access',
            ],
            [
                'id'    => 76,
                'title' => 'currency_create',
            ],
            [
                'id'    => 77,
                'title' => 'currency_update',
            ],
            [
                'id'    => 78,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 79,
                'title' => 'currency_show',
            ],
            [
                'id'    => 80,
                'title' => 'email_access',
            ],
            [
                'id'    => 81,
                'title' => 'email_create',
            ],
            [
                'id'    => 82,
                'title' => 'email_update',
            ],
            [
                'id'    => 83,
                'title' => 'email_delete',
            ],
            [
                'id'    => 84,
                'title' => 'email_show',
            ],
        ];

        Permission::insert($permissions);
    }
}
