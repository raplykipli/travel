@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>

        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin
                    </option>
                    <option value="owner" {{ old('role', $user->role ?? '') == 'owner' ? 'selected' : '' }}>Owner
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                @if (isset($user))
                    <p class="text-sm text-gray-500 mt-1">Leave blank to keep the current password.</p>
                @endif
            </div>

            <div class="flex w-full justify-between items-center">
                <a href="{{ route('users.index') }}" class="px-2 py-2 bg-gray-400 rounded-md">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ isset($user) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
@endsection
