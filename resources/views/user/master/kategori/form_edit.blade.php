<form id="form-data-edit" action="{{ route('kategori.update', $data['kategori']->kode_kategori) }}" method="PUT">

        <!-- text input -->
        <div class="form-group">
            <label>Kode Kategori</label>
            <p>{{ $data['kategori']->kode_kategori }}</p>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Enter ..." value="{{ $data['kategori']->nama_kategori }}" required>
        </div>

        <!-- select input -->
        <div class="form-group">
            <label>Jenis</label>
            <select class="form-control" name="kode_jenis" id="kode_jenis">
                @foreach ($data['jenis'] as $item)
                    @if ($item->kode_jenis == $data['kategori']->kode_jenis)
                        <option selected value="{{ $item->kode_jenis }}"> {{ $item->nama_jenis }}</option>
                    @else
                        <option value="{{ $item->kode_jenis }}"> {{ $item->nama_jenis }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- button execute -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Update changes</button>
            <button id="btn-clear" onClick="RefreshForm();" type="button" class="btn btn-warning ">Clear</button>
        </div>
</form>
