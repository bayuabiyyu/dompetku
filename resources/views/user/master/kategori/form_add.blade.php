<form id="form-data-add" action="{{ route('kategori.store') }}" method="POST">
        <!-- text input -->
        <div class="form-group">
            <label>Kode Kategori</label>
            <input type="text" id="kode_kategori" name="kode_kategori" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- select input -->
        <div class="form-group">
            <label>Jenis</label>
            <select class="form-control" name="kode_jenis" id="kode_jenis">
                @foreach ($data['jenis'] as $item)
                    <option value="{{ $item->kode_jenis }}"> {{ $item->nama_jenis }}</option>
                @endforeach
            </select>
        </div>

        <!-- button execute -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
            <button id="btn-clear" onClick="RefreshForm();" type="button" class="btn btn-warning ">Clear</button>
        </div>
</form>
