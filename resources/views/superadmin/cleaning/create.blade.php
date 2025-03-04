<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Tambah Data Cleaning</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cleaning.store') }}" method="POST">
                    @csrf

                    <!-- Tanggal Planning -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Planning</label>
                        <input type="date" name="tgl_planing" class="form-control" value="{{ old('tgl_planing') }}"
                            required>
                        @error('tgl_planing')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama AC -->
                    <div class="mb-3">
                        <label for="ac_id" class="form-label">Nama AC <span class="text-danger">*</span></label>
                        <select name="ac_id" id="select2" class="form-control" required>
                            <option value="" disabled {{ old('ac_id') ? '' : 'selected' }}>-- Pilih Nama AC --</option>
                            @if ($ac->isEmpty())
                                <option disabled class="text-center fst-italic">Belum Ada Data AC</option>
                            @else
                                <x-select2 />
                                @foreach ($ac as $ac)
                                    <option value="{{ $ac->id }}">
                                        {{ $ac->nama_ac }} - {{ $ac->ruangan->nama_ruang }} (Plant {{ $ac->ruangan->plant }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Vendor -->
                    <div class="mb-3">
                        <label class="form-label">Vendor</label>
                        <select name="vendor_id" id="select_2" class="form-control" required>
                            <option value="" disabled {{ old('vendor_id') ? '' : 'selected' }}>-- Pilih Nama Vendor --
                            </option>
                            @if ($vendor->isEmpty())
                                <option disabled class="text-center fst-italic">Belum Ada Data AC</option>
                            @else
                                <script>
                                    $('#select_2').select2({
                                        theme: 'bootstrap4',
                                        width: 'resolve'
                                    });
                                </script>
                                @foreach ($vendor as $vendor)
                                    <option value="{{ $vendor->id }}">
                                        {{ $vendor->nama_vendor }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Simpan </button>
                        <a href="{{ route('cleaning.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>