<x-app-layout title="Detail Cleaning">
    <div class="container d-flex py-2 justify-content-between align-items-center">
        <h2 class="fw-bold">Detail Cleaning <span class="badge text-bg-warning">{{$detail->ac->kode_inv}}</span></h2>
        <a href="{{route('cleaning.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
            Kembali</a>
    </div>
    <div class="container card-body border-none border-top border-5 border-info shadow p-3">
        <table class="table">
            <tr>
                <td width="20%">Tgl Planing</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($detail->tgl_planing)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Tgl Actual</td>
                <td width="2%">:</td>
                <td class="fw-bold">{{\Carbon\Carbon::parse($detail->tgl_actual)->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td width="20%">Nama AC</td>
                <td>:</td>
                <td class="fw-bold">{{$detail->ac->nama_ac}}</td>
            </tr>
            <tr>
                <td width="20%">PK AC</td>
                <td>:</td>
                <td class="fw-bold">{{$detail->ac->pk}}</td>
            </tr>
            <tr>
                <td width="20%">Ruangan</td>
                <td>:</td>
                <td class="fw-bold">{{$detail->ac->ruangan->nama_ruang}} <span class="text-secondary">(Plant
                        {{$detail->ac->ruangan->plant}})</span></td>
            </tr>
            <tr>
                <td width="20%">Vendor</td>
                <td>:</td>
                <td class="fw-bold">{{$detail->vendor->nama_vendor}}</td>
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
                        <img src="{{asset('/storage/image/cleaning/' . $detail->foto_petugas)}}" alt="foto_petugas"
                            class="w-75">
                    </div>
                </div>
            </div>

            {{-- Foto Cleaning --}}
            <div class="col-md-4 mb-3">
                <div class="card-body border-none border-top border-5 border-secondary shadow p-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Foto Cleaning</h5>
                    </div>
                    <hr class="my-0">
                    <div class="container py-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('/storage/image/cleaning/' . $detail->foto_cleaning)}}" alt="foto_cleaning"
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
                        <img src="{{asset('/storage/image/cleaning/' . $detail->foto_pemeriksa)}}" alt="foto_pemeriksa"
                            class="w-75">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>