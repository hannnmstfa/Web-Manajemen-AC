<x-app-layout title="Create Pengguna">
    <div class="container d-flex justify-content-between align-items-center my-2">
        <h2>Tambah Data Pengguna</h2>
        <a href="{{route('users.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
    <form action="{{route('users.store')}}" method="post">
        @csrf
        <div class="container-fluid row d-flex bg-secondary-subtle py-2 mx-auto">
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="nama" value="{{old('name')}}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}"
                    required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
            <div class="col-md-6 mb-3">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-select" required>
                    <option value="Superadmin">Superadmin</option>
                    <option value="Admin">Admin</option>
                    <option value="Operator">Operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan </button>
        </div>
    </form>
</x-app-layout>