<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    //
    public function index()
    {
        $data = Jabatan::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal ditambahkan',
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        $data = Jabatan::find($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diambil',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => null
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = Jabatan::find($id);
        $data->nama_jabatan = $request->nama_jabatan;
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
                'message' => 'Data gagal diubah',
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        $data = Jabatan::find($id);
        $data->delete();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal dihapus',
            ]);
        }
    }
}