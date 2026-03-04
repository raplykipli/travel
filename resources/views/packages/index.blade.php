@extends('layouts.app')

@section('title', 'Tour Packages')
@section('subtitle', 'Manage your tour packages')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Tour Packages</h1>
            <a href="{{ route('packages.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-md">Create Package</a>
        </div>

        <div class="mb-4">
            <form action="{{ route('packages.index') }}" method="GET">
                <div class="flex">
                    <input type="text" name="search" placeholder="Search Tour..." value="{{ $search ?? '' }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                    <button type="submit" class="ml-2 px-4 py-2 bg-red-500 text-white rounded-md">Search</button>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama Paket</th>
                        <th class="px-6 py-3 text-left">Destinasi</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $package->nama_paket }}</td>
                            <td class="px-6 py-4">{{ $package->destinasi }}</td>
                            <td class="px-6 py-4">{{ 'Rp ' . number_format($package->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($package->status == 'aktif')
                                    <span
                                        class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $package->status }}</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $package->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('packages.edit', $package->id) }}"
                                    class="text-red-500 hover:underline">Edit</a>
                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                                    class="inline-block ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $packages->appends(['search' => $search ?? ''])->links() }}
        </div>
    </div>
@endsection

