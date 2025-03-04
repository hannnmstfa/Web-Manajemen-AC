<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('/storage/image/assets/favicon.png')}}" type="image/x-icon">
    <title>
        {{ $title ?? config('app.name', 'Laravel') }}
    </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/mycust.css')}}">
    {{--
    <link id="customcss" rel="stylesheet" href="{{asset('/assets/custom.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('/assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/select2/css/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/sweetalert2/sweetalert2.min.css')}}">

    {{-- js --}}
    <script src="{{asset('/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('/assets/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/sweetalert2/sweetalert2.min.js')}}"></script>
</head>

<body>
    <div class="d-flex">
        {{-- <div id="sidebar1">
            @include('layouts.sidebar')
        </div> --}}
        <div id="sidebar2">
            @include('layouts.sidebar2')
        </div>

        <!-- Main Content -->
        <div class="main-content w-100">
            @include('layouts.navbar')
            @include('sweetalert::alert')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <main class="container-fluid pt-3 pb-5">
                {{$slot}}
            </main>
        </div>
    </div>
</body>
<!-- Modal Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="formdelete" method="post">
                        @csrf
                        @method('DELETE')
                        <p>Apakah Anda Yakin ingin menghapus <span id="namaspan" class="fw-bold"></span> ?</p>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Lanjutkan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</html>


<script>
    function sidebartoggle() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const navbar = document.querySelector('.navbar');
        const toggleButton = document.querySelector('.sidebar-toggle');

        // Cek jika ukuran layar lebih kecil dari atau sama dengan 768px (mobile)
        if (window.innerWidth <= 768) {
            // Toggle kelas 'hidden' untuk menampilkan atau menyembunyikan sidebar
            sidebar.classList.toggle('expanded');
        } else {
            // Tidak perlu perubahan pada tampilan desktop
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded');
            navbar.classList.toggle('expanded');
        }
    }

    // Script for dropdown functionality
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('click', function () {
                const targetMenu = document.querySelector(this.getAttribute('data-target'));
                targetMenu.classList.toggle('show');
            });
        });
    });

    // Delete Function
    document.querySelectorAll('.btn-del').forEach(button => {
        button.addEventListener('click', function () {
            const route = this.getAttribute('data-route');
            const nama = this.getAttribute('data-nama');
            document.getElementById('formdelete').action = route;
            document.getElementById('namaspan').textContent = nama;
        });
    });

    // Change button submit
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function(event) {
                let submitButton = form.querySelector('button[type="submit"]');

                if (submitButton) {
                    let spinner = document.createElement("span");
                    spinner.classList.add("spinner-border", "spinner-border-sm");
                    spinner.setAttribute("role", "status");
                    spinner.setAttribute("aria-hidden", "true");

                    // Menambahkan spinner ke dalam tombol
                    submitButton.appendChild(spinner);

                    // Menonaktifkan tombol submit agar tidak bisa diklik berulang kali
                    submitButton.disabled = true;
                }
            });
        });
    });
</script>