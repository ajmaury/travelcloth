<?php

namespace Database\Seeders;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name'         => Str::random(10),
            'email'     => Str::random(10)."@gmail.com",
            'password'    => bcrypt('abc123'),
            'mobile'    => '12345627889',
            'image'       => '',
            'status'            => 1
        ]);
    }
}
