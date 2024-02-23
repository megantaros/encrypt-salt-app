<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use Illuminate\Http\Request;

class TunjanganController extends Controller
{
    //
    public function index($id_slip_gaji)
    {
        $data = Tunjangan::where('id_slip_gaji', $id_slip_gaji)->get();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tunjangan tidak ditemukan'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data tunjangan berhasil ditemukan',
            'data' => $data
        ]);
    }
    public function store(Request $request)
    {
        $data = Tunjangan::create([
            'id_slip_gaji' => $request->id_slip_gaji,
            'nama_tunjangan' => $request->nama_tunjangan,
            'jumlah_tunjangan' => $request->jumlah_tunjangan
        ]);

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tunjangan gagal ditambahkan'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data tunjangan berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id_tunjangan)
    {
        $data = Tunjangan::find($id_tunjangan);
        $data->nama_tunjangan = $request->nama_tunjangan;
        $data->jumlah_tunjangan = $request->jumlah_tunjangan;
        $data->save();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tunjangan gagal diubah'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data tunjangan berhasil diubah',
            'data' => $data
        ]);
    }

    public function destroy($id_tunjangan)
    {
        $data = Tunjangan::find($id_tunjangan);
        $data->delete();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tunjangan gagal dihapus'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data tunjangan berhasil dihapus'
        ]);
    }
}