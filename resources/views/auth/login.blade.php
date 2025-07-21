@extends('layouts.guest', ['title' => 'Login Admin'])

@section('title', 'Masuk ke Halaman Admin')

@section('content')
    <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat Email</label>
            <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                   placeholder="Masukkan alamat email"
                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required
                   placeholder="Masukkan password"
                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Login
            </button>
        </div>
    </form>
@endsection

@section('navigation-link')
    Belum punya akun?
    <a href="{{ route('register') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Mulai dari sini</a>
@endsection