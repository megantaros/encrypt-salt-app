@extends('admin.layout')

@section('title', 'Lihat Karyawan')

@section('page')
<x-modal id="modal-compare" title="Compare Password" size="modal-md">
    <form class="modal-body d-flex flex-column justify-content-center align-items-end">
        <div class="mb-2 w-100">
            <label for="salted-password" class="form-label">Salted Password</label>
            <input type="text" class="form-control" id="salted-password" placeholder="Enter salted password" value="{{$karyawan->password}}" disabled>
        </div>
        <div class="mb-2 w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Masukkan password">
        </div>
        <button class="btn btn-success px-5 btn-hash w-50">Hash</button>
    </form>
</x-modal>

<x-modal id="modal-gaji" title="Tambah Gaji Karyawan" size="modal-md">
    Cek Karyawan
</x-modal>

<div class="row">
    <div class="col-lg-8 col-md-8 col-12">
        <div class="card w-100 shadow-lg border">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-5">
                    Data Karyawan
                </h5>
    
                <div class="table-responsive">
                    <table class="table table-bordered border-1 align-middle">
                        <tbody>                 
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Nama Karyawan</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->nama_karyawan}}</h6>
                                </td>
                            </tr>                                     
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Jabatan</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->nama_jabatan}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">NIP</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->nip}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">NIK</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->nik}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">No. KK</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->kk}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">No. Telephone</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->no_telpon}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Alamat</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->alamat}}</h6>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Password</h6>                          
                                </td>
                                <td class="border-bottom-0 d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->password}}</h6>
                                    <button type="button" class="btn btn-sm btn-outline-info btn-compare" data-bs-toggle="modal" data-bs-target="#modal-compare">Compare</button>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Salt</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-3">{{$karyawan->salt}}</h6>
                                </td>
                            </tr>                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-12">
        <div class="card w-100 shadow-lg border">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-5">
                    Scan KTP
                </h5>
                <div class="d-flex flex-column gap-3">
                    <img src="{{asset('storage/ktp/' . $karyawan->ktp)}}" alt="Scan KTP" class="w-100 rounded shadow-sm object-fit-scale" style="height: 250px;">
                    <h5 class="m-0">Filename:</h5>
                    <p>{{$karyawan->ktp}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card w-100 shadow">
          <div class="card-body p-4">

            <div class="row mb-3">
              <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold m-0">Data Gaji Karyawan a/n {{$karyawan->nama_karyawan}}</h5>
              </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered border-1 align-middle">
                    <tbody>                 
                        <tr>
                            <td class="border-bottom-0 w-25 bg-light">
                                <h6 class="fw-semibold mb-0">Gaji Pokok</h6>                          
                            </td>
                            <td id="drawer-gaji" class="border-bottom-0 d-flex justify-content-between align-items-center">
                                @if($karyawan->gaji_pokok == null)
                                <h6 class="fw-semibold mb-0 fs-3">Gaji pokok belum ditambahkan</h6>
                                @else
                                <h6 class="fw-semibold mb-0 fs-3">Rp {{number_format($karyawan->gaji_pokok, 0, ',', '.')}}</h6>
                                @endif
                            </td>
                        <tr>                                              
                    </tbody>
                </table>
            </div>
    
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/js-md5@0.8.3/src/md5.min.js"></script>
<script src="{{asset('assets/js/pages/karyawan/show.init.js')}}"></script>
<script>
    const url_dashboard = "{{route('admin.dashboard')}}";
    const salt = "{{$karyawan->salt}}";
    const old_hashed_password = "{{$karyawan->password}}";
    const btn_compare = $('.btn-compare');
    const modal_compare = $('#modal-compare');
    const btn_hash = $('.btn-hash');

    const hashed_password_component = 
    `<div class="mb-2 w-100">
        <label for="hashed-password" class="form-label">Password + Salted Password</label>
        <input type="text" class="form-control" id="hashed-password" placeholder="Hashed password" disabled>
    </div>
    <button type="button" class="btn btn-success px-5 btn-encrypt w-50">Enkripsi MD5</button>
    `;
    const new_hashed_password_component = 
    `<div class="mb-2 w-100">
        <label for="new-hashed-password" class="form-label">New Hashed Password</label>
        <input type="text" class="form-control" id="new-hashed-password" placeholder="New Hashed Password" disabled>
    </div>
    `;
</script>
@endsection