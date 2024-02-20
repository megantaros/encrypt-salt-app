<form class="modal-body">
    @csrf
    <div class="mb-1">
      <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
      <input type="text" class="form-control" id="nama_jabatan" required>
    </div>   

    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-add-jabatan">Tambah</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    </div>
</form>