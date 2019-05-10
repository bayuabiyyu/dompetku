<form id="form-data-show">

     <!-- text input -->
     <div class="form-group">
        <label>ID</label>
        <p>{{ $data['user']->id }}</p>
    </div>

    <!-- text input -->
    <div class="form-group">
        <label>Nama</label>
        <p>{{ $data['user']->name }}</p>
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
</form>
