@extends('layouts.app')

@section('title', isset($bus) ? 'Edit Bus' : 'Create Bus')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ isset($bus) ? 'Edit Bus' : 'Create Bus' }}</h1>

        <form action="{{ isset($bus) ? route('bus.update', $bus->id) : route('bus.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($bus))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="plat_nomor" class="block text-gray-700">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor"
                    value="{{ old('plat_nomor', $bus->plat_nomor ?? '') }}"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                @error('plat_nomor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_kursi" class="block text-gray-700">Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" id="jumlah_kursi"
                    value="{{ old('jumlah_kursi', $bus->jumlah_kursi ?? '') }}"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                @error('jumlah_kursi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_bus" class="block text-gray-700">Jenis Bus</label>
                <select name="jenis_bus" id="jenis_bus" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">

                    <option value="">-- Pilih Jenis Bus --</option>
                    <option value="Mini Bus" {{ old('jenis_bus', $bus->jenis_bus ?? '') == 'Mini Bus' ? 'selected' : '' }}>
                        Mini Bus
                    </option>
                    <option value="Medium Bus"
                        {{ old('jenis_bus', $bus->jenis_bus ?? '') == 'Medium Bus' ? 'selected' : '' }}>
                        Medium Bus
                    </option>
                    <option value="Big Bus" {{ old('jenis_bus', $bus->jenis_bus ?? '') == 'Big Bus' ? 'selected' : '' }}>
                        Big Bus
                    </option>
                </select>

                @error('jenis_bus')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="image" class="block text-gray-700">Gambar Bus</label>
                <input type="file" name="image" id="image"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @if (isset($bus) && $bus->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $bus->image) }}" alt="Bus Image" class="w-32 h-32 object-cover">
                    </div>
                @endif
            </div>

            <div class="flex w-full justify-between items-center">
                <a href="{{ route('bus.index') }}" class="px-2 py-2 bg-gray-400 rounded-md">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ isset($bus) ? 'Update' : 'Create' }}</button>
            </div>

        </form>
    </div>
@endsection
