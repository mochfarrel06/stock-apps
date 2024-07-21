<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('administrator.user-management.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.user-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:Administrator,Gudang,Manajer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        session()->flash('success', 'Berhasil menambahkan data pengguna');
        return response()->json(['success' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('administrator.user-management.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => 'required|in:Administrator,Gudang,Manajer',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        session()->flash('success', 'Berhasil menambahkan data pengguna');
        return response()->json(['success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mengambil satuan barang berdasarkan ID. Jika tidak ditemukan, melempar exception.
            $user = User::findOrFail($id);

            // Menghapus data satuan barang dari database
            $user->delete();

            // Memberikan respons bahwa penghapusan berhasil
            return response(['status' => 'success', 'message' => 'Berhasil menghapus data pada satuan barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
