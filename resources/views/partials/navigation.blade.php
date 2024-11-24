<section class="bg-gray-900 text-white">
    <nav class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="text-lg font-bold">EM</div>
        <div class="md:hidden">
            <button class="text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <ul class="hidden md:flex space-x-6">
            <li>
                <a href="/events" class="text-gray-300 hover:text-white hover:underline transition duration-300">Events</a>
            </li>
            <li>
                <a href="/bookings" class="text-gray-300 hover:text-white hover:underline transition duration-300">Bookings</a>
            </li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300" onclick="return confirm('Are you sure you want to log out?')">
                            Sign Out
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white hover:underline transition duration-300">Login</a>
                </li>
            @endauth
        </ul>
    </nav>
</section>
