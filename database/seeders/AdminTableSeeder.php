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
            ['id' => 2, 'name' => 'Amen', 'type' => 'Vendor', 'vendor_id' => 1, 'mobile' => '01014980603' , 'email' => 'amen@briek.com',
                'password' => bcrypt('0000'), 'image' => '', 'status' =>0],
        ];
        Admin::insert($adminRecords);
    }
}
