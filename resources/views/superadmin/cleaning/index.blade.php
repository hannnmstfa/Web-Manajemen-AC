<x-app-layout title="Maintenance">
    <div class="container-fluid card-body border-none border-top border-5 border-warning shadow p-3 bg-light">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h4>Proses Cleaning</h4>
            <a href="{{ route('cleaning.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <hr>

        <!-- Tabel Data Cleaning -->
        <div class="container-fluid table-responsive">
            <table id="myTable" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="table-warning text-center">
                        <th>No</th>
                        <th>Tanggal Planing</th>
                        <th>Nama AC</th>
                        <th>Ruangan</th>
                        <th>Plant</th>
                        <th>Vendor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($proses->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum Ada Data Planning</td>
                        </tr>
                    @else
                        <x-datatable />
                        @foreach ($proses as $index => $proses)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($proses->tgl_planing)->format('d-m-Y') }}</td>
                                <td>{{ $proses->ac->nama_ac }} - {{ $proses->ac->pk }} PK</td>
                                <td>{{ $proses->ac->ruangan->nama_ruang }}</td>
                                <td>{{ $proses->ac->ruangan->plant }}</td>
                                <td>{{ $proses->vendor->nama_vendor }}</td>
                                <td>
                                    <a href="{{route('cleaning.edit', $proses->id)}}" title="Edit" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{route('cleaning.detail', $proses->id)}}" title="Detail" class="btn btn-success btn-sm"><i class="fa-regular fa-circle-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Selesai --}}
    <div class="container-fluid card-body border-none border-top border-5 border-success mt-5 shadow p-3 bg-light">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h4>Selesai Cleaning</h4>
        </div>
        <hr>
        <div class="container-fluid table-responsive">
            <table id="myTable2" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="table-success">
                        <th>No</th>
                        <th>Tanggal Planing</th>
                        <th>Tanggal Actual</th>
                        <th>Nama AC</th>
                        <th>Ruangan</th>
                        <th>Plant</th>
                        <th>Vendor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($selesai->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Belum Ada Data Actual</td>
                        </tr>
                    @else
                        <x-datatable2 />
                        @foreach ($selesai as $index => $selesai)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($selesai->tgl_planing)->isoFormat('DD-MM-YYYY') }}</td>
                                <td>{{ \Carbon\Carbon::parse($selesai->tgl_actual)->isoFormat('DD-MM-YYYY') }}</td>
                                <td>{{ $selesai->ac->nama_ac }} - {{ $selesai->ac->pk }} PK</td>
                                <td>{{ $selesai->ac->ruangan->nama_ruang }}</td>
                                <td>{{ $selesai->ac->ruangan->plant }}</td>
                                <td>{{ $selesai->vendor->nama_vendor }}</td>
                                <td>
                                   <a href="{{route('cleaning.show', $selesai->id)}}" title="Detail" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>