<x-app-layout title="Pengajuan Perbaikan">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-auto py-2">
        <h2 class="fw-bold">Daftar Pengajuan</h2>
        <a href="{{route('pengajuan.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Pengajuan</a>
    </div>
    <div class="card-body border-none border-top border-5 border-warning bg-light shadow container-fluid p-3 mx-auto table-responsive">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th>No</th>
                    <th>Tgl Pengajuan</th>
                    <th>Nama AC</th>
                    <th>Permasalahan</th>
                    <th>Indikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($pengajuan->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Belum Ada Pengajuan</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($pengajuan as $index => $pengajuan)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{\Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->isoFormat('DD/MM/YYYY')}}</td>
                            <td>
                                <div class="fw-bold">{{$pengajuan->ac->nama_ac}} PK {{$pengajuan->ac->pk}}</div>
                                <div class="text-secondary">
                                    {{$pengajuan->ac->ruangan->nama_ruang}} - Plant {{$pengajuan->ac->ruangan->plant}}
                                </div>
                            </td>
                            <td>{{$pengajuan->permasalahan}}</td>
                            <td>{{$pengajuan->indikasi}}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{route('pengajuan.edit', $pengajuan->id)}}" title="Edit" class="btn btn-sm btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                                    @if (Auth::user()->role == 'Superadmin')
                                        <a href="#acc" data-route="{{route('pengajuan.acc', $pengajuan->id)}}"
                                            data-bs-toggle="modal" title="Acc" class="btn btn-sm btn-success btn-acc"><i
                                                class="fa-regular fa-circle-check"></i></a>
                                    @endif
                                    <a href="#delete" data-bs-toggle="modal" title="Hapus/Tolak" data-route="{{route('pengajuan.destroy', $pengajuan->id)}}" data-nama="Pengajuan Perbaikan" class="btn btn-del btn-sm btn-danger"><i class="fa-regular fa-circle-xmark"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Modal ACC --}}
    <div class="modal fade" id="acc">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="form-acc">
                    @csrf
                    <div class="modal-body">
                        <label for="vendor_id" class="form-label">Pilih Vendor untuk Perbaikan <span
                                class="text-danger">*</span></label>
                        <select name="vendor_id" id="vendor_id" class="form-select" required>
                            <option selected value="" disabled>-- Pilih Vendor --</option>
                            @if ($vendor->isEmpty())
                                <option disabled class="text-center fst-italic">Belum Ada Data Vendor</option>
                            @else
                                @foreach ($vendor as $vendor)
                                    <option value="{{$vendor->id}}">{{$vendor->nama_vendor}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="submit" class="btn btn-success btn-sm">Terima Pengajuan </button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ACC
        document.querySelectorAll('.btn-acc').forEach(button => {
            button.addEventListener('click', function () {
                const route = this.getAttribute('data-route');
                document.getElementById('form-acc').action = route;
            })
        });
    })
</script>