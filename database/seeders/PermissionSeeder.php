<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'manage-tables';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'manage-users';
        $manageUser->save();
    }
}
