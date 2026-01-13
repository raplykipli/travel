@extends('layouts.app')

@section('title', isset($pemesanan) ? 'Edit Pemesanan' : 'Create Pemesanan')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ isset($pemesanan) ? 'Edit Pemesanan' : 'Create Pemesanan' }}</h1>

        <form action="{{ isset($pemesanan) ? route('pemesanans.update', $pemesanan->id) : route('pemesanans.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($pemesanan))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="kode_pemesanan" class="block text-gray-700">Kode Pemesanan</label>
                    <input type="text" name="kode_pemesanan" id="kode_pemesanan"
                        value="{{ old('kode_pemesanan', $pemesanan->kode_pemesanan ?? ($kode_pemesanan ?? '')) }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                    @error('kode_pemesanan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="paket_tour_id" class="block text-gray-700">Paket Tour</label>
                    <select name="paket_tour_id" id="paket_tour_id"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('paket_tour_id') border-red-500 @enderror">
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}" data-jadwal="{{ json_encode($package->jadwal) }}"
                                data-harga="{{ $package->harga }}"
                                {{ old('paket_tour_id', $pemesanan->paket_tour_id ?? '') == $package->id ? 'selected' : '' }}>
                                {{ $package->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                    @error('paket_tour_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jadwal" class="block text-gray-700">Jadwal</label>
                    <select name="jadwal" id="jadwal"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('jadwal') border-red-500 @enderror">
                    </select>
                    @error('jadwal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_pemesan" class="block text-gray-700">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" id="nama_pemesan"
                        value="{{ old('nama_pemesan', $pemesanan->nama_pemesan ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('nama_pemesan') border-red-500 @enderror">
                    @error('nama_pemesan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="no_hp" class="block text-gray-700">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pemesanan->no_hp ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('no_hp') border-red-500 @enderror">
                    @error('no_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jumlah_peserta" class="block text-gray-700">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                        value="{{ old('jumlah_peserta', $pemesanan->jumlah_peserta ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('jumlah_peserta') border-red-500 @enderror">
                    @error('jumlah_peserta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                        <option value="menunggu"
                            {{ old('status', $pemesanan->status ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="dikonfirmasi"
                            {{ old('status', $pemesanan->status ?? '') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi
                        </option>
                        <option value="selesai"
                            {{ old('status', $pemesanan->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                        <option value="dibatalkan"
                            {{ old('status', $pemesanan->status ?? '') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="total_harga" class="block text-gray-700">Total Harga</label>
                    <input type="number" name="total_harga" id="total_harga"
                        value="{{ old('total_harga', $pemesanan->total_harga ?? '') }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('total_harga') border-red-500 @enderror"
                        readonly>
                    @error('total_harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="metode_pembayaran" class="block text-gray-700">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('metode_pembayaran') border-red-500 @enderror">
                        <option value="transfer"
                            {{ old('metode_pembayaran', $pemesanan->metode_pembayaran ?? '') == 'transfer' ? 'selected' : '' }}>
                            Transfer</option>
                        <option value="cash"
                            {{ old('metode_pembayaran', $pemesanan->metode_pembayaran ?? '') == 'cash' ? 'selected' : '' }}>
                            Cash
                        </option>
                    </select>
                    @error('metode_pembayaran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status_pembayaran" class="block text-gray-700">Status Pembayaran</label>
                    <select name="status_pembayaran" id="status_pembayaran"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('status_pembayaran') border-red-500 @enderror">
                        <option value="pending"
                            {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'pending' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="lunas"
                            {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'lunas' ? 'selected' : '' }}>
                            Lunas</option>
                        <option value="batal"
                            {{ old('status_pembayaran', $pemesanan->status_pembayaran ?? '') == 'batal' ? 'selected' : '' }}>
                            Batal</option>
                    </select>
                    @error('status_pembayaran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image_bukti" class="block text-gray-700">Bukti Pembayaran</label>
                    <input type="file" name="image_bukti" id="image_bukti"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm @error('image_bukti') border-red-500 @enderror">
                    @error('image_bukti')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                @if (isset($pemesanan) && $pemesanan->image_bukti)
                    <div class="mt-2">
                        <h1>Bukti Pembayaran</h1>
                    </div>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $pemesanan->image_bukti) }}" alt="Bukti Pembayaran"
                            class="w-auto h-60 object-cover">
                    </div>
                @endif
            </div>

            <div class="flex w-full justify-between items-center mt-4">
                <a href="{{ route('pemesanans.index') }}" class="px-2 py-2 bg-gray-400 rounded-md">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ isset($pemesanan) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.getElementById('paket_tour_id');
            const jadwalSelect = document.getElementById('jadwal');
            const jumlahPesertaInput = document.getElementById('jumlah_peserta');
            const totalHargaInput = document.getElementById('total_harga');
            const selectedJadwal = "{{ old('jadwal', $pemesanan->jadwal ?? '') }}";

            function updateJadwalOptions() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                const jadwalData = JSON.parse(selectedOption.getAttribute('data-jadwal'));

                jadwalSelect.innerHTML = '';

                if (jadwalData) {
                    jadwalData.forEach(function(jadwal) {
                        const option = document.createElement('option');
                        option.value = jadwal.tanggal;
                        option.textContent =
                            `${jadwal.tanggal} (${jadwal.jam_berangkat} - ${jadwal.jam_pulang}) - Kuota: ${jadwal.kuota}`;
                        if (selectedJadwal === jadwal.tanggal) {
                            option.selected = true;
                        }
                        jadwalSelect.appendChild(option);
                    });
                }
            }

            function calculateTotalHarga() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                const harga = parseFloat(selectedOption.getAttribute('data-harga'));
                const jumlahPeserta = parseInt(jumlahPesertaInput.value, 10);

                if (!isNaN(harga) && !isNaN(jumlahPeserta)) {
                    totalHargaInput.value = harga * jumlahPeserta;
                } else {
                    totalHargaInput.value = '';
                }
            }

            packageSelect.addEventListener('change', function() {
                updateJadwalOptions();
                calculateTotalHarga();
            });
            jumlahPesertaInput.addEventListener('input', calculateTotalHarga);

            // Initial population
            updateJadwalOptions();
            calculateTotalHarga();
        });
    </script>
@endpush
