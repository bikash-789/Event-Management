@extends('layouts.main')

@section('content')
<div class="bg-gray-50 text-gray-800">
    <section class="bg-blue-700 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Event Management App</h1>
            <p class="text-lg mb-6">Your one-stop platform for managing events and bookings with ease.</p>
            <a href="/v1/events" class="px-6 py-3 bg-blue-500 rounded-lg hover:bg-blue-600 text-white font-semibold">View Events</a>
            <a href="/v1/bookings" class="ml-4 px-6 py-3 border border-white rounded-lg hover:bg-gray-100 hover:text-blue-700">View Bookings</a>
        </div>
    </section>
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-8">Why Choose Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <img src="/images/easy-to-use.jpg" alt="Easy to Use" class="mx-auto h-16 mb-4">
                    <h3 class="text-xl font-bold mb-2">Easy to Use</h3>
                    <p class="text-gray-600">Intuitive platform with a clean design to help you manage bookings effortlessly.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <img src="/images/secure.jpeg" alt="Secure" class="mx-auto h-16 mb-4">
                    <h3 class="text-xl font-bold mb-2">Secure</h3>
                    <p class="text-gray-600">Your data is protected with top-notch security measures.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <img src="/images/24x7.jpg" alt="Support" class="mx-auto h-16 mb-4">
                    <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our team is available around the clock to assist you.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-semibold mb-4">Ready to Get Started?</h2>
            <p class="text-gray-600 mb-6">Sign up today and take control of your events and bookings!</p>
            @auth
                <a href="/v1/events" class="px-6 py-3 bg-blue-500 rounded-lg hover:bg-blue-600 text-white font-semibold">Get Started</a>
            @else
                <a href="/v1/register" class="px-6 py-3 bg-blue-500 rounded-lg hover:bg-blue-600 text-white font-semibold">Get Started</a>
            @endauth
        </div>
    </section>
</div>
@endsection
