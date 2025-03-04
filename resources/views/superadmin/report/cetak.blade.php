<x-app-layout title="{{\Carbon\Carbon::parse($bulan)->isoFormat('MMMM YYYY')}}">
    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
        <h2>Export Report</h2>
        <a href="{{route('report.bulanan')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
    <div
        class="container-fluid table-responsive card-body border-none border-top border-5 rounded-1 shadow border-success-subtle p-3">
        <div class="d-flex justify-content-end align-items-center">
            <form id="filterForm" action="{{ route('filter.cetak')}}" method="post"
                class="col-md-4 d-flex justify-content-between align-items-center gap-1">
                @csrf
                <input type="month" value="{{$bulan}}" name="bulan" class="form-control" required>
                <button type="submit" class="btn btn-primary btn-sm">Filter </button>
                <a href="{{ route('report.cetak') }}" class="btn btn-warning btn-sm">Reset</a>
            </form>
        </div>
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr class="table-primary">
                    <th width="2%">No</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>AC</th>
                    <th>Ruangan</th>
                    <th>Plant</th>
                </tr>
            </thead>
            <tbody>
                @if ($bulanan->isEmpty())
                    <tr>
                        <td colspan="6">Tidak Ada Report Pada Bulan {{\Carbon\Carbon::parse($bulan)->isoFormat('MMMM YYYY')}}</td>
                    </tr>
                @else
                <x-cetak/>
                @foreach ($bulanan as $index => $bulanan)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{ucfirst($bulanan->kategori)}}</td>
                    <td>{{\Carbon\Carbon::parse($bulanan->tanggal)->isoFormat('DD-MM-YYYY')}}</td>
                    <td>{{$bulanan->ac->nama_ac}}</td>
                    <td>{{$bulanan->ac->ruangan->nama_ruang}}</td>
                    <td>{{$bulanan->ac->plant}}</td>
                </tr>    
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>