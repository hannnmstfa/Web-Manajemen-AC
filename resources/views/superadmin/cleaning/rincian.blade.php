<x-app-layout>
    <div class="container d-flex py-2 justify-content-between align-items-center">
        <h2 class="fw-bold">Detail Cleaning <span class="badge text-bg-warning">{{$proses->ac->kode_inv}}</span></h2>
        <a href="{{route('cleaning.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
            Kembali</a>
    </div>
    <div class="container card-body border-none border-top border-5 border-info shadow p-3">
        <table class="table">
            <tr>
                <td width="20%">Tgl Planing</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($proses->tgl_planing)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Nama AC</td>
                <td>:</td>
                <td class="fw-bold">{{$proses->ac->nama_ac}}</td>
            </tr>
            <tr>
                <td width="20%">PK AC</td>
                <td>:</td>
                <td class="fw-bold">{{$proses->ac->pk}}</td>
            </tr>
            <tr>
                <td width="20%">Ruangan</td>
                <td>:</td>
                <td class="fw-bold">{{$proses->ac->ruangan->nama_ruang}} <span class="text-secondary">(Plant
                        {{$proses->ac->ruangan->plant}})</span></td>
            </tr>
            <tr>
                <td width="20%">Vendor</td>
                <td>:</td>
                <td class="fw-bold">{{$proses->vendor->nama_vendor}}</td>
            </tr>
            <tr>
                <td width="20%">Aksi</td>
                <td>:</td>
                <td>
                    <a href="#selesai" data-bs-toggle="modal" class="btn btn-success btn-sm rounded-0"><i
                            class="fa-regular fa-circle-check"></i>
                        Tandai Selesai</a>
                </td>
            </tr>
        </table>

        {{-- Info Foto --}}
        <div class="container mx-auto d-flex row">
            {{-- Foto Petugas --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Petugas</h5>
                        @if ($proses->foto_petugas !== null)
                            <a href="#fotopetugas" data-bs-toggle="modal" class="text-decoration-none"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        @if ($proses->foto_petugas == null)
                            <a href="#fotopetugas" data-bs-toggle="modal" class="btn btn-secondary">Upload Foto</a>
                        @else
                            <img src="{{asset('/storage/image/cleaning/' . $proses->foto_petugas)}}" alt="foto_petugas"
                                class="w-75">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Foto Cleaning --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Cleaning</h5>
                        @if ($proses->foto_cleaning !== null)
                            <a href="#fotocleaning" data-bs-toggle="modal" class="text-decoration-none"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        @if ($proses->foto_cleaning == null)
                            <a href="#fotocleaning" data-bs-toggle="modal" class="btn btn-secondary">Upload Foto</a>
                        @else
                            <img src="{{asset('/storage/image/cleaning/' . $proses->foto_cleaning)}}" alt="foto_cleaning"
                                class="w-75">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Foto pemeriksa --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Pemeriksa</h5>
                        @if ($proses->foto_pemeriksa !== null)
                            <a href="#fotopemeriksa" data-bs-toggle="modal" class="text-decoration-none"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        @if ($proses->foto_pemeriksa == null)
                            <a href="#fotopemeriksa" data-bs-toggle="modal" class="btn btn-secondary">Upload Foto</a>
                        @else
                            <img src="{{asset('/storage/image/cleaning/' . $proses->foto_pemeriksa)}}" alt="foto_pemeriksa"
                                class="w-75">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal -------------------------------------------- --}}
    {{-- Foto Petugas --}}
    <div id="fotopetugas" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Upload Foto Petugas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('cleaning.foto', $proses->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" accept=".jpeg,.jpg,.png,.webp,.svg" class="form-control" name="foto_petugas"
                            required>
                        <button type="submit" class="btn btn-success mt-3 w-100">Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Foto Cleaning --}}
    <div id="fotocleaning" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Upload Foto Cleaning</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('cleaning.foto', $proses->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" accept=".jpeg,.jpg,.png,.webp,.svg" class="form-control"
                            name="foto_cleaning" required>
                        <button type="submit" class="btn btn-success mt-3 w-100">Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Foto pemeriksa --}}
    <div id="fotopemeriksa" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Upload Foto Pemeriksa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('cleaning.foto', $proses->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" accept=".jpeg,.jpg,.png,.webp,.svg" class="form-control"
                            name="foto_pemeriksa" required>
                        <button type="submit" class="btn btn-success mt-3 w-100">Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="modal fade" id="selesai">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Selesaikan Cleaning</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('cleaning.selesai', $proses->id)}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="tgl_actual" class="form-label">Tanggal Actual <span
                                class="text-danger">*</span></label>
                        <input type="date" name="tgl_actual" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Selesai </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>