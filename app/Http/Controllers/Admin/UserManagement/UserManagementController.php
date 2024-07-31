<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserManagement\UserManagementCreateRequest;
use App\Http\Requests\Admin\UserManagement\UserManagementUpdateRequest;
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
        $users = User::where('role', '!=', 'Administrator')->get();

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
    public function store(UserManagementCreateRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'Berhasil menambahkan data pengguna');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan error
            session()->flash('error', 'Terdapat kesalahan pada proses data barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
    public function update(UserManagementUpdateRequest $request, string $id)
    {
        try {
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
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan error
            session()->flash('error', 'Terdapat kesalahan pada proses data barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
