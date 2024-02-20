<form class="modal-body">
    @csrf
    <div class="mb-1">
      <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
      <input type="text" class="form-control" id="nama_karyawan" disabled>
    </div>   
    <div class="mb-1">
      <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
      <input type="number" class="form-control" id="gaji_pokok" required>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-add-gaji">Tambah</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    </div>
</form>