<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NailGlow Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-brush text-pink-400 text-2xl"></i>
            <h1 class="text-2xl font-bold text-pink-600">NailGlow Studio</h1>
        </div>
        <div class="space-x-4">
            <a href="#services" class="text-blue-500 hover:text-blue-700 transition">Services</a>
            <a href="#gallery" class="text-blue-500 hover:text-blue-700 transition">Gallery</a>
            <a href="#contact" class="text-blue-500 hover:text-blue-700 transition">Contact</a>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div class="flex-grow flex items-center container mx-auto px-4 py-16">
        <div class="w-1/2 pr-10">
            <h2 class="text-4xl font-bold text-pink-600 mb-6">
                Beautify Your Nails, Express Yourself
            </h2>
            <p class="text-lg text-gray-700 mb-8">
                Discover unique nail art designs that showcase your personal style. 
                From elegant minimalist to bold and creative, we've got you covered.
            </p>
            <button class="bg-blue-400 text-white px-6 py-3 rounded-full hover:bg-blue-500 transition flex items-center">
                <i class="fas fa-heart mr-2"></i>
                Book Your Appointment
            </button>
        </div>
        
        <div class="w-1/2">
            <img 
                src="{{ asset('/img/banner nail.jpeg') }}" 
                alt="Nail Art Design" 
                class="rounded-lg shadow-lg w-full h-auto object-cover"
            >
        </div>
    </div>

    {{-- Services Section --}}
    <div id="services" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center text-pink-600 mb-10">
                Our Services
            </h3>
            <div class="grid grid-cols-3 gap-8">
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-brush mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Classic Manicure</h4>
                    <img src="{{ asset('img/Manicure.jpg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Perfect shape and polish</p>
                </div>
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-brush mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Classic Pedicure</h4>
                    <img src="{{ asset('img/Pedicure.jpg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Perfect shape and polish</p>
                </div>
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-heart mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Menicure & Pedicure</h4>
                    <img src="{{ asset('/img/Manicure dan Pedicure.jpg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Long-lasting, chip-free finish</p>
                </div>
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-cut mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Nail Gel Basic</h4>
                    <img src="{{ asset('/img/Nailart basic.jpeg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Custom creative designs</p>
                </div>
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-heart mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Nail Gel Medium</h4>
                    <img src="{{ asset('/img/Nail Gel Medium.jpg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Long-lasting, chip-free finish</p>
                </div>
                <div class="text-center bg-pink-50 p-6 rounded-lg shadow-sm">
                    <i class="fas fa-heart mx-auto text-blue-400 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Nail Gel Premium</h4>
                    <img src="{{ asset('/img/Nail Gel Hard.jpg')}}" alt="" style="height: 400px; width:100vw">
                    <p class="text-gray-600">Long-lasting, chip-free finish</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Reservation Section --}}
    <div id="reservation" class="bg-pink-100 py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center text-pink-600 mb-10">
                Book Your Appointment
            </h3>
            <form class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="service" class="block text-gray-700 mb-2">Service</label>
                    <select 
                        id="service" 
                        name="service" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required
                    >
                        <option value="">Select a Service</option>
                        <option value="classic">Classic Manicure</option>
                        <option value="art">Nail Art Design</option>
                        <option value="gel">Gel Manicure</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 mb-2">Preferred Date</label>
                    <input 
                        type="date" 
                        id="date" 
                        name="date" 
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