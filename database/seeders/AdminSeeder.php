<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin')->insert([
            [
                'admin_id' => '12322',
                'admin_name' => 'Admin One',
                'admin_email' => 'admin1@example.com',
                'admin_pass' => bcrypt('adminpassword'),
                'booking_id' => 'ABC1234'
            ],
            [
                'admin_id' => '13322',
                'admin_name' => 'Admin Two',
                'admin_email' => 'admin2@example.com',
                'admin_pass' => bcrypt('adminpassword'),
                'booking_id' => 'A445',
            ],
        ]);
    }
}
