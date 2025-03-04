<x-app-layout title="Report Harian">
    <div class="container-fluid shadow table-responsive card-body bg-light p-3 border-none border-top border-5 border-secondary">
        <div class="row container-fluid d-flex justify-content-between align-items-center">
            <h4 class="col-md-8">Report Harian</h4>
            <form id="filterForm" action="{{ route('filter.hari') }}" method="post"
                class="col-md-4 d-flex justify-content-between align-items-center gap-1">
                @csrf
                <input type="date" value="{{$tanggal}}" name="tanggal" class="form-control" required>
                <button type="submit" class="btn btn-primary btn-sm">Filter </button>
                <a href="{{ route('report.harian') }}" class="btn btn-warning btn-sm">Reset</a>
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
                @if ($harian->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Belum Ada Report</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($harian as $index => $harian)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{\Carbon\Carbon::parse($harian->tanggal)->isoFormat('DD-MM-YYYY')}}</td>
                            <td>{{ucwords($harian->kategori)}}</td>
                            <td>
                                <div class="fw-bold">{{ucfirst($harian->ac->nama_ac)}} - {{$harian->ac->pk}} PK</div>
                                <div class="text-secondary">{{$harian->ac->ruangan->nama_ruang}} - Plant
                                    {{$harian->ac->ruangan->plant}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
