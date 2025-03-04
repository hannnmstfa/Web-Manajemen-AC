<x-app-layout title="Perbaikan Dalam Proses">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-auto py-2">
        <h2 class="fw-bold">Daftar AC dalam Proses Perbaikan</h2>
    </div>
    <div class="container-fluid bg-light card-body shadow border-0 border-top border-5 border-warning mx-auto table-responsive p-3">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th>No</th>
                    <th>Tgl Pengajuan</th>
                    <th>Nama AC</th>
                    <th>Permasalahan</th>
                    <th>Indikasi</th>
                    <th>Vendor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($proses->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Belum Ada Proses</td>
                </tr>
                @else
                <x-datatable/>
                @foreach ($proses as $index => $proses)
                <tr>
                    <td>{{$index +1}}</td>
                    <td>{{\Carbon\Carbon::parse($proses->tgl_pengajuan)->isoFormat('DD/MM/YYYY')}}</td>
                    <td>{{$proses->ac->nama_ac}} <span class="text-secondary">PK {{$proses->ac->pk}}</span></td>
                    <td>{{$proses->permasalahan}}</td>
                    <td>{{$proses->indikasi}}</td>
                    <td>{{$proses->vendor->nama_vendor}}</td>
                    <td><a href="{{route('proses.show', $proses->id)}}" title="Detail" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i></a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>