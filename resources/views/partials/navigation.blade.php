<section class="bg-gray-900 text-white">
    <nav class="container mx-auto flex justify-between items-center py-4 px-6">
        <a class="text-xl font-bold" href="/v1">EM</a>
        <div class="md:hidden">
            <button class="text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <ul class="hidden md:flex space-x-6">
            <li>
                <a href="/v1/events" class="text-gray-300 hover:text-white hover:underline transition duration-300">Events</a>
            </li>
            <li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="/v1/bookings" class="text-gray-300 hover:text-white hover:underline transition duration-300">All Bookings</a>
                @elseif(auth()->check())
                    <a href="/v1/bookings/user" class="text-gray-300 hover:text-white hover:underline transition duration-300">My Bookings</a>
                @else
                    <a href="/v1/login" class="text-gray-300 hover:text-white hover:underline transition duration-300">Login to View Bookings</a>
                @endif
            </li>
            <li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('v1.users') }}" class="text-gray-300 hover:text-white hover:underline transition duration-300">
                        Manage Users
                    </a>
                @endif
            </li>
            @auth
                <li>
                    <form action="{{ route('v1.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300" onclick="return confirm('Are you sure you want to log out?')">
                            Sign Out
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('v1.login') }}" class="text-gray-300 hover:text-white hover:underline transition duration-300">Login</a>
                </li>
            @endauth
        </ul>
    </nav>
</section>
