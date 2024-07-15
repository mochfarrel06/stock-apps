<?php

namespace App\Http\Controllers\Gudang\UnitType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\UnitType\UnitTypeCreateRequest;
use App\Http\Requests\Gudang\UnitType\UnitTypeUpdateRequest;
use App\Models\UnitType;
use Illuminate\Support\Facades\Auth;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Mendapatkan daftar satuan barang dari semua pengguna
     * dan menampilkannya di halaman satuan barang
     *
     */
    public function index()
    {
        $unitTypes = UnitType::all();

        return view('gudang.unit-type.index', compact('unitTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * Metode ini menampilkan form untuk membuat satuan barang baru.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('gudang.unit-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method handles the storage of a new item type based on the data
     * provided by the UnitTypeCreateRequest.
     *
     * @param  \App\Http\Requests\Gudang\UnitType\UnitTypeCreateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UnitTypeCreateRequest $request)
    {
        try {
            // Membuat instance baru dari model UnitType dengan data yang diterima dari request
            $userId = Auth::id();

            $unitTypes = new UnitType([
                'user_id' => $userId,
                'name' => $request->name,
            ]);

            // Menyimpan instance UnitType ke dalam database
            $unitTypes->save();

            // Mengirimkan respons sukses jika penyimpanan berhasil
            session()->flash('success', 'Berhasil menambahkan satuan barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Mengirimkan respons error jika terjadi kesalahan saat penyimpanan
            session()->flash('error', 'Terdapat kesalahan pada proses satuan barang: ' . $e->getMessage());
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
        // Mengambil data satuan barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $unitType = UnitType::findOrFail($id);

        // Menampilkan view 'gudang.unit-type.show' dengan data $unitType
        return view('gudang.unit-type.show', compact('unitType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        // Mengambil data satuan barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $unitType = UnitType::findOrFail($id);

        // Menampilkan view 'gudang.unit-type.show' dengan data $unitType
        return view('gudang.unit-type.edit', compact('unitType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Gudang\UnitType\UnitTypeUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UnitTypeUpdateRequest $request, string $id)
    {
        try {
            // Mengambil satuan barang berdasarkan ID. Jika tidak ditemukan, melempar exception.
            $unitType = UnitType::findOrFail($id);

            // Mengisi model $unitType dengan data dari request
            $unitTypes = $request->all();
            $unitType->fill($unitTypes);

            // Memeriksa apakah ada perubahan data
            if ($unitType->isDirty()) {
                // Jika ada perubahan, lakukan update pada nama satuan barang
                $unitType->update([
                    'name' => $request->name
                ]);

                // Flash message untuk berhasil melakukan perubahan
                session()->flash('success', "Berhasil melakukan perubahan data pada satuan barang");
                return response()->json(['success' => true], 200);
            } else {
                // Jika tidak ada perubahan
                session()->flash('info', "Tidak melakukan perubahan data pada satuan barang");
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan
            session()->flash('error', 'Terdapat kesalahan data satuan barang: ' . $e->getMessage());
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
            // Mengambil satuan barang berdasarkan ID. Jika tidak ditemukan, melempar exception.
            $unitType = UnitType::findOrFail($id);

            // Menghapus data satuan barang dari database
            $unitType->delete();

            // Memberikan respons bahwa penghapusan berhasil
            return response(['status' => 'success', 'message' => 'Berhasil menghapus data pada satuan barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
