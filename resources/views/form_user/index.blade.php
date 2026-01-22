@extends('layouts.guest')

@section('title', 'Buat Pemesanan')

@section('content')
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Form Pemesanan Tiket</h1>
                <p class="text-gray-600">Lengkapi data pemesanan Anda dengan benar</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('form-user.store') }}" method="POST">
                    @csrf

                    <!-- Kode Pemesanan Badge -->
                    <div class="mb-8 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pemesanan</label>
                        <input type="text" name="kode_pemesanan" id="kode_pemesanan" value="{{ $kode_pemesanan }}"
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-lg font-bold text-green-600"
                            readonly>
                        @error('kode_pemesanan')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Main Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Paket Tour -->
                        <div class="mb-4">
                            <label for="paket_tour_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Paket Tour <span class="text-red-500">*</span>
                            </label>
                            <select name="paket_tour_id" id="paket_tour_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('paket_tour_id') border-red-500 @enderror">
                                <option value="">Pilih Paket Tour</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" data-jadwal="{{ json_encode($package->jadwal) }}"
                                        data-harga="{{ $package->harga }}"
                                        {{ old('paket_tour_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->nama_paket }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paket_tour_id')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jadwal -->
                        <div class="mb-4">
                            <label for="jadwal" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jadwal <span class="text-red-500">*</span>
                            </label>
                            <select name="jadwal" id="jadwal"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('jadwal') border-red-500 @enderror">
                                <option value="">Pilih Paket Terlebih Dahulu</option>
                            </select>
                            @error('jadwal')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Pemesan -->
                        <div class="mb-4">
                            <label for="nama_pemesan" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Pemesan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('nama_pemesan') border-red-500 @enderror">
                            @error('nama_pemesan')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="mb-4">
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                                No. HP / WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Peserta -->
                        <div class="mb-4">
                            <label for="jumlah_peserta" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Peserta <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                                value="{{ old('jumlah_peserta') }}" min="1" placeholder="Jumlah peserta"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('jumlah_peserta') border-red-500 @enderror">
                            @error('jumlah_peserta')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Harga -->
                        <div class="mb-4">
                            <label for="total_harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                Total Harga
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                <input type="text" name="total_harga" id="total_harga" value="{{ old('total_harga') }}"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg bg-gray-50 font-bold text-lg text-green-600 @error('total_harga') border-red-500 @enderror"
                                    readonly>
                            </div>
                            @error('total_harga')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Price Info Box -->
                    <div id="price-info" class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200 hidden">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Harga per orang</p>
                                <p class="text-lg font-bold text-green-700" id="harga-per-orang">Rp 0</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-green-700" id="total-display">Rp 0</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-12 py-4 rounded-xl font-semibold text-lg hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 transition duration-200 shadow-lg hover:shadow-xl">
                            Buat Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.getElementById('paket_tour_id');
            const jadwalSelect = document.getElementById('jadwal');
            const jumlahPesertaInput = document.getElementById('jumlah_peserta');
            const totalHargaInput = document.getElementById('total_harga');
            const priceInfo = document.getElementById('price-info');
            const hargaPerOrang = document.getElementById('harga-per-orang');
            const totalDisplay = document.getElementById('total-display');

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            function updateJadwalOptions() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (!selectedOption || !selectedOption.value) {
                    jadwalSelect.innerHTML = '<option value="">Pilih Paket Terlebih Dahulu</option>';
                    return;
                }

                const jadwalData = JSON.parse(selectedOption.getAttribute('data-jadwal'));
                jadwalSelect.innerHTML = '';

                if (jadwalData && jadwalData.length > 0) {
                    jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                    jadwalData.forEach(function(jadwal) {
                        const option = document.createElement('option');
                        option.value = jadwal.tanggal;
                        option.textContent =
                            `${jadwal.tanggal} (${jadwal.jam_berangkat} - ${jadwal.jam_pulang}) - Kuota: ${jadwal.kuota}`;
                        jadwalSelect.appendChild(option);
                    });
                } else {
                    jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                }
            }

            function calculateTotalHarga() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (!selectedOption || !selectedOption.value) {
                    totalHargaInput.value = '';
                    priceInfo.classList.add('hidden');
                    return;
                }

                const harga = parseFloat(selectedOption.getAttribute('data-harga'));
                const jumlahPeserta = parseInt(jumlahPesertaInput.value, 10);

                if (!isNaN(harga) && !isNaN(jumlahPeserta) && jumlahPeserta > 0) {
                    const total = harga * jumlahPeserta;
                    totalHargaInput.value = total;

                    // Update price info box
                    hargaPerOrang.textContent = 'Rp ' + formatRupiah(harga);
                    totalDisplay.textContent = 'Rp ' + formatRupiah(total);
                    priceInfo.classList.remove('hidden');
                } else {
                    totalHargaInput.value = '';
                    priceInfo.classList.add('hidden');
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
