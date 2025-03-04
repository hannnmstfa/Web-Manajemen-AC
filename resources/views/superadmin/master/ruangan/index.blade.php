<x-app-layout title="Data Ruangan">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-auto m-2">
        <h2>Data Ruangan</h2>
        @if (Auth::user()->role == 'Superadmin')
            <a href="#tambah-ruang" data-bs-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah
                Ruang</a>
        @endif
    </div>
    <div
        class="p-3 card-body boder-none border-top border-5 border-primary-subtle bg-light container-fluid table-responsive rounded-2 shadow">
        <table id="myTable" class="table table-striped table-bordered custom-th">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Plant</th>
                    @if (Auth::user()->role == 'Superadmin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($ruangan->isEmpty())
                    <tr>
                        <td class="text-center" colspan="4">Data Kosong</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($ruangan as $index => $ruang)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$ruang->nama_ruang}}</td>
                            <td>{{$ruang->plant}}</td>
                            @if (Auth::user()->role == 'Superadmin')
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#edit" data-bs-toggle="modal" title="Edit" data-route="{{route('ruangan.update', $ruang->id)}}"
                                            data-nama="{{$ruang->nama_ruang}}" data-plant="{{$ruang->plant}}"
                                            class="btn btn-warning btn-edit btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="#delete" data-bs-toggle="modal"
                                            data-route="{{route('ruangan.destroy', $ruang->id)}}" title="Hapus" data-nama="{{$ruang->nama_ruang}}"
                                            class="btn btn-danger btn-del btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah-ruang">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Input Data Ruang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('ruangan.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruangan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ruang" id="nama_ruang" required>
                        </div>
                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="plant" id="plant" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit Data Ruang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruangan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ruang" id="edit-nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="plant" id="edit-plant" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Js -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Function
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const route = this.getAttribute('data-route');
                const namaruang = this.getAttribute('data-nama');
                const plant = this.getAttribute('data-plant');
                document.getElementById('form-edit').action = route;
                document.getElementById('edit-nama').value = namaruang;
                document.getElementById('edit-plant').value = plant;
            });
        });
    });
</script>