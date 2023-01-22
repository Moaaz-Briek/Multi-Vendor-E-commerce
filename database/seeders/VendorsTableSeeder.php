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
          'id' => 1, 'name' => 'Wafaa', 'address' => 'Younes-Street', 'city' => 'Shebien', 'state' => 'Qalubia', 'country' => 'Egypt', 'pincode' => '13762', 'mobile' => '01014980603', 'email' => 'vendor@briek.com', 'status' => 1,
        ];
        Vendor::insert($vendorRecords);

    }
}
