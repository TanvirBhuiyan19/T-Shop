<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
              'role_id' => '1',
              'permission' => '{"brand":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"cat":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"subcat":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"subsubcat":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"product":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"slider":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"coupon":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"shipping":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"order":{"add":"1","view":"1","delete":"1","list":"1"},"report":{"view":"1"},"review":{"add":"1","view":"1","delete":"1","list":"1"},"stock":{"edit":"1","view":"1","list":"1"},"role":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"permission":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"subadmin":{"add":"1","edit":"1","view":"1","delete":"1","list":"1"},"chat":{"add":"1","view":"1"},"settings":{"view":"1"},"alluser":{"view":"1","delete":"1","list":"1"}}',
              'created_at' => Carbon::now(),
            ],
            
        ]);
        
    }
}
