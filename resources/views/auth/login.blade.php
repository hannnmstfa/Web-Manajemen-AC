<x-guest-layout title="Login">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="my-3">
            <label for="username" class="form-label">Username</label>
            <x-text-input id="username" class="form-control" type="text" placeholder="Masukkan Username terdaftar"
                name="username" :value="old('username')" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password">Password</label>
            <div class="input-group">
                <x-text-input id="password" class="form-control" type="password" name="password"
                    placeholder="Masukkan Password Anda" required autocomplete="current-password" />
                    <button class="input-group-text" type="button" id="show"><i id="eye-icon" class="fa-regular fa-eye"></i></button>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary rounded-0 w-25">Login </button>
        </div>
    </form>
</x-guest-layout>
<script>
    document.getElementById('show').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var eyeIcon = document.getElementById('eye-icon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>