<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        DB::table('payments')->insert([
            ['payment_id' =>214,'booking_id' => 'A445', 'amount' => 500.00, 'payment_status' => 'success'],
            ['payment_id' => 616,'booking_id' => 'ABC1234', 'amount' => 300.00, 'payment_status' => 'fail'],
        ]);
    }
}
