<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            'vendor_id' => 1,
            'account_holder_name' => 'Wafaa Briek',
            'account_number' => '388961416185611655561',
            'bank_name' => 'Ahly-bank',
            'bank_ifsc_code' => '454545',
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}
