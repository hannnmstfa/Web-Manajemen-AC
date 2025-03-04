<section>
    <header>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="form-title">
                {{ __("Profil information") }}
            </h4>
            <!-- Tombol Simpan -->
            <div class="flex items-center gap-4">
                <button type="submit">
                    {{ __('Save') }}
                </button>

                <!-- Notifikasi Berhasil -->
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </header>

    <!-- Form untuk Kirim Ulang Verifikasi Email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Update Profil -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Input Nama -->
        <div class="form-section">
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text"
                        class="mt-1 block w-full border rounded-lg px-3 py-2" :value="old('name', $user->name)" required
                        autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Input Email -->
                <div class="col-md-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email"
                        class="mt-1 block w-full border rounded-lg px-3 py-2" :value="old('email', $user->email)"
                        required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-gray-800">
                                {{ __('Your email address is unverified.') }}
                            </p>

                            <button form="send-verification" type="submit"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-1">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>



    </form>
</section>