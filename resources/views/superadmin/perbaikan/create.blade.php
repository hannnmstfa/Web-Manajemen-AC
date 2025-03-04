<x-app-layout title="Buat Pengajuan Perbaikan">
    <div class="container-fluid d-flex justify-content-between align-items-center py-2 mx-auto">
        <h2 class="fw-bold">Input Pengajuan Perbaikan</h2>
        <a href="{{route('pengajuan.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
            Kembali</a>
    </div>
    <div class="container-fluid card-body border-none border-top border-5 border-success-subtle d-flex row justify-content-center rounded-0 shadow mx-auto p-3 bg-light">
        <div class="col-md-6">
            <form action="{{route('pengajuan.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="ac_id" class="form-label">Nama AC <span class="text-danger">*</span></label>
                    <select name="ac_id" id="select2" class="form-select" required style="width: 100%">
                        <option value="" selected disabled>-- Pilih Nama AC --</option>
                        @if ($ac->isEmpty())
                            <option disabled class="text-center fst-italic">Belum Ada Data AC</option>
                        @else
                            <x-select2 />
                            @foreach ($ac as $ac)
                                <option value="{{$ac->id}}">{{$ac->nama_ac}} - {{$ac->ruangan->nama_ruang}} Plant
                                    {{$ac->ruangan->plant}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
                    <input type="date" id="tgl_pengajuan" class="form-control" name="tgl_pengajuan" required>
                </div>
                <div class="mb-3">
                    <label for="permasalahan" class="form-label">Permasalahan <span class="text-danger">*</span></label>
                    <textarea name="permasalahan" id="permasalahan" class="form-control" placeholder="Masukkan Permasalahan pada AC" required>{{old('permasalahan')}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="indikasi" class="form-label">Indikasi <span class="text-danger">*</span></label>
                    <textarea name="indikasi" id="indikasi" class="form-control" placeholder="Masukkan Indikasi pada AC" required>{{old('indikasi ')}}</textarea>
                </div>
                <button type="submit" class="btn btn-success w-100 mb-3">Ajukan Perbaikan </button>
            </form>
        </div>
    </div>
</x-app-layout>