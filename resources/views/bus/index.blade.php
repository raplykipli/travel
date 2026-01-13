@extends('layouts.app')

@section('title', 'Bus Management')
@section('subtitle', 'Manage your fleet')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Bus Management</h1>
            <a href="{{ route('bus.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Bus</a>
        </div>

        <div class="mb-4">
            <form action="{{ route('bus.index') }}" method="GET">
                <div class="flex">
                    <input type="text" name="search" placeholder="Search Bus..." value="{{ $search ?? '' }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">Plat Nomor</th>
                    <th class="px-6 py-3 text-left">Jumlah Kursi</th>
                    <th class="px-6 py-3 text-left">Jenis Bus</th>
                    <th class="px-6 py-3 text-left">Image</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buses as $bus)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $bus->plat_nomor }}</td>
                        <td class="px-6 py-4">{{ $bus->jumlah_kursi }}</td>
                        <td class="px-6 py-4">{{ $bus->jenis_bus }}</td>
                        <td class="px-6 py-4">
                            @if ($bus->image)
                                <img src="{{ asset('storage/' . $bus->image) }}" alt="Bus Image"
                                    class="w-16 h-16 object-cover">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('bus.edit', $bus->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('bus.destroy', $bus->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $buses->appends(['search' => $search ?? ''])->links() }}
        </div>
    </div>
@endsection
