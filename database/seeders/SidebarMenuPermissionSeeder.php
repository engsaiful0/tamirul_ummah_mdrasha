<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SidebarMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $permissions = array(
        array('id' => '866','module' => NULL,'sidebar_menu' => 'academics','old_id' => NULL,'section_id' => '1','parent_id' => '0','name' => 'Extra curricular Class','route' => 'extra-curricular','parent_route' => 'academics','type' => '2','lang_name' => 'academics.extra_class','icon' => NULL,'svg' => NULL,'status' => '1','menu_status' => '1','position' => '10','is_saas' => '0','relate_to_child' => '0','is_menu' => '1','is_admin' => '1','is_teacher' => '0','is_student' => '0','is_parent' => '0','created_by' => '1','updated_by' => '1','permission_section' => '0','alternate_module' => NULL,'user_id' => NULL,'school_id' => '1','created_at' => NULL,'updated_at' => NULL),

        array('id' => '867','module' => NULL,'sidebar_menu' => NULL,'old_id' => NULL,'section_id' => '1','parent_id' => '0','name' => 'Quick payment','route' => 'quick_payment','parent_route' => NULL,'type' => '1','lang_name' => 'fees.quick_payment','icon' => 'flaticon-wallet','svg' => NULL,'status' => '1','menu_status' => '1','position' => '1','is_saas' => '0','relate_to_child' => '0','is_menu' => '1','is_admin' => '1','is_teacher' => '0','is_student' => '0','is_parent' => '0','created_by' => '1','updated_by' => '1','permission_section' => '0','alternate_module' => NULL,'user_id' => NULL,'school_id' => '1','created_at' => NULL,'updated_at' => NULL)

        );
        DB::table('permissions')->insert($permissions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
