<x-app-layout title="Data Vendor">
    <div class="container-f;uid d-flex justify-content-between align-items-center mx-auto m-2">
        <h2>Data Vendor</h2>
        @if (Auth::user()->role == 'Superadmin')
        <a href="{{route('vendor.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Vendor</a>
        @endif
    </div>
    <div class="container-fluid table-responsive  card-body bg-light border-none border-top border-5 border-primary-subtle shadow p-3 rounded-2">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th>No</th>
                    <th>Nama Vendor</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    @if (Auth::user()->role == 'Superadmin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($vendor->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Data</td>
                    </tr>
                @else
                    <x-datatable />
                    @foreach ($vendor as $index => $vendor)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$vendor->nama_vendor}}</td>
                            <td>{{$vendor->alamat}}</td>
                            <td>{{$vendor->phone}}</td>
                            @if (Auth::user()->role == 'Superadmin')
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{route('vendor.edit', $vendor->id)}}" title="Edit" class="btn btn-warning btn-sm"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="#delete" data-bs-toggle="modal"
                                        data-route="{{route('vendor.destroy', $vendor->id)}}" title="Hapus"
                                        data-nama="{{$vendor->nama_vendor}}" class="btn btn-danger btn-del btn-sm"><i
                                        class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                                @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>