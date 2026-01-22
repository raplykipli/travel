@extends('layouts.guest')

@section('title', 'Pembayaran')

@section('content')
    <div class="min-h-screen  py-8 px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Pembayaran</h1>
                <p class="text-gray-600">Selesaikan pembayaran untuk melanjutkan pemesanan</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Kode Pemesanan Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white">
                    <p class="text-sm opacity-90 mb-1">Kode Pemesanan</p>
                    <p class="text-2xl font-bold font-mono tracking-wider">{{ $pemesanan->kode_pemesanan }}</p>
                </div>

                <!-- Total Tagihan -->
                <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 border-b-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Tagihan</p>
                            <p class="text-4xl font-bold text-green-600">
                                Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-8">
                    <form action="{{ route('form-user.process-payment', $pemesanan) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Metode Pembayaran -->
                        <div class="mb-6">
                            <label for="metode_pembayaran" class="block text-sm font-semibold text-gray-700 mb-3">
                                Pilih Metode Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Transfer Bank Option -->
                                <label class="payment-option cursor-pointer">
                                    <input type="radio" name="metode_pembayaran" value="transfer" class="hidden peer"
                                        {{ old('metode_pembayaran') == 'transfer' ? 'checked' : '' }}>
                                    <div
                                        class="p-6 border-2 border-gray-300 rounded-xl hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-200">
                                        <div class="flex items-center justify-center mb-3">
                                            <svg class="w-12 h-12 text-gray-400 peer-checked:text-green-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                        </div>
                                        <p class="text-center font-semibold text-gray-700">Transfer Bank</p>
                                        <p class="text-center text-sm text-gray-500 mt-1">Transfer via rekening bank</p>
                                    </div>
                                </label>

                                <!-- Cash Option -->
                                <label class="payment-option cursor-pointer">
                                    <input type="radio" name="metode_pembayaran" value="cash" class="hidden peer"
                                        {{ old('metode_pembayaran') == 'cash' ? 'checked' : '' }}>
                                    <div
                                        class="p-6 border-2 border-gray-300 rounded-xl hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-200">
                                        <div class="flex items-center justify-center mb-3">
                                            <svg class="w-12 h-12 text-gray-400 peer-checked:text-green-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-center font-semibold text-gray-700">Pembayaran Cash</p>
                                        <p class="text-center text-sm text-gray-500 mt-1">Bayar di kantor</p>
                                    </div>
                                </label>
                            </div>
                            @error('metode_pembayaran')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Informasi Rekening (for Transfer) -->
                        <div id="rekening-card" class="hidden mb-6 animate-fadeIn">
                            <div
                                class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-200">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-800">Informasi Rekening</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-gray-600 font-medium">Bank</span>
                                        <span class="font-bold text-gray-800">BCA</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-gray-600 font-medium">No. Rekening</span>
                                        <span class="font-bold text-gray-800 font-mono">1234567890</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-gray-600 font-medium">Atas Nama</span>
                                        <span class="font-bold text-gray-800">PT Keystour Travel</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Bukti Pembayaran (for Transfer) -->
                        <div id="upload-bukti" class="hidden mb-6 animate-fadeIn">
                            <label for="image_bukti" class="block text-sm font-semibold text-gray-700 mb-3">
                                Upload Bukti Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-500 transition-colors">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                </div>
                                <input type="file" name="image_bukti" id="image_bukti" accept="image/*"
                                    class="hidden @error('image_bukti') border-red-500 @enderror">
                                <label for="image_bukti" class="cursor-pointer">
                                    <span class="text-green-600 font-semibold hover:text-green-700">Pilih File</span>
                                    <span class="text-gray-600"> atau drag & drop</span>
                                </label>
                                <p class="text-sm text-gray-500 mt-2">PNG, JPG, JPEG (Max. 2MB)</p>
                                <p id="file-name" class="text-sm text-gray-700 font-medium mt-3 hidden"></p>
                            </div>
                            @error('image_bukti')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cash Info -->
                        <div id="cash-info" class="hidden mb-6 animate-fadeIn">
                            <div
                                class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-6 border-2 border-yellow-300">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 mb-2">Informasi Pembayaran Cash</h4>
                                        <p class="text-gray-700">Silakan lakukan pembayaran cash kepada petugas kami di
                                            kantor.</p>
                                        <p class="text-gray-700 mt-2"><strong>Alamat:</strong> Jl. Contoh No. 123, Bandung
                                        </p>
                                        <p class="text-gray-700"><strong>Jam Operasional:</strong> Senin - Jumat, 09:00 -
                                            17:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl font-semibold text-lg hover:from-green-600 hover:to-emerald-700 transform hover:scale-[1.02] transition duration-200 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Selesaikan Pembayaran
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Butuh bantuan? Hubungi kami di
                    <a href="tel:+6281234567890" class="text-green-600 font-semibold hover:text-green-700">+62
                        812-3456-7890</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rekeningCard = document.getElementById('rekening-card');
            const uploadBukti = document.getElementById('upload-bukti');
            const cashInfo = document.getElementById('cash-info');
            const fileInput = document.getElementById('image_bukti');
            const fileName = document.getElementById('file-name');

            // Handle payment method radio buttons
            const paymentRadios = document.querySelectorAll('input[name="metode_pembayaran"]');

            function togglePaymentDetails() {
                const selectedMethod = document.querySelector('input[name="metode_pembayaran"]:checked');

                rekeningCard.classList.add('hidden');
                uploadBukti.classList.add('hidden');
                cashInfo.classList.add('hidden');

                if (selectedMethod) {
                    if (selectedMethod.value === 'transfer') {
                        rekeningCard.classList.remove('hidden');
                        uploadBukti.classList.remove('hidden');
                    } else if (selectedMethod.value === 'cash') {
                        cashInfo.classList.remove('hidden');
                    }
                }
            }

            paymentRadios.forEach(radio => {
                radio.addEventListener('change', togglePaymentDetails);
            });

            // Handle file upload display
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    fileName.textContent = '✓ ' + e.target.files[0].name;
                    fileName.classList.remove('hidden');
                } else {
                    fileName.classList.add('hidden');
                }
            });

            // Initial check
            togglePaymentDetails();
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        input[type="radio"]:checked~div {
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
        }
    </style>
@endpush
