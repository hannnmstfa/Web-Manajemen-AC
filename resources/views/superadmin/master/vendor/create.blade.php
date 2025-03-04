<x-app-layout title="Buat Data Vendor">
    <div class="container-fluid d-flex justify-content-between align-items-center my-2">
        <h2>Input Data Vendor</h2>
        <a href="{{route('vendor.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="container-fluid card-body border-none border-top border-5 border-success-subtle bg-light rounded-1 py-3 shadow">
        <div class="row container w-100 d-flex justify-content-center mx-auto">
            <div class="row col-md-6">
                <form action="{{route('vendor.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_vendor" class="form-label">Nama Vendor <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor"
                            value="{{old('nama_vendor')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" id="alamat" required>{{old('alamat')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="number" class="form-control" min="0" name="phone" id="phone" value="{{old('phone')}}">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Data Vendor </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>