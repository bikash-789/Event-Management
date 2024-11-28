@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-semibold text-gray-700 mb-6">Forgot Your Password?</h2>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Send Password Reset Link
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Remembered your password? <a href="{{ route('v1.login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
