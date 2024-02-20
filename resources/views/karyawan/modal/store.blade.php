<form class="modal-body">
    @csrf
    <div class="mb-1">
      <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
      <input type="text" class="form-control" id="nama_karyawan" required>
    </div>   
    <div class="mb-1">
      <label for="nik" class="form-label">NIK</label>
      <input type="number" class="form-control" id="nik" required>
    </div>
    <div class="mb-1">
      <label for="kk" class="form-label">No. KK</label>
      <input type="number" class="form-control" id="kk" required>
    </div>
    <div class="mb-1">
      <label for="nip" class="form-label">NIP</label>
      <input type="number" class="form-control" id="nip" required>
    </div>
    <div class="mb-1">
      <label for="no_telpon" class="form-label">No. Telpon</label>
      <input type="number" class="form-control" id="no_telpon" required>
    </div>
    <div class="mb-1">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="alamat" required></textarea>
    </div>
    <div class="mb-1">
      <label for="jabatan" class="form-label">Jabatan</label>
      <select class="form-select" id="id_jabatan" required>
        <option value="" selected disabled>Pilih Jabatan</option>
        @foreach ($jabatan as $item)
          <option value="{{$item->id_jabatan}}">{{$item->nama_jabatan}}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-1">
      <label for="ktp" class="form-label">Upload File KTP</label>
      <input type="file" class="form-control" id="ktp" required>
    </div>
    <div class="mb-1">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" required>
    </div>
    <div class="mb-1">
      <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
      <input type="password" class="form-control" id="password_confirmation" required>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-add-karyawan">Tambah</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    </div>
</form>