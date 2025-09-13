<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::with(['users', 'permissions']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $roles = $query->latest()->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:role,name',
            'guard_name' => 'required|string|max:100',
            'permissions' => 'array',
            'permissions.*' => 'exists:permission,id',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        // Attach permissions
        if (isset($validated['permissions'])) {
            $role->permissions()->attach($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load(['users', 'permissions']);
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('role', 'name')->ignore($role->id)
            ],
            'guard_name' => 'required|string|max:100',
            'permissions' => 'array',
            'permissions.*' => 'exists:permission,id',
        ]);

        $role->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        // Sync permissions
        $role->permissions()->sync($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deleting admin role
        if ($role->name === 'admin') {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Role admin tidak dapat dihapus.');
        }

        // Check if role has users
        if ($role->users()->exists()) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Tidak dapat menghapus role yang masih digunakan oleh user.');
        }

        // Detach permissions
        $role->permissions()->detach();
        
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    /**
     * Assign permission to role.
     */
    public function assignPermission(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permission_id' => 'required|exists:permission,id'
        ]);

        if (!$role->permissions()->where('permission_id', $validated['permission_id'])->exists()) {
            $role->permissions()->attach($validated['permission_id']);
            
            $permission = Permission::find($validated['permission_id']);
            return redirect()->back()
                ->with('success', "Permission {$permission->name} berhasil ditambahkan ke role.");
        }

        return redirect()->back()
            ->with('info', 'Role sudah memiliki permission tersebut.');
    }

    /**
     * Remove permission from role.
     */
    public function removePermission(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permission_id' => 'required|exists:permission,id'
        ]);

        $role->permissions()->detach($validated['permission_id']);
        
        $permission = Permission::find($validated['permission_id']);
        return redirect()->back()
            ->with('success', "Permission {$permission->name} berhasil dihapus dari role.");
    }

    /**
     * Bulk assign permissions to role.
     */
    public function bulkAssignPermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permission,id'
        ]);

        $role->permissions()->sync($validated['permissions']);

        return redirect()->back()
            ->with('success', 'Permissions berhasil diperbarui.');
    }

    /**
     * Get users with specific role (for AJAX).
     */
    public function getUsersByRole(Role $role)
    {
        $users = $role->users()->select('id', 'name', 'email')->get();
        
        return response()->json($users);
    }

    /**
     * Clone role with all permissions.
     */
    public function clone(Role $role)
    {
        $newRole = Role::create([
            'name' => $role->name . ' (Copy)',
            'guard_name' => $role->guard_name,
        ]);

        // Copy all permissions
        $permissionIds = $role->permissions()->pluck('permission.id')->toArray();
        $newRole->permissions()->attach($permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil diduplikasi.');
    }
}