<x-app-layout>
    <div class="container-fluid d-flex justify-content-between align-items-center py-2 mx-auto">
        <h2 class="">Detail AC <span class="badge text-bg-warning">{{$ac->kode_inv}}</span></h2>
        <a href="{{route('ac.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
            Kembali</a>
    </div>
    <div class="container-fluid card-body border-none border-top border-5 border-info-subtle bg-light p-3">
        <table class="table">
            <tr>
                <td width="20%">Tgl Pemasangan</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($ac->tgl_pemasangan)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Nama AC</td>
                <td>:</td>
                <td class="fw-bold">{{$ac->nama_ac}}</td>
            </tr>
            <tr>
                <td width="20%">Ruangan</td>
                <td>:</td>
                <td class="fw-bold">{{$ac->ruangan->nama_ruang}} <span class="text-secondary">(Plant
                        {{$ac->ruangan->plant}})</span></td>
            </tr>
            <tr>
                <td width="20%">PK AC</td>
                <td>:</td>
                <td class="fw-bold">{{$ac->pk}}</td>
            </tr>
            <tr>
                <td width="20%">Spesifikasi</td>
                <td>:</td>
                <td class="fw-bold">{{$ac->spesifikasi}}</td>
            </tr>
            <tr>
                <td width="20%">Tempat Beli</td>
                <td>:</td>
                <td class="fw-bold">{{$ac->tempat_beli}}</td>
            </tr>
            <tr>
                <td width="20%">Status AC</td>
                <td>:</td>
                <td class="fw-bold">{{ucwords($ac->status)}}</td>
            </tr>
        </table>

        {{-- Info Foto --}}
        <div class="container mx-auto d-flex row">
            {{-- Foto Nota --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Nota</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_nota)}}" alt="foto_nota" class="w-75">

                    </div>
                </div>
            </div>
            {{-- Foto Petugas --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Petugas</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_petugas)}}" alt="foto_petugas" class="w-75">

                    </div>
                </div>
            </div>

            {{-- Foto Perbaikan --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Pemasangan</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_pemasangan)}}" alt="foto_pemasangan"
                            class="w-75">
                    </div>
                </div>
            </div>

            {{-- Foto pemeriksa --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Pemeriksa</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_pemeriksa)}}" alt="foto_pemeriksa"
                            class="w-75">
                    </div>
                </div>
            </div>
            {{-- Foto Indoor --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Indoor</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_indoor)}}" alt="foto_indoor" class="w-75">
                    </div>
                </div>
            </div>
            {{-- Foto Outdoor --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Indoor</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/ac/' . $ac->foto_outdoor)}}" alt="foto_outdoor" class="w-75">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>