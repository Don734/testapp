<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fullname = 'Admin';
        $user->email = 'admin@granit-uzb.uz';
        $user->password = Hash::make('55525Granit!');
        $user->group = 'Администратор';
        $user->assignRole('Администратор');
        $user->save();
    }
}
