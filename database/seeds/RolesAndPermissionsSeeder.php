<?php

use Illuminate\Database\Seeder;
use App\Models\{
    Role, Permission
};

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->delete();
        Role::create(['name' => 'events', 'display_name' => ' Events Role']);
        Role::create(['name' => 'agreements', 'display_name' => ' Agreements Role']);
        Role::create(['name' => 'topics', 'display_name' => ' Topics Role']);
        Role::create(['name' => 'news', 'display_name' => ' News Role']);
        Role::create(['name' => 'calls', 'display_name' => ' Calls Role']);
        Role::create(['name' => 'offers', 'display_name' => ' Offers Role']);
        Role::create(['name' => 'sub-users', 'display_name' => ' Sub Users Role']);

        DB::table('permissions')->delete();
        $permissions = ['create', 'read', 'update', 'delete'];
        $roles = ['event', 'agreement', 'topic', 'new', 'call', 'offer'];

        foreach ($permissions as $permission) {
            foreach ($roles as $role) {
                $new_role = Role::where('name', $role . 's')->first();
                $new_permission = Permission::create(['name' => $permission . '-' . $role, 'display_name' => $permission . ' ' . $role . ' Permission']);
                $new_role->attachPermission($new_permission);
            }
        }

        $countries = \App\Models\User::where('type', 1)->whereNull('parent_id')->get();
        $roles_objects = Role::all()->toArray();
        foreach ($countries as $country) {
            $new_role = Role::where('name', $role . 's')->first();
            $country->attachRoles($roles_objects);
        }

    }
}
