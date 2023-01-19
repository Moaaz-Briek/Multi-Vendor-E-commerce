<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
          'id' => 1,
          'name' => 'Amen',
          'address' => 'Younes-Street',
          'city' => 'Shebien',
          'state' => 'Qalubia',
          'country' => 'Egypt',
          'pincode' => '13762',
          'mobile' => '01014980603',
          'email' => 'amen@briek.com',
            'status' => 0,
        ];
        Vendor::insert($vendorRecords);

    }
}
