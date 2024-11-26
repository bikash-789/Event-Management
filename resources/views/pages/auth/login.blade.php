@extends('layouts.main')

@section('content')
    <div class="mx-auto px-4 py-16 w-[29rem] h-[100vh]">
        <div class="max-w-sm mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-4xl font-extrabold text-center text-gray-900 py-6">Login</h2>
            <div class="mb-6">
                <a href="/v1/auth/google/redirect" 
                   class="flex items-center justify-center w-full py-3 border border-gray-300 rounded-md hover:bg-gray-100 transition duration-300">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="logo" class="w-6 h-6 mr-3">
                    <span class="text-sm font-semibold text-gray-700">Sign in with Google</span>
                </a>
            </div>
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-3 text-sm text-gray-500">or</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
            <form action="{{ route('v1.login.post') }}" method="POST" class="p-4">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Your email address">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Your password">
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('v1.forgotpassword') }}" class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">Forgot your password?</a>
                </div>
                <button type="submit" 
                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    Login
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="{{ route('v1.register') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Create an account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
