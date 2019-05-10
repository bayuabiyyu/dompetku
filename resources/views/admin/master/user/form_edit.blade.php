<form id="form-data-edit" action="{{ route('user.update', $data['user']->id) }}" method="PUT">

        <!-- text input -->
        <div class="form-group">
            <label>ID</label>
            <p>{{ $data['user']->id }}</p>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Username</label>
            <p>{{ $data['user']->username }}</p>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Email</label>
            <p>{{ $data['user']->email }}</p>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Enter ..." value="{{ $data['user']->name }}" required>
        </div>

        <!-- button execute -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Update changes</button>
            <button id="btn-clear" onClick="RefreshForm();" type="button" class="btn btn-warning ">Clear</button>
        </div>
</form>
