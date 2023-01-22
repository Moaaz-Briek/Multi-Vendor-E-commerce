<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;
class VendorsBusinessDetailsTableSeeder extends Seeder
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
          'vendor_id' => 1,
          'shop_name' => 'Wafaa Yarn Store',
            'shop_address' => 'Younes-streat',
            'shop_city' => 'shebien',
            'shop_state' => 'qaluibia',
            'shop_country' => 'egypt',
            'shop_pincode' => '13762',
            'shop_mobile' => '0101173520',
            'shop_website' => 'Wafaa-Yarn.com',
            'shop_email' => 'Wafaa@briek.com',
            'address_prof' => 'passport',
            'address_prof_image' => 'test.jpg',
            'business_license_number' => '123456789',
        ];
        VendorsBusinessDetail::insert($vendorRecords);
    }
}
