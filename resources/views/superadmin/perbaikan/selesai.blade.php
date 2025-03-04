<x-app-layout title="Selesai Perbaikan">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-auto py-2">
        <h2 class="fw-bold">Daftar AC Selesai Perbaikan</h2>
    </div>
    <div class="container-fluid card-body shadow border-0 border-top border-5 bg-light border-warning mx-auto table-responsive p-3">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th>No</th>
                    <th>Tgl Pengajuan</th>
                    <th>Tgl Selesai</th>
                    <th>Nama AC</th>
                    <th>Permasalahan</th>
                    <th>Indikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($selesai->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Belum Ada Perbaikan selesai</td>
                </tr>
                @else
                <x-datatable/>
                @foreach ($selesai as $index => $selesai)
                <tr>
                    <td>{{$index +1}}</td>
                    <td>{{\Carbon\Carbon::parse($selesai->tgl_pengajuan)->isoFormat('DD/MM/YYYY')}}</td>
                    <td>{{\Carbon\Carbon::parse($selesai->tgl_selesai)->isoFormat('DD/MM/YYYY')}}</td>
                    <td>{{$selesai->ac->nama_ac}} <span class="text-secondary">PK {{$selesai->ac->pk}}</span></td>
                    <td>{{$selesai->permasalahan}}</td>
                    <td>{{$selesai->indikasi}}</td>
                    <td><a href="{{route('selesai.detail', $selesai->id)}}" title="Detail" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i></a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>