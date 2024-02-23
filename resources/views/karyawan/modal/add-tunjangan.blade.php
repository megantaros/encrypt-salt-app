<form class="modal-body">
    @csrf
    <div class="mb-1">
      <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
      <input type="text" class="form-control" id="nama_karyawan" disabled>
    </div>   
    <div class="mb-1">
      <label for="nama_tunjangan" class="form-label">Nama Tunjangan</label>
      <input type="text" class="form-control" id="nama_tunjangan" value="Tunjangan " required>
    </div>
    <div class="mb-1">
      <label for="jumlah_tunjangan" class="form-label">Tunjangan</label>
      <input type="number" class="form-control" id="jumlah_tunjangan" required>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-add-tunjangan">Tambah</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    </div>
</form>