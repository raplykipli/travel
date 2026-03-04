@extends('layouts.app')

@section('title', 'User Management')
@section('subtitle', 'Manage your users')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">User Management</h1>
            <a href="{{ route('users.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-md">Create User</a>
        </div>

        <div class="mb-4">
            <form action="{{ route('users.index') }}" method="GET">
                <div class="flex">
                    <input type="text" name="search" placeholder="Search users..." value="{{ $search ?? '' }}"
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

        <table class="w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->role == 'admin')
                                <span class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $user->role }}</span>
                            @else
                                <span class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $user->role }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-red-500 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block ml-4">
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
            {{ $users->appends(['search' => $search ?? ''])->links() }}
        </div>
    </div>
@endsection

