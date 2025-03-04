<x-app-layout title="Data Pengguna">
    <div class="container-fluid d-flex justify-content-between align-items-center m-2">
        <h2>Data Pengguna</h2>
        <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah
            User</a>
    </div>
    <div class="py-2 container-fluid card-body bg-light border-none border-top border-5 border-primary-subtle container-fluid shadow mx-auto p-3">
            <table id="myTable" class="table table-responsive table-striped table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isEmpty())
                        <tr>
                            <td class="text-center" colspan="4">Data Kosong</td>
                        </tr>
                    @else
                        <x-datatable />
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td class="text-capitalize">{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->show_pw}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning btn-edit btn-sm"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="#delete" data-bs-toggle="modal"
                                            data-route="{{route('users.destroy', $user->id)}}" data-nama="{{$user->name}}"
                                            class="btn btn-danger btn-del btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    </div>
</x-app-layout>