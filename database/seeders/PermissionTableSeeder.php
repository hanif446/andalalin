<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermission = [];
        $superAdminPermissions = [];
        $adminPermissions = [];
        $userPermissions = [];

        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' =>  date('Y-m-d H:i:s'),
                ];

                //superAdmin
                $superAdminPermissions[] = $permission;

                //Admin
                if (in_array($label, ['manage_data_permohonan', 'manage_data_pemohon', 'manage_users'])) {
                    $adminPermissions[] = $permission;
                }

                //User
                if (in_array($label, ['manage_pengajuan_permohonan', 'manage_edit_profil'])) {
                    $userPermissions[] = $permission;
                }
            }
        }

        //Insert permission

        Permission::insert($listPermission);

        //Insert roles
        //SuperAdmin
        $superAdmin = Role::create([
            'name' => "SuperAdmin",
            'guard_name' => 'web',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);

        //Admin
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);

        //User
        $user = Role::create([
            'name' => "User",
            'guard_name' => 'web',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s'),
        ]);

        //Role -> permission
        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);
        $user->givePermissionTo($userPermissions);

        //
        $userSuperAdmin = User::find(1)->assignRole("SuperAdmin");
    }
}
