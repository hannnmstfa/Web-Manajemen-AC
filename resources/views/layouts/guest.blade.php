<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('/assets/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/mycust.css')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{asset('/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/sweetalert2/sweetalert2.min.js')}}"></script>
    <style>
        body {
            background: url('{{ asset('/storage/image/assets/background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.718);
            backdrop-filter: blur(5px);
            border-radius: 10px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('sweetalert::alert')
    <div class="container-fluid  row d-flex justify-content-center align-items-center min-vh-100 w-100 mx-auto">
        <div class="login-container p-3 col-md-3 shadow mx-auto">
            <a href="{{route('/')}}" class="w-100 text-decoration-none text-dark d-flex flex-column align-items-center justify-content-center">
                <img src="{{asset('/storage/image/assets/favicon.png')}}" class="w-15" alt="Logo">
                <h4 class="fw-bold">PT. Sinar Indah Kertas</h4>
            </a>
            <hr>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
<script>
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