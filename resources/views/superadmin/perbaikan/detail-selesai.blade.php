<x-app-layout title="Detail Selesai Perbaikan">
    <div class="container d-flex py-2 justify-content-between align-items-center">
        <h2 class="fw-bold">Detail Perbaikan <span class="badge text-bg-warning">{{$selesai->ac->kode_inv}}</span></h2>
        <a href="{{route('selesai.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
            Kembali</a>
    </div>
    <div class="container card-body border-none border-top border-5 border-info shadow p-3">
        <table class="table">
            <tr>
                <td width="20%">Tgl Pengajuan</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($selesai->tgl_pengajuan)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Tgl Selesai</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($selesai->tgl_selesai)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Nama AC</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->ac->nama_ac}}</td>
            </tr>
            <tr>
                <td width="20%">PK AC</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->ac->pk}}</td>
            </tr>
            <tr>
                <td width="20%">Ruangan</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->ac->ruangan->nama_ruang}} <span class="text-secondary">(Plant
                        {{$selesai->ac->ruangan->plant}})</span></td>
            </tr>
            <tr>
                <td width="20%">Permasalahan</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->permasalahan}}</td>
            </tr>
            <tr>
                <td width="20%">Indikasi</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->indikasi}}</td>
            </tr>
            <tr>
                <td width="20%">Vendor</td>
                <td>:</td>
                <td class="fw-bold">{{$selesai->vendor->nama_vendor}}</td>
            </tr>
        </table>

        {{-- Info Foto --}}
        <div class="container mx-auto d-flex row">
            {{-- Foto Petugas --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Petugas</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/perbaikan/' . $selesai->foto_petugas)}}" alt="foto_petugas"
                            class="w-75">

                    </div>
                </div>
            </div>

            {{-- Foto Perbaikan --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Perbaikan</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/perbaikan/' . $selesai->foto_perbaikan)}}"
                            alt="foto_perbaikan" class="w-75">
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
                        <img src="{{asset('/storage/image/perbaikan/' . $selesai->foto_pemeriksa)}}"
                            alt="foto_pemeriksa" class="w-75">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>