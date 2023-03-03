<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('access_user_management'), 403);

        return view('admin.roles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->givePermissionTo($request->permissions);

        toast('Role Created With Selected Permissions!', 'success');

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        toast('Role Updated With Selected Permissions!', 'success');

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $role->delete();

        toast('Role Deleted!', 'success');

        return redirect()->route('roles.index');
    }
}
