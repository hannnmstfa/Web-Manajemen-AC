<x-app-layout title="Profile">
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <form action="{{route('profile.update', $user->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="card shadow-lg rounded-lg border-0 bg-light container-fluid">
                <div class="container-fluid my-5">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-4 text-center mb-3">
                            @if ($user->avatar == null)
                                <img src="https://i.pinimg.com/originals/7e/40/9f/7e409f4d996cb2f3e1830ba24852673c.gif"
                                    alt="Avatar"
                                    class="rounded-pill border-1 border border-1 border-primary-subtle mb-3 w-75">
                            @else
                                <img src="{{asset('/storage/image/avatar/' . $user->avatar)}}" alt="Avatar"
                                    class="rounded-pill border-1 border border-1 border-primary-subtle mb-3 w-75">
                            @endif
                            <h4>{{ $user->name }}</h4>
                            <p class="text-muted">Role : {{ $user->role }}</p>
                            <a data-bs-toggle="modal" data-bs-target="#change-avatar"
                                class="text-decoration-none pointer text-secondary"><i class="fa-solid fa-pen"></i>
                                Ganti Avatar</a>
                        </div>

                        <div class="col-md-8">
                            <div class="d-flex justify-content-between">
                                <h4>Profile</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control"
                                        id="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" value="{{$user->username}}" class="form-control"
                                        id="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="password_confirmation">
                                </div>
                                <!-- <div class="mb-3">
                                <label for="aboutMe" class="form-label">About Me</label>
                                <textarea class="form-control" id="aboutMe"
                                rows="3">I&#39;m a web designer, I work in programs like Figma, Adobe Photoshop, Adobe Illustrator.</textarea>
                            </div> -->
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                <hr class="my-2">
                                <h4>Delete Account</h4>
                                <p>Menghapus Akun berarti menghapus seluruh data dan aktivitas dari akun ini. Pastikan
                                    Anda
                                    sudah membackup data penting karena <span class="text-danger">Tindakan ini tidak
                                        dapat dibatalkan.</span></p>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteacc"
                                    class="btn btn-secondary hapus-akun">Hapus AKun</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="deleteacc">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Konfirmasi Hapus Akun</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('profile.destroy')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <div class="label">Konfirmasi Password <span class="text-danger">*</span></div>
                            <x-text-input id="password" name="password" type="password" class="form-control"
                                placeholder="{{ __('Password') }}" required />
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-danger rounded-0">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ganti Avatar --}}
    <div class="modal fade" id="change-avatar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="fw-bold">Ganti Avatar</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('change.avatar')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-text-input class="form-control" type="file" name="avatar" accept=".jpg,.jpeg,.png,.svg,.webp"
                            required />
                        <button type="submit" class="btn btn-success mt-2 w-100">Simpan Avatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>