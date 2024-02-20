@extends('admin.layout')

@section('title', 'Dashboard')

@section('page')
<x-modal id="modal-show-karyawan" title="Lihat Karyawan" size="modal-md">
  @include('karyawan.modal.show')
</x-modal>

<x-modal id="modal-edit-karyawan" title="Edit Karyawan" size="modal-md">
  @include('karyawan.modal.edit')
</x-modal>

{{-- <x-modal id="modal-delete-karyawan" title="Hapus Karyawan" size="modal-md">
  @include('karyawan.modal.delete')
</x-modal> --}}

<x-modal id="modal-add-karyawan" title="Tambah Karyawan" size="modal-lg">
  @include('karyawan.modal.store')
</x-modal>

<div class="row">
  <div class="col-12">
    <div class="card w-100 shadow">
      <div class="card-body p-4">

        <div class="row mb-3">
          <div class="col-8">
            <h5 class="card-title fw-semibold m-0">Data Karyawan</h5>
          </div>
          <div class="col-4 d-flex justify-content-end">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-add-karyawan">
              <i class="ti ti-plus"></i>
              <span>
                Tambah Karyawan
              </span>
            </button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="table-karyawan" class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark">
                  <tr>
                      <th>Nomor</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Ditambahkan</th>
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
<script src="{{asset('assets/js/pages/karyawan/index.init.js')}}"></script>    
<script>
  let data_table = null;
  const table_karyawan = $("#table-karyawan");
  const modal_add_karyawan = $("#modal-add-karyawan");
  const modal_show_karyawan = $("#modal-show-karyawan");
  const modal_edit_karyawan = $("#modal-edit-karyawan");
  // const modal_delete_karyawan = $("#modal-delete-karyawan");

  const url_login_karyawan = "{{route('karyawan.login')}}";
  const url_get_karyawan = "{{route('karyawan.index')}}";
  const url_add_karyawan = "{{route('karyawan.store')}}";
  const url_show_karyawan = "{{route('karyawan.show', '')}}";
  const url_edit_karyawan = "{{route('karyawan.edit', '')}}";
  // const url_delete_karyawan = "{{route('karyawan.delete', '')}}";
</script>
@endsection