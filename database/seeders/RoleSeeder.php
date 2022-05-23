<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
              'name' => 'Super Admin'  
            ],
            [
              'name' => 'User'  
            ],
            [
              'name' => 'Admin'  
            ],
            [
              'name' => 'Sub-Admin'  
            ],
            [
              'name' => 'Editor'  
            ],
            [
              'name' => 'Author'  
            ],
            [
              'name' => 'Communication Manager'  
            ],
            
        ]);

        DB::table('users')->where('id', 1)->update([
              'role_id' => '1'
        ]);
        
    }
}
