<div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg rounded-lg p-6 w-64">
    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $title }}</h2>
    <p class="text-sm text-gray-700 mb-4 text-justify">{{ $description }}</p>
    <div class="text-blue-600 font-medium">
        {{ $slot }}
    </div>
</div>
