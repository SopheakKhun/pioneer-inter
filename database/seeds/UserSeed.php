<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'lname' => 'Admin', 'email' => 'admin@admin.com', 'address' => '11 Hope Street', 'suburb' => 'Parramatta', 'state' => 'NSW', 'postcode' => '2150', 'phone' => '9876543210', 'password' => '$2y$10$3vL9gsha0w5ZF1uphLIQFumFd3io9cAJ0XZZJyGn3.7.9qcOU.RTK', 'remember_token' => '',],
            ['id' => 2, 'name' => 'Customer', 'lname' => 'Customer ', 'email' => 'customer@customer.com', 'address' => '11 Hope Street', 'suburb' => 'Parramatta', 'state' => 'NSW', 'postcode' => '2150', 'phone' => '04567856', 'password' => '$2y$10$lhPqM6BkKur6Ib7BhjWhlu84MGxHDvxDDc6ELUrdLi.ACcgneISLG', 'remember_token' => null,],
            ['id' => 3, 'name' => 'Staff', 'lname' => 'Staff', 'email' => 'staff@staff.com', 'address' => '11 Hope Street', 'suburb' => 'Parramatta', 'state' => 'NSW', 'postcode' => '2150', 'phone' => '04567898', 'password' => '$2y$10$WE6SVS3wi5RjTbsleuZySeCZ3PwWFOp8sb2yMTEtTKRkz0y5dWwym', 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
