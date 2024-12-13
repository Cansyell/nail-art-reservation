<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snail Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    {{--Google Font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body, html {
            overflow-x : hidden;
        }
        *{
            box-sizing : border-box;
        }
        .font-playfair{
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none !important;
            }
            .mobile-bottom-nav {
                display: flex !important;
            }
        }
        @media (min-width: 769px) {
            .mobile-bottom-nav {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-pink-50 min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white shadow-md py-4 px-4 md:px-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
        <img src="{{ asset('img/icon.svg')}}" style="width:50px;" class="m-auto"> 
            <h1 class="text-2xl font-bold text-pink-600 desktop-nav">Snail Studio</h1>
        </div>
            <div class="relative ml-auto mr-3">
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Search services..." 
                    class="pl-8 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                >
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
            </div>
        <div class="flex items-center space-x-4 desktop-nav">
            <div class="space-x-4 mr-4">
                <a href="#services" class="text-blue-500 hover:text-blue-700 transition">Services</a>
                <a href="#gallery" class="text-blue-500 hover:text-blue-700 transition">Gallery</a>
                <a href="#contact" class="text-blue-500 hover:text-blue-700 transition">Contact</a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div id="heroSection" class="flex-grow flex flex-col md:flex-row container mx-auto px-4 py-16">
        <div class="w-full md:w-1/2 md:pr-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-600 mb-6 font-playfair">
                Beautify Your Nails, Express Yourself
            </h2>
            <p class="text-base md:text-lg text-gray-700 mb-8">
                Discover unique nail art designs that showcase your personal style. 
                From elegant minimalist to bold and creative, we've got you covered.
            </p>
            <a href="#services" class="mx-auto md:mx-0 bg-blue-400 text-white px-6 py-3 rounded-full hover:bg-blue-500 transition">
                <i class="fas fa-heart mr-2"></i>
                Book Your Appointment
            </a>
        </div>
        
        <div class="w-full md:w-1/2 mt-8 md:mt-0">
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
            <div id="servicesContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($services as $s)
                <div class="service-item text-center bg-pink-50 p-6 rounded-lg shadow-sm flex flex-col">
                    <img src="{{ asset('img/icon.svg')}}" style="width:40px;" class="m-auto"> 
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">{{ $s->name }}</h4>
                    <img src="{{ Storage::url($s->photo)}}" alt="" class="mb-4 rounded-xl" style="height: 400px; width:100%">
                    <p class="text-gray-600 mb-4 text-justify">{{ $s->description }}</p>
                    <p class="text-gray-600 mb-4">Rp. {{ number_format($s->price, 00)}}</p>
                    <a href="{{ route('reservation', ['service' => $s->id]) }}" 
                       class="mt-auto bg-blue-400 text-white px-4 py-2 rounded-full hover:bg-blue-500 transition">
                        Book This Service
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-pink-200 py-6 text-center" id="contact">
        <p class="text-gray-700">© 2024 Snail Studio. All rights reserved.</p>
        <div class="mt-4 space-x-4">
            <a href="https://www.instagram.com/ns_esyaaa?igsh=MW85OGZ0Z3I2YnRscA==" class="text-blue-600 hover:text-blue-800"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

    {{-- Mobile Bottom Navigation --}}
    <div class="mobile-bottom-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg flex justify-around py-3 border-t border-gray-200" style="display: none;">
        <a href="#services" class="text-center text-gray-600 hover:text-blue-500">
            <i class="fas fa-brush text-xl"></i>
            <span class="block text-xs mt-1">Services</span>
        </a>
        <a href="#" class="text-center text-gray-600 hover:text-blue-500">
            <i class="fas fa-calendar-alt text-xl"></i>
            <span class="block text-xs mt-1">Booking</span>
        </a>
        <a href="#contact" class="text-center text-gray-600 hover:text-blue-500">
            <i class="fas fa-phone text-xl"></i>
            <span class="block text-xs mt-1">Contact</span>
        </a>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function(){
            const query = this.value.toLowerCase();
            const serviceItems = document.querySelectorAll('.service-item');
            const heroSection = document.getElementById('heroSection');

            let anyMatch = false;

            serviceItems.forEach(item => {
                const name = item.querySelector('h4').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();

                if(name.includes(query) || description.includes(query)){
                    item.style.display ='flex';
                    anyMatch = true;
                } else{
                    item.style.display ='none';
                }
            });

            heroSection.style.display = query ? 'none':'flex';
        });
    </script>
</body>
</html>