<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Snail Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-brush text-pink-400 text-2xl"></i>
            <h1 class="text-2xl font-bold text-pink-600">Snail Studio</h1>
        </div>
        <div class="space-x-4">
            <a href="{{ route('front.index') }}" class="text-blue-500 hover:text-blue-700 transition">Home</a>
        </div>
    </nav>

    {{-- Reservation Section --}}
    <div id="reservation" class="flex-grow bg-pink-100 py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center text-pink-600 mb-10">
                Book Your Appointment
            </h3>
            @if ($errors->any())
            <div class="max-w-md mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops! Something went wrong.</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
             @endif
            <form action="{{ route('book.appointment') }}" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                @csrf
                <input 
                    type="hidden" 
                    name="service_id" 
                    value="{{ $selectedService->id }}"
                >
                <div class="mb-4">
                    <label for="customer_name" class="block text-gray-700 mb-2">Name</label>
                    <input 
                        type="text" 
                        id="customer_name" 
                        name="customer_name" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="customer_phone" class="block text-gray-700 mb-2">Phone Number</label>
                    <input 
                        type="tel" 
                        id="customer_phone" 
                        name="customer_phone" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="customer_email" class="block text-gray-700 mb-2">Email</label>
                    <input 
                        type="tel" 
                        id="customer_email" 
                        name="customer_email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="service" class="block text-gray-700 mb-2">Selected Service</label>
                    <input 
                        type="text" 
                        id="service" 
                        value="{{ $selectedService->name }} - {{ $selectedService->price }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"
                        readonly
                    >
                </div>
                <div class="mb-4">
                    <label for="reservation_date" class="block text-gray-700 mb-2"> Reservation Date</label>
                    <input 
                        type="datetime-local" 
                        id="reservation_date" 
                        name="reservation_date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 mb-2"> Notes </label>
                    <input 
                        type="text" 
                        id="notes" 
                        name="notes" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-400 text-white py-3 rounded-full hover:bg-blue-500 transition"
                >
                    Schedule Appointment
                </button>
            </form>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-pink-200 py-6 text-center">
        <p class="text-gray-700">© 2024 NailGlow Studio. All rights reserved.</p>
        <div class="mt-4 space-x-4">
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>
</body>
</html>