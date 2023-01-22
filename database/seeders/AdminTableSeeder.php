<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id' => 1, 'name' => 'Moaaz', 'type' => 'superadmin', 'vendor_id' => 0, 'mobile' => '01014980603' , 'email' => 'superadmin@admin.com', 'password' => bcrypt('00'), 'image' => '', 'status' =>1],
            ['id' => 2, 'name' => 'Amen', 'type' => 'admin', 'vendor_id' => 0, 'mobile' => '01014980603' , 'email' => 'admin@admin.com', 'password' => bcrypt('00'), 'image' => '', 'status' =>1],
            ['id' => 3, 'name' => 'Wafaa', 'type' => 'Vendor', 'vendor_id' => 1, 'mobile' => '01014980603' , 'email' => 'vendor@admin.com', 'password' => bcrypt('00'), 'image' => '', 'status' =>1],        ];
        Admin::insert($adminRecords);
    }
}
