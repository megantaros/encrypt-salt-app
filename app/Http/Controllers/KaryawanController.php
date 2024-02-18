<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use App\Traits\UploadFile;
use App\Traits\Salt;

class KaryawanController extends Controller
{
    //
    use UploadFile;
    use Salt;
    public function login(Request $request)
    {
        $karyawan = Karyawan::where('nik', $request->nik)->first();

        if ($karyawan) {

            $compare = $this->compare($request->password, $karyawan->salt, $karyawan->password);
            // dd($compare['new_hashed_password'], $compare['hashed_password'], $compare['salted_password']);
            if ($compare == true) {
                $token = bcrypt($karyawan->id_karyawan . $karyawan->nama_karyawan . time());
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Login berhasil, harap menjaga kerahasiaan data Anda',
                        'data' => $karyawan,
                        'token' => $token
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Login gagal',
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Login gagal',
                ]
            );
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'id_jabatan' => 'required',
            'nik' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'ktp' => 'required',
            'kk' => 'required',
            'no_telpon' => 'required',
            'nip' => 'required'
        ]);

        $data = $this->generate($request->password);

        $karyawan = Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'id_jabatan' => $request->id_jabatan,
            'nik' => $request->nik,
            'password' => $data['hashed_password'],
            'salt' => $data['salt'],
            'alamat' => $request->alamat,
            'ktp' => $this->uploadFile($request->file('ktp'), 'ktp'),
            'kk' => $request->kk,
            'no_telpon' => $request->no_telpon,
            'nip' => $request->nip
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data karyawan berhasil disimpan',
                'data' => $karyawan
            ]
        );
    }

    public function index()
    {
        $karyawan = Karyawan::join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.nama_karyawan', 'jabatan.nama_jabatan', 'karyawan.id_karyawan', 'karyawan.nik', 'karyawan.created_at')
            ->get();

        if (!$karyawan) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data karyawan tidak ditemukan',
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data karyawan berhasil diambil',
                'data' => $karyawan
            ]
        );
    }

    public function show($id)
    {
        $karyawan = Karyawan::join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.*', 'jabatan.nama_jabatan')
            ->where('id_karyawan', $id)
            ->first();

        if ($karyawan) {
            return view('karyawan.show', compact('karyawan'));
        }
    }
    public function edit($id)
    {
        $karyawan = Karyawan::join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.*', 'jabatan.nama_jabatan')
            ->where('id_karyawan', $id)
            ->first();

        $jabatan = \App\Models\Jabatan::all();

        if ($karyawan) {
            return view('karyawan.edit', compact('karyawan', 'jabatan'));
        }
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::where('id_karyawan', $id)->first();

        if ($karyawan) {
            $data = $this->generate($request->password);
            if ($request->password) {
                $karyawan->update([
                    'nama_karyawan' => $request->nama_karyawan,
                    'id_jabatan' => $request->id_jabatan,
                    'nik' => $request->nik,
                    'password' => $data['hashed_password'],
                    'salt' => $data['salt'],
                    'alamat' => $request->alamat,
                    'no_telpon' => $request->no_telpon,
                    'nip' => $request->nip
                ]);
            }

            if ($request->hasFile('ktp')) {
                $this->deleteFile('ktp', $karyawan->ktp);

                $ktp = $this->uploadFile($request->file('ktp'), 'ktp');
                $karyawan->ktp = $ktp;
                $karyawan->save();

                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Foto KTP berhasil diubah',
                    ]
                );
            }

            $karyawan->update([
                'nama_karyawan' => $request->nama_karyawan,
                'id_jabatan' => $request->id_jabatan,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telpon' => $request->no_telpon,
                'nip' => $request->nip
            ]);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Data karyawan berhasil diubah',
                    'data' => $karyawan
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data karyawan gagal diubah',
                    'data' => null
                ]
            );
        }
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::where('id_karyawan', $id)->first();
        $perizinan = Perizinan::where('id_karyawan', $id)->get();

        if ($karyawan) {
            $this->deleteFile('ktp', $karyawan->ktp);
            foreach ($perizinan as $p) {
                $p->delete();
            }
            $karyawan->delete();
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Data karyawan berhasil dihapus',
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data karyawan gagal dihapus',
                ]
            );
        }
    }
}