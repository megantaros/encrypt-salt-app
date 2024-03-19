@extends('admin.layout')

@section('title', 'Edit Karyawan')

@section('css')
<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
    }
    #containerImg:hover .overlay{
        opacity: 1;
        transition: all 0.5s;
    }
    #containerImg:hover #imgKtp {
        transition: all 0.8s;
        transform: scale(1.3);
    }
    label {
        cursor: pointer;
    }
</style>
@endsection

@section('page')
<x-modal id="modal-perizinan" title="Perizinan">
    @include('karyawan.modal.perizinan')
</x-modal>

<x-modal id="modal-add-gaji" title="Tambah Gaji Karyawan">
    @include('karyawan.modal.add-gaji')
</x-modal>

<x-modal id="modal-edit-gaji" title="Edit Gaji Karyawan">
    @include('karyawan.modal.edit-gaji')
</x-modal>

<x-modal id="modal-add-tunjangan" title="Tambah Tunjangan Karyawan">
    @include('karyawan.modal.add-tunjangan')
</x-modal>

<x-modal id="modal-edit-tunjangan" title="Edit Tunjangan Karyawan">
    @include('karyawan.modal.edit-tunjangan')
</x-modal>

<div class="row">
    <div class="col-lg-8 col-md-8 col-12">
        <div class="card w-100 shadow-lg border">
            <div class="card-body p-4">
                <h5 class="fw-semibold">
                    Data Karyawan
                </h5>
                <p class="text-label m-0">Dibuat {{\Carbon\Carbon::parse($karyawan->created_at)->locale('id')->diffForHumans()}}</p>
                <p class="text-label mb-3">Terakhir diubah {{\Carbon\Carbon::parse($karyawan->updated_at)->locale('id')->diffForHumans()}}</p>
    
                <div class="table-responsive">
                    <table class="table align-middle">
                        <tbody>                 
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Nama Karyawan</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="text" class="form-control m-0 fw-medium" id="nama_karyawan" value="{{$karyawan->nama_karyawan}}" required>
                                </td>
                            </tr>                                     
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Jabatan</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <select id="nama_jabatan" class="form-select">
                                        <option value="{{$karyawan->id_jabatan}}" selected>{{$karyawan->nama_jabatan}}</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{$item->id_jabatan}}">{{$item->nama_jabatan}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">NIP</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="text" class="form-control m-0 fw-medium" id="nip" value="{{$karyawan->nip}}" required>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">NIK</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="text" class="form-control m-0 fw-medium" id="nik" value="{{$karyawan->nik}}" required>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">No. KK</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="text" class="form-control m-0 fw-medium" id="kk" value="{{$karyawan->kk}}" required>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">No. Telephone</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="text" class="form-control m-0 fw-medium" id="no_telpon" value="{{$karyawan->no_telpon}}" required>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Alamat</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <textarea class="form-control m-0 fw-medium" id="alamat" required>{{$karyawan->alamat}}</textarea>
                                </td>
                            </tr>                   
                            <tr>
                                <td class="border-bottom-0 w-25 bg-light">
                                    <h6 class="fw-semibold mb-0">Password</h6>                          
                                </td>
                                <td class="border-bottom-0">
                                    <input type="password" class="form-control m-0 fw-medium" id="password" placeholder="Opsional" required>
                                </td>
                            </tr>                   
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn-warning w-100 btn-update">Update</button>
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
                <div id="containerImg" class="d-flex flex-column gap-3">
                    <div class="overflow-hidden position-relative rounded">
                        <div class="overlay">
                            <label for="inputKtp" class="text-center text-white position-absolute top-50 start-50 translate-middle">
                                <i class="ti ti-photo" style="font-size: 6rem"></i>
                                <h6 class="text-white">Upload KTP</h6>
                            </label>
                        </div>
                        <img id="imgKtp" src="{{asset('storage/ktp/' . $karyawan->ktp)}}" alt="Scan KTP" class="w-100 rounded shadow-sm object-fit-scale" style="height: 250px;">
                        <input type="file" id="inputKtp" class="d-none" accept="image/*">
                    </div>
                    <h5 class="m-0 p-0 fs-4">
                        Filename:
                        <span id="fileName" class="fs-3 text-dark">{{$karyawan->ktp}}</span>
                    </h5>
                    {{-- <p id="fileName">{{$karyawan->ktp}}</p> --}}
                </div>
            </div>
        </div>
        <button class="btn btn-danger w-100 btn-delete-karyawan">Hapus Karyawan</button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card w-100 shadow">
          <div class="card-body p-4">

            <div class="row mb-3">
              <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold m-0">Data Gaji Karyawan a/n {{$karyawan->nama_karyawan}}</h5>
                @if($karyawan->gaji_pokok != null)
                <a href="{{route('admin.cetak-slipgaji', $karyawan->id_slip_gaji)}}" target="_blank" class="btn btn-sm btn-primary">
                    <i class="ti ti-printer"></i>
                    <span>
                        Cetak Slip Gaji
                    </span>
                </a>
              </div>
                @endif
            </div>

            <table class="table table-bordered border-1 align-middle">
                <tbody>                 
                    <tr>
                        <td class="border-bottom-0 w-25 bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-semibold mb-0">Gaji Pokok</h6>
                                @if($karyawan->gaji_pokok == null)                          
                                <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-add-gaji">
                                    <i class="ti ti-plus"></i></button>
                                @endif
                            </div>
                        </td>
                        <td id="drawer-gaji" class="border-bottom-0">
                            @if($karyawan->gaji_pokok == null)
                            <h6 class="fw-semibold mb-0 fs-3">Gaji belum ditambahkan</h6>
                            @else
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-1 col-3">
                                    <h6 class="fw-semibold mb-0 fs-3">Rp</h6>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-6 d-flex justify-content-end">
                                    <h6 class="fw-semibold mb-0 fs-3">{{number_format($karyawan->gaji_pokok, 0, ',', '.')}}</h6>
                                </div>
                                <div class="col-xl-9 col-lg-12 col-md-col-12 col-3 d-flex justify-content-end align-items-end">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-edit-gaji">
                                    <i class="ti ti-pencil"></i></button>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>                                              
                    <tr>
                        <td class="border-bottom-0 w-25 bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-semibold mb-0">Tunjangan</h6>
                                @if($karyawan->gaji_pokok != null)                          
                                <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-add-tunjangan">
                                <i class="ti ti-plus"></i></button>
                                @endif
                            </div>
                        </td>

                        <td id="list-tunjangan" class="border-bottom-0 d-flex flex-column gap-4">
                        </td>
                    </tr>
                    <tr>
                        <td class="border-bottom-0 w-25 bg-light">
                            <h6 class="fw-semibold mb-0">Total Gaji</h6>
                        </td>    
                        <td>
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-1 col-3">
                                    <h6 class="mb-0 fs-4 fw-bolder">Rp</h6>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-6 d-flex justify-content-end">
                                    <h6 class="mb-0 fs-4 fw-bolder">{{number_format( $total_gaji, 0, ',', '.')}}</h6>
                                </div>
                            </div>
                        </td>
                    </tr>                                              
                </tbody>
            </table>
    
          </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card w-100 shadow">
          <div class="card-body p-4">

            <div class="row mb-3">
              <div class="col-8 m-0">
                <h5 class="card-title fw-semibold m-0">Data Perizinan a/n {{$karyawan->nama_karyawan}}</h5>
              </div>
              <div class="col-4 d-flex justify-content-end">
                <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-perizinan">
                  <i class="ti ti-plus"></i>
                  <span>
                    Tambah Perizinan
                  </span>
                </button>
              </div>
            </div>

            <div class="table-responsive">
                <table id="table-perizinan" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark">
                        <tr>
                            <th>Nama Admin</th>
                            <th>Perihal</th>
                            <th>Bukti</th>
                            <th>Ditambahkan pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
    
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/pages/karyawan/edit.init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-md5@0.8.3/src/md5.min.js"></script>
<script>
    const input_ktp = $('#inputKtp');
    const btn_update = $('.btn-update');
    const btn_delete = $('.btn-delete-karyawan');
    const btn_add_gaji = $('.btn-add-gaji');
    const btn_edit_gaji = $('.btn-edit-gaji');
    const btn_add_tunjangan = $('.btn-add-tunjangan');
    const list_tunjangan = $('#list-tunjangan');

    const form_perizinan = $('#form-perizinan');
    const modal_perizinan = $('#modal-perizinan');
    const modal_add_gaji = $('#modal-add-gaji');
    const modal_edit_gaji = $('#modal-edit-gaji');
    const modal_add_tunjangan = $('#modal-add-tunjangan');
    const modal_edit_tunjangan = $('#modal-edit-tunjangan');
    
    const id_karyawan = "{{$karyawan->id_karyawan}}";
    const nama_karyawan = "{{$karyawan->nama_karyawan}}";
    const id_admin = "{{Auth::user()->id_admin}}";
    const gaji_is_exist = "{{$karyawan->gaji_pokok}}";
    const id_slip_gaji = "{{$karyawan->id_slip_gaji}}";

    let data_table = null;
    const table_perizinan = $("#table-perizinan");
    
    const route_index = '{{route('admin.dashboard')}}';
    const url_update_karyawan = "{{route('karyawan.update', $karyawan->id_karyawan)}}";
    const url_delete_karyawan = "{{route('karyawan.delete', $karyawan->id_karyawan)}}";
    const url_get_perizinan = "{{route('perizinan.index', $karyawan->id_karyawan)}}";
    const url_add_perizinan = "{{route('perizinan.store')}}";
    const url_bukti_perizinan = "{{asset('storage/bukti/')}}";
    const url_add_gaji = "{{route('gaji.store')}}";
    const url_edit_gaji = "{{route('gaji.update', '')}}";
    const url_add_tunjangan = "{{route('tunjangan.store', '')}}";
    const url_get_tunjangan = "{{route('tunjangan.index', '')}}";
    const url_edit_tunjangan = "{{route('tunjangan.update', '')}}";
    const url_delete_tunjangan = "{{route('tunjangan.delete', '')}}";

</script>
@endsection