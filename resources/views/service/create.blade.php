<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- form --}}
                    
                    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
                            @csrf
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="name" id="name" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-5">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea name="description" id="description"  rows="2" class="block p-4 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" ></textarea>
                            </div>
                            <div class="mb-5">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-5">
                                <label for="duration_minutes" class="block mb-2 text-sm font-medium text-gray-900">Duration (minutes)</label>
                                <input type="number" name="duration_minutes" id="duration_minutes" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-5">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select a Category</label>
                                <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    <option selected disabled value="">Choose a category</option>
                                    <option value="manicure">Manicure</option>
                                    <option value="pedicure">Pedicure</option>
                                    <option value="nail_art">Nail Art</option>
                                    <option value="treatment">Treatment</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900">Service Photo</label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Submit</button>
                        </form>
                    {{-- end form --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>