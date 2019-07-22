<form id="form-data-add" action="{{ route('income.store') }}" method="POST">
    <!-- text input -->
    <div class="form-group">
        <label>Tanggal</label>
        <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Enter ..." required>
    </div>

    <!-- select input -->
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="txtKategori" id="txtKategori">
            @foreach ($data['kategori'] as $item)
                <option value="{{ $item->kode_kategori }}"> {{ $item->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <!-- text input -->
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" id="txtKeterangan" name="txtKeterangan" class="form-control" placeholder="Enter ..." required>
    </div>

    <!-- text input -->
    <div class="form-group">
        <label>Nominal</label>
        <input type="number" id="txtNominal" name="txtNominal" class="form-control" placeholder="Enter ..." required>
    </div>

    <!-- button execute -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">Save changes</button>
        <button id="btn-clear" onClick="RefreshForm();" type="button" class="btn btn-warning ">Clear</button>
    </div>
</form>
