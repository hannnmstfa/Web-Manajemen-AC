<x-app-layout title="Dashboard">
    <div class="container-fluid">
        <div class="d-flex justify-content-start align-items-center">
            <h5 id="time" class="py-3"></h5>
            <h5 id="span" class="ms-1"></h5>
        </div>
        <div class="row g-4">
            <!-- Card Jumlah AC Keseluruhan -->
            <div class="col-md-3">
                <div class="card shadow-lg rounded-lg border-0 bg-light">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-layer-group fa-3x text-info-emphasis"></i>
                        <h5 class="card-title mt-3 fw-bold" style="color: #086197">Jumlah AC</h5>
                        <h3 class="fw-bold text-dark">{{$jumlah}}</h3>
                    </div>
                </div>
            </div>

            <!-- Card AC Normal -->
            <div class="col-md-3">
                <div class="card shadow-lg rounded-lg border-0 bg-light">
                    <a href="{{route('ac.index')}}" class="text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-circle-check fa-3x text-success-emphasis"></i>
                            <h5 class="card-title mt-3 fw-bold" style="color: #086197">Normal</h5>
                            <h3 class="fw-bold text-dark">{{$normal}}</h3>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Card Pengajuan -->
            <div class="col-md-3">
                <div class="card shadow-lg rounded-lg border-0 bg-light">
                    <a href="{{route('pengajuan.index')}}" class="text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-file-circle-plus fa-3x text-warning-emphasis"></i>
                            <h5 class="card-title mt-3 fw-bold" style="color: #086197">Pengajuan</h5>
                            <h3 class="fw-bold text-dark">{{$pengajuan}}</h3>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Card Perbaikan -->
            <div class="col-md-3">
                <div class="card shadow-lg rounded-lg border-0 bg-light">
                    <a href="{{route('proses.index')}}" class="text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-screwdriver-wrench fa-3x text-danger-emphasis"></i>
                            <h5 class="card-title mt-3 fw-bold" style="color: #086197">Perbaikan</h5>
                            <h3 class="fw-bold text-dark">{{$perbaikan}}</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Report dan Kalender -->
        <div class="row mt-4">
            <div class="col-md-8 mb-3">
                <div class="card shadow-lg rounded-lg border-0">
                    <div class="card-header bg-secondary  text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar"></i> Report Hari Ini</h5>
                    </div>
                    <div class="card-body overflow-auto" style="height: 60vh">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($report->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada Report untuk hari ini</td>
                                    </tr>
                                @endif
                                @foreach ($report as $index => $report)
                                    <tr>
                                        <td>{{ucwords($report->kategori)}}</td>
                                        <td>
                                            {{\Carbon\Carbon::parse($report->created_at)->isoFormat('DD-MM-YYYY')}}
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{$report->ac->nama_ac}} - {{$report->ac->pk}} PK</div>
                                            <div class="text-secondary">{{$report->ac->ruangan->nama_ruang}} - Plant
                                                {{$report->ac->ruangan->plant}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kalender -->
            <div class="col-md-4">
                <div class="card shadow-lg rounded-lg border-0">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Calendar</h5>
                    </div>
                    <div class="card-body p-2">
                        <iframe class="w-100 rounded-lg border"
                            src="https://calendar.google.com/calendar/embed?height=400&wkst=1&ctz=Asia%2FJakarta&showPrint=0&src=NGYxNzU3NmZiNDk0NDNjYWFmMjFmYmEwNDRmYjBjNGZlYjMyMzVlMjk4MmM3M2RlMzYyMGMwYTBiZWViODhlMEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%2317A2B8&color=%236C757D&color=%236C757D"
                            style="border: 0;" width="100%" height="400" frameborder="0" scrolling="no">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function updateTime() {
        $.get('/get-time', function(data) {
            $('#time').text(data.time);
            $('#span').text('WIB');
        });
    }

    setInterval(updateTime, 1000);
</script>