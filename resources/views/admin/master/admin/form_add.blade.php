<form id="form-data-add" action="{{ route('user.store') }}" method="POST">
        <!-- text input -->
        <div class="form-group">
            <label>Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- text input -->
        <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- text input -->
        <div class="form-group">
            <label>Role</label>
            <input type="text" id="role" name="role" class="form-control" placeholder="Enter ..." required>
        </div>

        <!-- button execute -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
            <button id="btn-clear" onClick="RefreshForm();" type="button" class="btn btn-warning ">Clear</button>
        </div>
</form>
