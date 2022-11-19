<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = "Admin";
        $user->email = "admin@domain.com";
        $user->password = "test1234";
        $user->save();

        $user = new User;
        $user->name = "Staff";
        $user->email = "staff@domain.com";
        $user->password = "test1234";
        $user->save();
    }
}
