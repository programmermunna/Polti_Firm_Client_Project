<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $role = Role::create(['name' => 'admin']);

        $permissions = [
            ['name' => 'user list'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'role list'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'account list'],
            ['name' => 'create account'],
            ['name' => 'edit account'],
            ['name' => 'delete account'],
            ['name' => 'branch list'],
            ['name' => 'create branch'],
            ['name' => 'edit branch'],
            ['name' => 'delete branch'],
            ['name' => 'buyer list'],
            ['name' => 'create buyer'],
            ['name' => 'edit buyer'],
            ['name' => 'delete buyer'],
            ['name' => 'category list'],
            ['name' => 'create category'],
            ['name' => 'edit category'],
            ['name' => 'delete category'],
            ['name' => 'cost list'],
            ['name' => 'create cost'],
            ['name' => 'edit cost'],
            ['name' => 'delete cost'],
            ['name' => 'polti list'],
            ['name' => 'create polti'],
            ['name' => 'edit polti'],
            ['name' => 'delete polti'],
            ['name' => 'poltisell list'],
            ['name' => 'create poltisell'],
            ['name' => 'edit poltisell'],
            ['name' => 'delete poltisell'],
            ['name' => 'expense list'],
            ['name' => 'create expense'],
            ['name' => 'edit expense'],
            ['name' => 'delete expense'],
            ['name' => 'food list'],
            ['name' => 'create food'],
            ['name' => 'edit food'],
            ['name' => 'delete food'],
            ['name' => 'income list'],
            ['name' => 'create income'],
            ['name' => 'edit income'],
            ['name' => 'delete income'],
            ['name' => 'invoice list'],
            ['name' => 'create invoice'],
            ['name' => 'edit invoice'],
            ['name' => 'delete invoice'],
            ['name' => 'pregnancy list'],
            ['name' => 'create pregnancy'],
            ['name' => 'edit pregnancy'],
            ['name' => 'delete pregnancy'],
            ['name' => 'semen list'],
            ['name' => 'create semen'],
            ['name' => 'edit semen'],
            ['name' => 'delete semen'],
            ['name' => 'staff list'],
            ['name' => 'create staff'],
            ['name' => 'edit staff'],
            ['name' => 'delete staff'],
            ['name' => 'staffsalary list'],
            ['name' => 'create staffsalary'],
            ['name' => 'edit staffsalary'],
            ['name' => 'delete staffsalary'],
            ['name' => 'unit list'],
            ['name' => 'create unit'],
            ['name' => 'edit unit'],
            ['name' => 'delete unit'],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }

        $role->syncPermissions(Permission::all());

        $user->assignRole($role);
    }
}
