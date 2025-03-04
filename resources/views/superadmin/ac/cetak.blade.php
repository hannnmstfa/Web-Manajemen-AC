<x-app-layout title="Data AC">
    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
        <h2>Data AC</h2>
        <a href="{{route('ac.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
    <div
        class="container-fluid bg-light cetak card-body table-responsive border-none border-top border-5 border-success-subtle shadow p-3">
        <form action="{{route('ac.cetak')}}" method="get">
            @csrf
            <div class="d-flex row justify-content-end align-items-center">
                <div class="d-flex justify-content-center align-items-center col-md-2">
                    <p class="m-0 p-0 w-75">Plant :</p>
                    <select name="plant" class="form-select" id="plant" onchange="this.form.submit()">
                        <option value="default" {{ request('plant') == 'default' ? 'selected' : ''}}>Semua</option>
                        <option value="plant2" {{ request('plant') == 'plant2' ? 'selected' : ''}}>Plant 2</option>
                        <option value="plant3" {{ request('plant') == 'plant3' ? 'selected' : ''}}>Plant 3</option>
                    </select>
                </div>
            </div>
        </form>
        <table id="myTable" class="table table-bordered border-dark  table-sm">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Kode Inventory</th>
                    <th>Tgl Terpasang</th>
                    <th>Nama AC</th>
                    <th>Spesifikasi</th>
                    <th>Ruangan</th>
                    <th>Plant</th>
                </tr>
            </thead>
            <tbody>
                @if ($ac->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">Belum Ada Data</td>
                    </tr>
                @else
                    <x-cetak />
                    @foreach ($ac as $index => $data)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$data->kode_inv}}</td>
                            <td>{{\Carbon\Carbon::parse($data->tgl_pemasangan)->isoFormat('DD/MM/YYYY')}}</td>
                            <td>{{$data->nama_ac}} - {{$data->pk}} PK</td>
                            <td>{{$data->spesifikasi}}</td>
                            <td>{{$data->ruangan->nama_ruang}}</td>
                            <td>{{$data->ruangan->plant}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>