<form id="form-data-show">
     <!-- text input -->
     <div class="form-group">
        <label>Kode Kategori</label>
        <p>{{ $data['kategori']->kode_kategori }}</p>
    </div>
    <!-- text input -->
    <div class="form-group">
        <label>Nama</label>
        <p>{{ $data['kategori']->nama_kategori }}</p>
    </div>
    <!-- text input -->
    <div class="form-group">
        <label>Kode Jenis</label>
        <p>{{ $data['kategori']->kode_jenis }}</p>
    </div>
</form>
