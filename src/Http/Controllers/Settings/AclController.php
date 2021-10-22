<?php

namespace Xup\Web\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
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
        return view('web::Settings.AccessList.index');
    }

    public function store(StoreRoleRequest $request){

        $role = Role::create($request->get('role'));


        return back()->with('success', "Role '{$role->title}' was created");
    }

    public function edit(Role $role){
        return view('web::Settings.AccessList.edit-role', compact('role'));
    }

    public function update(Role $role, UpdateRoleRequest $request){
        $role->update($request->get('role'));

        return back()->with('success', "Role was updated");
    }
}