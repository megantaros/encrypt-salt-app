<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $data = Karyawan::join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('slip_gaji', 'karyawan.id_karyawan', '=', 'slip_gaji.id_karyawan')
            ->select('karyawan.nama_karyawan', 'jabatan.nama_jabatan', 'karyawan.id_karyawan', 'karyawan.nik', 'karyawan.created_at', 'slip_gaji.gaji_pokok')
            ->get();

        $jabatan = \App\Models\Jabatan::all();

        return view('admin.dashboard', compact('data', 'jabatan'));
    }
    public function gaji()
    {
        return view('gaji.index');
    }
    public function jabatan()
    {
        return view('jabatan.index');
    }

    // public function karyawan()
    // {
    //     return view('admin.karyawan');
    // }
    // public function tunjangan()
    // {
    //     return view('admin.tunjangan');
    // }
}