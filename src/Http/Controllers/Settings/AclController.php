<?php

namespace Xup\Web\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Xup\Core\Models\Access\Permission;
use Xup\Core\Models\Access\Role;
use Xup\Web\Http\Requests\Acl\StoreRoleRequest;
use Xup\Web\Http\Requests\Acl\UpdateRoleRequest;

class AclController extends Controller
{

    /**
     * Main Role list
     */
    public function index()
    {
        return view('xup::Settings.roles.index');
    }

    public function store(StoreRoleRequest $request)
    {

        $role = Role::create($request->get('role'));

        return redirect(route('settings.acl.edit', ['role' => $role]))
            ->with('success', "Role '{$role->title}' was created");
    }

    public function edit(Role $role)
    {
        $role_permissions = $role->permissions->pluck('title');

        return view('xup::Settings.roles.edit-role', compact('role', 'role_permissions'));
    }

    private function manage_permissions(Role $role, $new_permissions)
    {
        foreach (config('xup.permissions') as $scope => $permissions) {
            if (!is_array($permissions))
                $permissions = [$permissions];

            foreach ($permissions as $permission => $meta) {
                $title = $permission;

                if (!is_array($meta)) {
                    $title = $meta;
                }

                if (!is_int($scope))
                    $title = sprintf('%s.%s', $scope, $title);

                $acl_model = Permission::firstOrCreate([
                    'title' => $title
                ]);

                if (!array_key_exists($acl_model->title, $new_permissions) && $role->permissions->contains($acl_model->getKey())) {
                    $role->permissions()->detach($acl_model->getKey());
                    continue;
                }

                if (array_key_exists($acl_model->title, $new_permissions) && !$role->permissions->contains($acl_model->getKey())) {
                    $role->permissions()->attach($acl_model->getKey());
                }
            }
        }
    }

    public function update_permissions(Role $role, UpdateRoleRequest $request)
    {

        $role->update($request->get('role'));


        $this->manage_permissions($role, $request->get('permissions', []));


        return back()->with('success', "Role was updated");
    }

    public function users(Role $role){
        return view('xup::Settings.roles.edit-users', compact('role'));
    }

    public function update_users(Role $role, UpdateRoleRequest $request)
    {
        $role->update($request->get('role'));

        $role->users()->sync($request->get('users', []));

        return back()->with('success', 'Role has been updated');
    }

    public function delete(Role $role)
    {
        $role->delete();

        return redirect(route('settings.acl.index'))
            ->with('success', "Role {$role->title} as deleted");
    }
}
