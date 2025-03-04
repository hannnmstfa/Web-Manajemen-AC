<x-app-layout title="Report Bulanan">
    <div class="container-fluid shadow table-responsive bg-light card-body p-3 border-none border-top border-5 border-secondary">
        <div class="row container-fluid d-flex justify-content-between align-items-center">
            <h4 class="col-md-8">Report Bulanan</h4>
            <form id="filterForm" action="{{ route('filter.bulan')}}" method="post"
                class="col-md-4 d-flex justify-content-between align-items-center gap-1">
                @csrf
                <input type="month" value="{{$bulan}}" name="bulan" class="form-control" required>
                <button type="submit" class="btn btn-primary btn-sm">Filter </button>
                <a href="{{ route('report.bulanan') }}" class="btn btn-warning btn-sm">Reset</a>
            </form>
        </div>
        <hr>
        <table id="myTable" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                @if ($bulanan->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Belum Ada Report</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($bulanan as $index => $bulanan)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{\Carbon\Carbon::parse($bulanan->tanggal)->isoFormat('DD-MM-YYYY')}}</td>
                            <td>{{ucwords($bulanan->kategori)}}</td>
                            <td>
                                <div class="fw-bold">{{$bulanan->ac->nama_ac}} - {{$bulanan->ac->pk}} PK</div>
                                <div class="text-secondary">{{$bulanan->ac->ruangan->nama_ruang}} - Plant
                                    {{$bulanan->ac->ruangan->plant}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>