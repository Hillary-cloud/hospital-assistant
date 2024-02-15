<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        $arrayOfPermissionNames = [
          'view-users','create-user','edit-user','destroy-user',
          'view-access-control',
          'view-role','edit-role','destroy-role','create-role',
          'view-permission','create-permission','edit-permission','destroy-permission',
          'backup-app','backup-db','view-settings',
          'view-consultations', 'create-consultations', 'view-payments', 'all-payments', 'my-payments',
          'view-feedbacks','index-feedbacks','create-feedbacks','view-records','create-records','index-records','edit-records'

        ];
       $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
           return ['name' => $permission, 'guard_name' => 'web'];
       });

      Permission::insert($permissions->toArray());

        // create roles and assign permissions
        $role = Role::create(['name' => 'patient'])
         ->givePermissionTo(['view-consultation', 'create-consultation','view-payment','my-payment','index-feedbacks','create-feedbacks','view-records','index-records']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
