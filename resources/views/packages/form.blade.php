@extends('layouts.app')

@section('title', isset($package) ? 'Edit Package' : 'Create Package')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ isset($package) ? 'Edit Package' : 'Create Package' }}</h1>

        <form action="{{ isset($package) ? route('packages.update', $package->id) : route('packages.store') }}"
            method="POST">
            @csrf
            @if (isset($package))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama_paket" class="block text-gray-700">Nama Paket</label>
                    <input type="text" name="nama_paket" id="nama_paket"
                        value="{{ old('nama_paket', $package->nama_paket ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('nama_paket') border-red-500 @enderror">
                    @error('nama_paket')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="buses_id" class="block text-gray-700">Bus</label>
                    <select name="buses_id" id="buses_id" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('buses_id') border-red-500 @enderror">
                        @foreach ($buses as $bus)
                            <option value="{{ $bus->id }}"
                                {{ old('buses_id', $package->buses_id ?? '') == $bus->id ? 'selected' : '' }}>
                                {{ $bus->plat_nomor }} - {{ $bus->jenis_bus }}
                            </option>
                        @endforeach
                    </select>
                    @error('buses_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="destinasi" class="block text-gray-700">Destinasi</label>
                    <input type="text" name="destinasi" id="destinasi"
                        value="{{ old('destinasi', $package->destinasi ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('destinasi') border-red-500 @enderror">
                    @error('destinasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="durasi" class="block text-gray-700">Durasi</label>
                    <input type="text" name="durasi" id="durasi" value="{{ old('durasi', $package->durasi ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('durasi') border-red-500 @enderror">
                    @error('durasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="harga" class="block text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $package->harga ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('harga') border-red-500 @enderror">
                    @error('harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="max_peserta" class="block text-gray-700">Max Peserta</label>
                    <input type="number" name="max_peserta" id="max_peserta"
                        value="{{ old('max_peserta', $package->max_peserta ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('max_peserta') border-red-500 @enderror">
                    @error('max_peserta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                        <option value="aktif" {{ old('status', $package->status ?? '') == 'aktif' ? 'selected' : '' }}>
                            Aktif</option>
                        <option value="nonaktif"
                            {{ old('status', $package->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="fasilitas" class="block text-gray-700">Fasilitas</label>
                <textarea name="fasilitas" id="fasilitas" rows="3" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas', $package->fasilitas ?? '') }}</textarea>
                @error('fasilitas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $package->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div id="jadwal-container">
                <label class="block text-gray-700">Jadwal</label>
                @if (old('jadwal', $package->jadwal ?? []))
                    @foreach (old('jadwal', $package->jadwal ?? []) as $index => $jadwal)
                        <div class="jadwal-entry grid grid-cols-5 gap-4 mb-2">
                            <input type="date" name="jadwal[{{ $index }}][tanggal]"
                                value="{{ $jadwal['tanggal'] }}"
                                class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error("jadwal.${index}.tanggal") border-red-500 @enderror">
                            <input type="time" name="jadwal[{{ $index }}][jam_berangkat]"
                                value="{{ $jadwal['jam_berangkat'] }}"
                                class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error("jadwal.${index}.jam_berangkat") border-red-500 @enderror">
                            <input type="time" name="jadwal[{{ $index }}][jam_pulang]"
                                value="{{ $jadwal['jam_pulang'] }}"
                                class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error("jadwal.${index}.jam_pulang") border-red-500 @enderror">
                            <input type="number" name="jadwal[{{ $index }}][kuota]" value="{{ $jadwal['kuota'] }}"
                                placeholder="Kuota" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error("jadwal.${index}.kuota") border-red-500 @enderror">
                            <button type="button"
                                class="remove-jadwal-btn bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                        </div>
                        @error("jadwal.${index}.tanggal")
                            <p class="text-red-500 text-sm mt-1 col-span-5">{{ $message }}</p>
                        @enderror
                        @error("jadwal.${index}.jam_berangkat")
                            <p class="text-red-500 text-sm mt-1 col-span-5">{{ $message }}</p>
                        @enderror
                        @error("jadwal.${index}.jam_pulang")
                            <p class="text-red-500 text-sm mt-1 col-span-5">{{ $message }}</p>
                        @enderror
                        @error("jadwal.${index}.kuota")
                            <p class="text-red-500 text-sm mt-1 col-span-5">{{ $message }}</p>
                        @enderror
                    @endforeach
                @endif
                @error('jadwal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="button" id="add-jadwal-btn" class="bg-green-500 text-white px-4 py-2 rounded-md mt-2">Add
                    Jadwal</button>
            </div>

            <div>
                <a href=""></a>

            </div>
            <div class="flex w-full justify-between items-center mt-4">
                <a href="{{ route('packages.index') }}" class="px-2 py-2 bg-gray-400 rounded-md">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ isset($package) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('jadwal-container');
        const addBtn = document.getElementById('add-jadwal-btn');
        let index = container.querySelectorAll('.jadwal-entry').length;

        addBtn.addEventListener('click', function() {
            const newEntry = document.createElement('div');
            newEntry.classList.add('jadwal-entry', 'grid', 'grid-cols-5', 'gap-4', 'mb-2');
            newEntry.innerHTML = `
                <input type="date" name="jadwal[${index}][tanggal]" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                <input type="time" name="jadwal[${index}][jam_berangkat]" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                <input type="time" name="jadwal[${index}][jam_pulang]" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                <input type="number" name="jadwal[${index}][kuota]" placeholder="Kuota" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                <button type="button" class="remove-jadwal-btn bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
            `;
            container.appendChild(newEntry);
            index++;
        });

        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-jadwal-btn')) {
                e.target.closest('.jadwal-entry').remove();
            }
        });
    });
</script>
@endpush
