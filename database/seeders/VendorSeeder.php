<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //VendorFactoryクラスで定義した内容に沿ってダミーを５つ作成する
        Vendor::factory()->count(5)->create();
    }
}
