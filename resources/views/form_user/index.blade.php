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
                                        data-harga="{{ $package->harga }}" data-bus="{{ json_encode($package->bus) }}"
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

                        <!-- Pemilihan Kursi (Denah) -->
                        <div class="mb-4 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilih Kursi <span class="text-red-500">*</span>
                            </label>
                            
                            <!-- Legend -->
                            @php
                                $seatSvgIcon = '<svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><rect x="8" y="2" width="8" height="4" rx="2" /><rect x="5" y="7" width="14" height="11" rx="2" /><rect x="3" y="10" width="2" height="6" rx="1" /><rect x="19" y="10" width="2" height="6" rx="1" /></svg>';
                            @endphp
                            <div class="flex items-center space-x-6 mb-6 text-sm font-medium justify-center text-gray-700">
                                <div class="flex items-center"><div class="w-8 h-8 bg-gray-300 rounded-md flex items-center justify-center text-white mr-2">{!! $seatSvgIcon !!}</div> Tersedia</div>
                                <div class="flex items-center"><div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center text-white mr-2">{!! $seatSvgIcon !!}</div> Dipilih</div>
                                <div class="flex items-center"><div class="w-8 h-8 bg-red-600 rounded-md flex items-center justify-center text-white mr-2">{!! $seatSvgIcon !!}</div> Terpakai</div>
                            </div>

                            <div id="seat-map-container" class="bg-gray-100 p-6 rounded-xl border border-gray-300 hidden flex-col items-center">
                                <div class="w-full max-w-sm">
                                    <div class="bg-gray-800 rounded-t-3xl h-12 mb-6 flex items-center justify-center font-bold text-white border-b-4 border-gray-600 tracking-widest shadow-md">SUPIR</div>
                                    <div id="seat-grid" class="flex flex-col gap-3">
                                        <!-- Kursi akan di-render menggunakan JS -->
                                    </div>
                                    <div class="mt-8 bg-gray-400 h-8 rounded-b-xl shadow-inner"></div>
                                </div>
                            </div>
                            
                            <!-- Hidden inputs for submission -->
                            <div id="selected-seats-inputs"></div>
                            
                            <p class="text-sm text-gray-800 font-semibold mt-4 text-center" id="seat-selection-text">Belum ada kursi yang dipilih.</p>
                            @error('nomor_kursi')
                                <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Hidden Jumlah Peserta (Masih dipakai untuk hitung harga di JS tapi Hidden) -->
                        <input type="hidden" name="jumlah_peserta" id="jumlah_peserta" value="{{ old('jumlah_peserta', 0) }}">

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
            
            const seatMapContainer = document.getElementById('seat-map-container');
            const seatGrid = document.getElementById('seat-grid');
            const selectedSeatsInputs = document.getElementById('selected-seats-inputs');
            const seatSelectionText = document.getElementById('seat-selection-text');
            
            let selectedSeatsArray = [];
            let bookedSeatsArray = [];
            let currentBusSeats = 0;

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
            
            // Seat Map Logics
            jadwalSelect.addEventListener('change', async function() {
                const paketId = packageSelect.value;
                const jadwal = jadwalSelect.value;
                
                selectedSeatsArray = [];
                updateSeatSelection();
                
                if (paketId && jadwal) {
                    try {
                        const response = await fetch(`/api/kursi-terpakai?paket_tour_id=${paketId}&jadwal=${jadwal}`);
                        bookedSeatsArray = await response.json();
                        renderSeatMap();
                    } catch (error) {
                        console.error('Error fetching booked seats:', error);
                    }
                } else {
                    seatMapContainer.classList.add('hidden');
                }
            });

            function toggleSeat(seatNum) {
                if (bookedSeatsArray.includes(seatNum)) return; // Tidak bisa klik kursi terpakai

                const index = selectedSeatsArray.indexOf(seatNum);
                if (index > -1) {
                    selectedSeatsArray.splice(index, 1); // remove
                } else {
                    selectedSeatsArray.push(seatNum); // add
                }
                
                updateSeatSelection();
            }
            
            function updateSeatSelection() {
                // Update input hidden and text
                jumlahPesertaInput.value = selectedSeatsArray.length;
                
                selectedSeatsInputs.innerHTML = '';
                selectedSeatsArray.forEach(seat => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'nomor_kursi[]';
                    input.value = seat;
                    selectedSeatsInputs.appendChild(input);
                });

                seatSelectionText.textContent = selectedSeatsArray.length > 0 
                    ? `Kursi dipilih: ${selectedSeatsArray.join(', ')}` 
                    : 'Belum ada kursi yang dipilih.';

                renderSeatMap();
                calculateTotalHarga();
            }

            function renderSeatMap() {
                if (currentBusSeats <= 0) {
                    seatMapContainer.classList.add('hidden');
                    return;
                }
                
                seatMapContainer.classList.remove('hidden');
                seatMapContainer.classList.add('flex');
                
                seatGrid.innerHTML = '';
                
                // Layout standard bus: 2 kursi kiri, lorong, 2 kursi kanan
                const totalRows = Math.ceil(currentBusSeats / 4);
                let seatCounter = 1;
                const alphabet = ['A', 'B', 'C', 'D'];

                for (let row = 1; row <= totalRows; row++) {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'flex justify-between w-full mb-1';
                    
                    // Kiri (A & B)
                    const leftDiv = document.createElement('div');
                    leftDiv.className = 'flex gap-2';
                    for (let i = 0; i < 2; i++) {
                        const seatName = `${row}${alphabet[i]}`;
                        if (seatCounter <= currentBusSeats) {
                            leftDiv.appendChild(createSeatElement(seatName));
                            seatCounter++;
                        } else {
                            leftDiv.appendChild(createEmptySpace());
                        }
                    }
                    
                    // Lorong (Space)
                    const aisleDiv = document.createElement('div');
                    aisleDiv.className = 'w-8';
                    
                    // Kanan (C & D)
                    const rightDiv = document.createElement('div');
                    rightDiv.className = 'flex gap-2';
                    for (let i = 2; i < 4; i++) {
                        const seatName = `${row}${alphabet[i]}`;
                        if (seatCounter <= currentBusSeats) {
                            rightDiv.appendChild(createSeatElement(seatName));
                            seatCounter++;
                        } else {
                            rightDiv.appendChild(createEmptySpace());
                        }
                    }
                    
                    rowDiv.appendChild(leftDiv);
                    rowDiv.appendChild(aisleDiv);
                    rowDiv.appendChild(rightDiv);
                    
                    seatGrid.appendChild(rowDiv);
                }
            }

            function createSeatElement(seatName) {
                const isBooked = bookedSeatsArray.includes(seatName);
                const isSelected = selectedSeatsArray.includes(seatName);
                
                const seatBtn = document.createElement('div');
                seatBtn.className = `w-12 h-14 flex flex-col items-center justify-center rounded-lg cursor-pointer select-none transition-all duration-200 shadow-sm relative overflow-hidden transform hover:scale-105`;
                
                const seatSvg = `<svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-auto mb-1"><rect x="8" y="2" width="8" height="4" rx="2" /><rect x="5" y="7" width="14" height="11" rx="2" /><rect x="3" y="10" width="2" height="6" rx="1" /><rect x="19" y="10" width="2" height="6" rx="1" /></svg>`;
                seatBtn.innerHTML = `${seatSvg}<span class="text-[10px] font-bold leading-none">${seatName}</span>`;
                
                if (isBooked) {
                    seatBtn.className = `w-12 h-14 flex flex-col items-center justify-center rounded-lg select-none relative overflow-hidden bg-red-600 text-white cursor-not-allowed opacity-90`;
                    seatBtn.innerHTML = `${seatSvg}<span class="text-[10px] font-bold leading-none">${seatName}</span>`;
                } else if (isSelected) {
                    seatBtn.classList.add('bg-green-500', 'text-white', 'shadow-md', 'ring-2', 'ring-green-400', 'ring-offset-1');
                    seatBtn.onclick = () => toggleSeat(seatName);
                } else {
                    seatBtn.classList.add('bg-gray-300', 'text-white', 'hover:bg-gray-400');
                    seatBtn.onclick = () => toggleSeat(seatName);
                }
                
                return seatBtn;
            }
            
            function createEmptySpace() {
                const empty = document.createElement('div');
                empty.className = 'w-12 h-14';
                return empty;
            }

            packageSelect.addEventListener('change', function() {
                selectedSeatsArray = [];
                bookedSeatsArray = [];
                updateSeatSelection();
                
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    let busData = null;
                    try {
                        busData = JSON.parse(selectedOption.getAttribute('data-bus') || '{}');
                    } catch(e) {}
                    currentBusSeats = busData ? (parseInt(busData.jumlah_kursi) || 0) : 0;
                } else {
                    currentBusSeats = 0;
                }
                
                updateJadwalOptions();
                calculateTotalHarga();
                renderSeatMap();
            });

            // Initial population
            if(packageSelect.value){
                const evt = new Event('change');
                packageSelect.dispatchEvent(evt);
            }
        });
    </script>
@endpush
