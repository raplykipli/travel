@extends('layouts.guest')

@section('title', 'Terima Kasih')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-2xl w-full">
            <!-- Success Animation Container -->
            <div class="text-center mb-8">
                <div class="inline-block relative">
                    <!-- Animated Circle Background -->
                    <div
                        class="w-32 h-32 bg-green-100 rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 animate-ping opacity-75">
                    </div>

                    <!-- Success Icon -->
                    <div
                        class="relative w-32 h-32 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center shadow-2xl animate-bounce-slow">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div
                class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-8 text-center">
                    <h1 class="text-5xl font-bold text-white mb-2 animate-fade-in">Terima Kasih!</h1>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-12 h-1 bg-white rounded-full"></div>
                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                        <div class="w-12 h-1 bg-white rounded-full"></div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 md:p-12">
                    @if (session('success'))
                        <div class="mb-6 p-6 bg-green-50 border-l-4 border-green-500 rounded-r-xl">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-lg text-gray-700 leading-relaxed">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="text-center space-y-6">
                        <!-- Main Message -->
                        <div class="space-y-3">
                            <p class="text-xl text-gray-700 leading-relaxed">
                                Pesanan Anda telah berhasil diterima dan sedang dalam proses verifikasi.
                            </p>
                            <p class="text-gray-600">
                                Kami akan segera memproses pemesanan Anda dan mengirimkan konfirmasi melalui WhatsApp/Email.
                            </p>
                        </div>

                        <!-- Info Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                            <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                                <div
                                    class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">Proses Cepat</p>
                                <p class="text-xs text-gray-600 mt-1">Maksimal 1x24 jam</p>
                            </div>

                            <div class="p-4 bg-purple-50 rounded-xl border border-purple-200">
                                <div
                                    class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">Notifikasi</p>
                                <p class="text-xs text-gray-600 mt-1">Via WhatsApp & Email</p>
                            </div>

                            <div class="p-4 bg-orange-50 rounded-xl border border-orange-200">
                                <div
                                    class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">Support 24/7</p>
                                <p class="text-xs text-gray-600 mt-1">Siap membantu Anda</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 mt-10">
                            <a href="{{ route('form-user.index') }}"
                                class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Pemesanan Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Simpan kode pemesanan Anda untuk referensi di masa mendatang
                </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endpush
