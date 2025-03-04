<x-app-layout>
    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
        <h4>Data Semua AC <span class="badge bg-primary">{{$jumlah}} Unit</span></h4>
    </div>
    <div
        class="container-fluid card-body shadow p-3 border-none bg-light border-top border-5 border-primary-subtle table-responsive">
        <div class="d-flex justify-content-between align-items-center gap-2">
            @if (Auth::user()->role !== 'Operator')
                <a href="{{route('ac.cetak')}}" class="btn btn-outline-success"><i class="fa-solid fa-file-export"></i>
                    Export</a>
            @endif
            <a href="{{route('ac.create')}}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i> Input
                AC</a>
        </div>
        <hr>
        <table id="myTable" class="table table-bordered table-striped table-sm custom-th">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Inv</th>
                    <th>Nama AC</th>
                    <th>Ruangan</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($ac->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">Belum Ada Data</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($ac as $index => $data)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td><small>{{$data->kode_inv}}</small></td>
                            <td>
                                <div class="">
                                    {{$data->nama_ac}}
                                </div>
                                <div class="text-secondary">
                                    - {{$data->pk}} PK
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    {{$data->ruangan->nama_ruang}}
                                </div>
                                <div class="text-secondary">
                                    - Plant {{$data->ruangan->plant}}
                                </div>
                            </td>
                            <td>{{$data->spesifikasi}}</td>
                            @if ($data->status == 'normal')
                                <td class="text-success">NORMAL</td>
                            @elseif($data->status == 'perbaikan')
                                <td class="text-warning">PERBAIKAN</td>
                            @else
                                <td class="text-danger">RUSAK</td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start gap-3">
                                    <a href="{{route('ac.show', $data->id)}}" title="Detail" class="btn btn-info btn-sm"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                    <a href="{{route('ac.edit', $data->id)}}" title="Edit" class="btn btn-warning btn-sm"><i
                                            class="fa-solid fa-file-pen"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#delete"
                                        data-route="{{route('ac.destroy', $data->id)}}" title="Hapus"
                                        data-nama="{{$data->nama_ac}}" class="btn btn-danger  btn-del btn-sm"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>