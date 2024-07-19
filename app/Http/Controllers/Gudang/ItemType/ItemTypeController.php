<?php

namespace App\Http\Controllers\Gudang\ItemType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\ItemType\ItemTypeCreateRequest;
use App\Http\Requests\Gudang\ItemType\ItemTypeUpdateRequest;
use App\Models\ItemType;
use Illuminate\Support\Facades\Auth;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Mendapatkan daftar jenis barang dari semua pengguna
     * dan menampilkannya di halaman jenis barang
     *
     */
    public function index()
    {
        // Mengambil semua data jenis barang
        $itemTypes = ItemType::all();

        // Menampilkan view dengan data jenis barang
        return view('gudang.item-type.index', compact('itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * Metode ini menampilkan form untuk membuat jenis barang baru.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('gudang.item-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Metode ini menangani penyimpanan tipe item baru berdasarkan
     * data disediakan oleh ItemTypeCreateRequest.
     *
     * @param  \App\Http\Requests\Gudang\ItemType\ItemTypeCreateRequest  $request
     * @return \Illuminate\Http\JsonResponse
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
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        // Mengambil data jenis barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $itemType = ItemType::findOrFail($id);

        // Menampilkan view 'gudang.item-type.show' dengan data $itemType
        return view('gudang.item-type.show', compact('itemType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        // Mengambil data jenis barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $itemType = ItemType::findOrFail($id);

        // Menampilkan view 'gudang.item-type.edit' dengan data $itemType
        return view('gudang.item-type.edit', compact('itemType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Gudang\ItemType\ItemTypeUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
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
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
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
