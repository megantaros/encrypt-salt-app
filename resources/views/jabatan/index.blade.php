@extends('admin.layout')

@section('title', 'Jabatan')

@section('page')

<x-modal id="modal-add-jabatan" title="Tambah Jabatan" size="modal-md">
    @include('jabatan.modal.create')
</x-modal>

<x-modal id="modal-edit-jabatan" title="Edit Jabatan" size="modal-md">
    @include('jabatan.modal.edit')
</x-modal>

<div class="card">
    <div class="card-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold">Manajemen Jabatan</h5>
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-add-jabatan">
                <i class="ti ti-plus"></i>
                <span>
                    Tambah Jabatan
                </span>
            </button>
      </div>

      <div class="table-responsive">
        <table id="table-jabatan" class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark">
                <tr>
                    <th>Nomor</th>
                    <th>Nama Jabatan</th>
                    <th>Ditambahkan pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>
      
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/pages/jabatan/index.init.js')}}"></script>
<script>
    let data_table = null;
    const table_jabatan = $('#table-jabatan');

    const url_get_jabatan = "{{route('jabatan.index')}}";
    const url_add_jabatan = "{{route('jabatan.store')}}";
    const url_show_jabatan = "{{route('jabatan.show', '')}}";
    const url_edit_jabatan = "{{route('jabatan.update', '')}}";
    const url_delete_jabatan = "{{route('jabatan.delete', '')}}";

    const modal_add_jabatan = $('#modal-add-jabatan');
    const modal_edit_jabatan = $('#modal-edit-jabatan');
</script>
@endsection