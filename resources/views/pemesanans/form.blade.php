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
                <input type="hidden" id="edit-mode" value="1">
                <input type="hidden" id="current-seat" value="{{ $pemesanan->nomor_kursi }}">
            @else
                <input type="hidden" id="edit-mode" value="0">
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
                                data-harga="{{ $package->harga }}" data-bus="{{ json_encode($package->bus) }}"
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

                <!-- Pemilihan Kursi (Denah) -->
                <div class="mb-4 md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Pilih Kursi <span class="text-red-500">*</span></label>
                    
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
                    
                    <div id="selected-seats-inputs"></div>
                    
                    <p class="text-sm text-gray-800 font-semibold mt-4 text-center" id="seat-selection-text">Belum ada kursi yang dipilih.</p>
                    @error('nomor_kursi')
                        <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="jumlah_peserta" id="jumlah_peserta" value="{{ old('jumlah_peserta', $pemesanan->jumlah_peserta ?? 1) }}">

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
                    class="bg-red-500 text-white px-4 py-2 rounded-md">{{ isset($pemesanan) ? 'Update' : 'Create' }}</button>
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
            
            const isEditMode = document.getElementById('edit-mode').value === '1';
            const currentSeat = isEditMode ? document.getElementById('current-seat').value : null;

            const seatMapContainer = document.getElementById('seat-map-container');
            const seatGrid = document.getElementById('seat-grid');
            const selectedSeatsInputs = document.getElementById('selected-seats-inputs');
            const seatSelectionText = document.getElementById('seat-selection-text');

            let selectedSeatsArray = [];
            let bookedSeatsArray = [];
            let currentBusSeats = 0;

            function updateJadwalOptions() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (!selectedOption || !selectedOption.value) {
                    jadwalSelect.innerHTML = '<option value="">Pilih Paket Terlebih Dahulu</option>';
                    return;
                }
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
                if (!selectedOption || !selectedOption.value) {
                    totalHargaInput.value = '';
                    return;
                }
                const harga = parseFloat(selectedOption.getAttribute('data-harga'));
                const jumlahPeserta = parseInt(jumlahPesertaInput.value, 10);

                if (!isNaN(harga) && !isNaN(jumlahPeserta) && jumlahPeserta > 0) {
                    totalHargaInput.value = harga * jumlahPeserta;
                } else {
                    totalHargaInput.value = '';
                }
            }
            
            async function fetchBookedSeats() {
                const paketId = packageSelect.value;
                const jadwal = jadwalSelect.value;
                
                if (paketId && jadwal) {
                    try {
                        const response = await fetch(`/api/kursi-terpakai?paket_tour_id=${paketId}&jadwal=${jadwal}`);
                        bookedSeatsArray = await response.json();
                        
                        // Jika mode edit dan kursi yang sedang diedit ada di daftar terpakai, hapus dari daftar (agar bisa diklik jika mau dibiarkan)
                        if (isEditMode && currentSeat) {
                            bookedSeatsArray = bookedSeatsArray.filter(seat => seat !== currentSeat);
                        }
                        
                        renderSeatMap();
                    } catch (error) {
                        console.error('Error fetching booked seats:', error);
                    }
                } else {
                    seatMapContainer.classList.add('hidden');
                }
            }

            jadwalSelect.addEventListener('change', function() {
                if (!isEditMode) {
                    selectedSeatsArray = [];
                }
                updateSeatSelection();
                fetchBookedSeats();
            });

            function toggleSeat(seatNum) {
                if (bookedSeatsArray.includes(seatNum)) return; // Tidak bisa klik kursi terpakai

                const index = selectedSeatsArray.indexOf(seatNum);
                if (index > -1) {
                    // Jika mode edit, tidak boleh unselect kursi sampai kosong jika dipaksa reselect lain.
                    // Tapi biarkan fungsi tetap natural, jika 0 kursi pesan error muncu via backend.
                    selectedSeatsArray.splice(index, 1);
                } else {
                    if (isEditMode) {
                        // Jika mode edit, ganti kursi (single selection constraint)
                        selectedSeatsArray = [seatNum];
                    } else {
                        selectedSeatsArray.push(seatNum);
                    }
                }
                
                updateSeatSelection();
            }

            function updateSeatSelection() {
                jumlahPesertaInput.value = selectedSeatsArray.length;
                
                selectedSeatsInputs.innerHTML = '';
                selectedSeatsArray.forEach(seat => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    // Jika mode edit, input namenya string tunggal, bukan array (di backend divalidasi string)
                    input.name = isEditMode ? 'nomor_kursi' : 'nomor_kursi[]';
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
                
                const totalRows = Math.ceil(currentBusSeats / 4);
                let seatCounter = 1;
                const alphabet = ['A', 'B', 'C', 'D'];

                for (let row = 1; row <= totalRows; row++) {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'flex justify-between w-full mb-1';
                    
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
                    
                    const aisleDiv = document.createElement('div');
                    aisleDiv.className = 'w-8';
                    
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
                if (!isEditMode) {
                    selectedSeatsArray = [];
                }
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
                fetchBookedSeats();
            });

            // Initial population
            if (packageSelect.value) {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (selectedOption) {
                    let busData = null;
                    try {
                        busData = JSON.parse(selectedOption.getAttribute('data-bus') || '{}');
                    } catch(e) {}
                    currentBusSeats = busData ? (parseInt(busData.jumlah_kursi) || 0) : 0;
                }
                updateJadwalOptions();
                
                if (isEditMode && currentSeat) {
                    selectedSeatsArray = [currentSeat];
                }
                
                updateSeatSelection();
                fetchBookedSeats();
            }
        });
    </script>
@endpush

