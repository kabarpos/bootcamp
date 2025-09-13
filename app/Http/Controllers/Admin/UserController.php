<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with(['roles', 'enrollments']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->get('role'));
            });
        }

        $users = $query->latest()->paginate(15);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles' => 'array',
            'roles.*' => 'exists:role,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now(); // Auto verify admin created users

        $user = User::create($validated);

        // Attach roles
        if (isset($validated['roles'])) {
            $user->roles()->attach($validated['roles']);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['roles', 'enrollments.batch.bootcamp', 'orders']);
        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');
        
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles' => 'array',
            'roles.*' => 'exists:role,id',
        ]);

        // Only update password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        // Sync roles
        $user->roles()->sync($validated['roles'] ?? []);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting current admin user
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        // Check if user has enrollments
        if ($user->enrollments()->exists()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus user yang memiliki enrollment aktif.');
        }

        // Detach roles
        $user->roles()->detach();
        
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Verify user email.
     */
    public function verifyEmail(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return redirect()->back()
                ->with('info', 'Email user sudah terverifikasi.');
        }

        $user->markEmailAsVerified();

        return redirect()->back()
            ->with('success', 'Email user berhasil diverifikasi.');
    }

    /**
     * Reset user password.
     */
    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->back()
            ->with('success', 'Password user berhasil direset.');
    }

    /**
     * Toggle user status (if you have is_active field).
     */
    public function toggleStatus(User $user)
    {
        // This assumes you have is_active field in users table
        // If not, you can remove this method
        if (!$user->hasAttribute('is_active')) {
            return redirect()->back()
                ->with('error', 'Fitur status tidak tersedia.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "User berhasil {$status}.");
    }

    /**
     * Assign role to user.
     */
    public function assignRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:role,id'
        ]);

        if (!$user->roles()->where('role_id', $validated['role_id'])->exists()) {
            $user->roles()->attach($validated['role_id']);
            
            $role = Role::find($validated['role_id']);
            return redirect()->back()
                ->with('success', "Role {$role->name} berhasil ditambahkan ke user.");
        }

        return redirect()->back()
            ->with('info', 'User sudah memiliki role tersebut.');
    }

    /**
     * Remove role from user.
     */
    public function removeRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:role,id'
        ]);

        $user->roles()->detach($validated['role_id']);
        
        $role = Role::find($validated['role_id']);
        return redirect()->back()
            ->with('success', "Role {$role->name} berhasil dihapus dari user.");
    }
}