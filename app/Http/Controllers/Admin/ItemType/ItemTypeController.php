<?php

namespace App\Http\Controllers\Admin\ItemType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Item\ItemCreateRequest;
use App\Http\Requests\Admin\ItemType\ItemTypeCreateRequest;
use App\Http\Requests\Admin\ItemType\ItemTypeUpdateRequest;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data jenis barang
        $itemTypes = ItemType::all();

        // Menampilkan view dengan data jenis barang
        return view('administrator.item-type.index', compact('itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.item-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemTypeCreateRequest $request)
    {
        try {
            $userId = Auth::id();

            // Membuat instance baru dari model ItemType dengan data yang diterima dari request
            $itemTypes = new ItemType([
                'user_id' => $userId,
                'name' => $request->name,
            ]);

            // Menyimpan instance ItemType ke dalam database
            $itemTypes->save();

            // Mengirimkan respons sukses jika penyimpanan berhasil
            session()->flash('success', 'Berhasil menambahkan jenis barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Mengirimkan respons error jika terjadi kesalahan saat penyimpanan
            session()->flash('error', 'Terdapat kesalahan pada proses jenis barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data jenis barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $itemType = ItemType::findOrFail($id);

        // Menampilkan view 'gudang.item-type.show' dengan data $itemType
        return view('administrator.item-type.show', compact('itemType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil data jenis barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $itemType = ItemType::findOrFail($id);

        // Menampilkan view 'gudang.item-type.edit' dengan data $itemType
        return view('administrator.item-type.edit', compact('itemType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemTypeUpdateRequest $request, string $id)
    {
        try {
            // Mengambil jenis barang berdasarkan ID. Jika tidak ditemukan, melempar exception.
            $itemType = ItemType::findOrFail($id);

            // Mengisi model $itemType dengan data dari request
            $itemType->fill($request->all());

            // Memeriksa apakah ada perubahan data
            if ($itemType->isDirty()) {
                // Jika ada perubahan, lakukan update pada nama jenis barang
                $itemType->update([
                    'name' => $request->name,
                ]);

                // Flash message untuk berhasil melakukan perubahan
                session()->flash('success', "Berhasil melakukan perubahan data pada jenis barang");
                return response()->json(['success' => true], 200);
            } else {
                // Jika tidak ada perubahan
                session()->flash('info', "Tidak melakukan perubahan data pada jenis barang");
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan
            session()->flash('error', 'Terdapat kesalahan data jenis barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mengambil jenis barang berdasarkan ID. Jika tidak ditemukan, melempar exception.
            $itemType = ItemType::findOrFail($id);

            // Menghapus data jenis barang dari database
            $itemType->delete();

            // Memberikan respons bahwa penghapusan berhasil
            return response(['status' => 'success', 'message' => 'Berhasil menghapus data pada jenis barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
