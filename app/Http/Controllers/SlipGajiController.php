<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\SlipGaji;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    //
    public function index()
    {
        $data = SlipGaji::all();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = SlipGaji::create([
            'id_karyawan' => $request->id_karyawan,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = SlipGaji::find($id);
        $data->id_karyawan = $request->id_karyawan;
        $data->gaji_pokok = $request->gaji_pokok;
        $data->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diubah'
            ]);
        }
    }

}