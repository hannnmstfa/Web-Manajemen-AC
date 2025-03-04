<x-app-layout>
    <div class="container-fluid d-flex justify-content-between align-items-center my-2">
        <h2>Edit Data AC</h2>
        <a href="{{route('ac.index')}}" class="btn btn-primary">Kembali</a>
    </div>
    <div class="container-fluid card-body border-none border-top border-5 border-success-subtle d-flex justify-content-center rounded-0 bg-light">
        <form action="{{route('ac.update', $ac->id)}}" method="post" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container-fluid row d-flex justify-content-start mx-auto w-100 py-2">
                <div class="col-md-6 mb-3">
                    <label for="nama_ac" class="form-label">Nama AC <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_ac" id="nama_ac" value="{{$ac->nama_ac}}"
                        required placeholder="Masukkan Nama AC">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tgl_pemasangan" class="form-label">Tanggal Pemasangan <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tgl_pemasangan" id="tgl_pemasangan" value="{{$ac->tgl_pemasangan}}"
                        required placeholder="hhhh">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
                    <select name="ruangan_id" id="select2" class="form-select" required style="width: 100%">
                        @if ($ruangan->isEmpty())
                            <option disabled class="text-center fst-italic">Belum Ada Ruangan</option>
                        @else
                            <x-select2 />
                            @foreach ($ruangan as $ruang)
                                <option value="{{$ruang->id}}" {{$ac->ruangan->id == $ruang->id ? 'selected' : ''}}>PLANT {{$ruang->plant}} - {{$ruang->nama_ruang}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pk" class="form-label">PK <span class="text-danger">*</span></label>
                    <input type="text" name="pk" id="pk" value="{{$ac->pk}}" placeholder="Masukkan PK AC"
                        class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="spesifikasi" class="form-label">Spesifikasi <span class="text-danger">*</span></label>
                    <textarea name="spesifikasi" class="form-control" id="spesifikasi" required
                        placeholder="Masukkan Spesifikasi AC">{{$ac->spesifikasi}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tempat_beli" class="form-label">Tempat Beli <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <textarea name="tempat_beli" class="form-control" id="spesifikasi"
                        placeholder="Masukkan Tempat Beli AC">{{$ac->tempat_beli}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_nota" class="form-label">Foto Nota <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_nota" id="foto_nota">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_petugas" class="form-label">Foto Petugas <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_petugas" id="foto_petugas">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_pemasangan" class="form-label">Foto Pemasangan <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_pemasangan" id="foto_pemasangan">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_pemeriksa" class="form-label">Foto Pemeriksa <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_pemeriksa" id="foto_pemeriksa">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_indoor" class="form-label">Foto Indoor <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_indoor" id="foto_indoor">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_outdoor" class="form-label">Foto Outdoor <span
                            class="text-secondary fst-italic small">(Optional)</span></label>
                    <input type="file" class="form-control" accept=".jpeg,.jpg,.png,.svg,.webp" name="foto_outdoor" id="foto_outdoor">
                </div>
                <button type="submit" class="col-md-12 btn btn-success">Simpan Perubahan </button>
            </div>
        </form>
    </div>
</x-app-layout>