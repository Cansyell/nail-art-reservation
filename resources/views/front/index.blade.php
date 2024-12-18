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

    {{-- flowbite --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body, html {
            overflow-x : hidden;
            padding-bottom :2rem;
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
        .sort-filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .filter-price-container {
            display: flex;
            align-items: center;
            gap: 10px;
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
                src="{{ asset('/img/banner-nail.jpeg') }}" 
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
            
            {{-- New Sorting and Filtering Container --}}
            <div class="sort-filter-container">
                <div class="relative ml-auto mr-3">
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Search services..." 
                        class="pl-8 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                </div>
                
                <div class="filter-price-container">
                    <label for="priceFilter" class="text-gray-700">Sort by Price:</label>
                    <select id="priceFilter" class="px-3 py-2 border rounded-md">
                        <option value="default">Default</option>
                        <option value="low-to-high">Low to High</option>
                        <option value="high-to-low">High to Low</option>
                    </select>
                </div>
            </div>
            
            <div id="servicesContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($services as $s)
                <div class="service-item text-center bg-pink-50 p-6 rounded-lg shadow-sm flex flex-col" data-price="{{ $s->price }}">
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

    {{-- Gallery Carousel Section --}}
   <div id="gallery" class="py-16 bg-pink-50">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center text-pink-600 mb-10">
                Our Gallery
            </h3>
            
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/Nail-Gel-Medium.jpg') }}" 
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            alt="Nail Art Design 1">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/1.jpg') }}" 
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            alt="Nail Art Design 2">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/2.jpg') }}" 
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            alt="Nail Art Design 3">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/3.jpg') }}" 
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            alt="Nail Art Design 4">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/4.jpg') }}" 
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            alt="Nail Art Design 5">
                    </div>
                </div>
                
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-pink-200 py-6 text-center pb-20" id="contact">
        <p class="text-gray-700">© 2024 Snail Studio. All rights reserved.</p>
        <div class="mt-4 space-x-4">
            <a href="https://www.instagram.com/ns_esyaaa?igsh=MW85OGZ0Z3I2YnRscA==" class="text-blue-600 hover:text-blue-800"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

    {{-- Mobile Bottom Navigation --}}
    <div class=" mobile-bottom-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg flex justify-around py-3 border-t border-gray-200" style="display: none;">
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
         document.addEventListener('DOMContentLoaded', (event) => {
            const carousel = document.getElementById('carousel-inner');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dots = document.querySelectorAll('.carousel-dot');
            
            let currentIndex = 0;
            const totalItems = carouselItems.length;

            function updateCarousel() {
                carousel.style.transform = translateX(-${currentIndex * 100}%);
                
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-pink-600', index === currentIndex);
                    dot.classList.toggle('bg-gray-300', index !== currentIndex);
                });
            }

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            });

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    currentIndex = parseInt(dot.getAttribute('data-index'));
                    updateCarousel();
                });
            });

            setInterval(() => {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }, 5000);
        });   
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const serviceContainer = document.getElementById('servicesContainer');
            const searchInput = document.getElementById('searchInput');
            const priceFilter = document.getElementById('priceFilter');
            const serviceItems = document.querySelectorAll('.service-item');
            const heroSection = document.getElementById('heroSection');

            // Search Functionality
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                let anyMatch = false;

                serviceItems.forEach(item => {
                    const name = item.querySelector('h4').textContent.toLowerCase();
                    const description = item.querySelector('p:nth-of-type(1)').textContent.toLowerCase();

                    if (name.includes(query) || description.includes(query)) {
                        item.style.display = 'flex';
                        anyMatch = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                heroSection.style.display = query ? 'none' : 'flex';
            });

            // Price Sorting Functionality
            priceFilter.addEventListener('change', function() {
                const serviceArray = Array.from(serviceItems);
                
                serviceArray.sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price);
                    const priceB = parseFloat(b.dataset.price);

                    switch(this.value) {
                        case 'low-to-high':
                            return priceA - priceB;
                        case 'high-to-low':
                            return priceB - priceA;
                        default:
                            return 0;
                    }
                });

                // Clear and re-append sorted items
                serviceContainer.innerHTML = '';
                serviceArray.forEach(item => serviceContainer.appendChild(item));
            });
        });
    </script>
</body>
</html>
