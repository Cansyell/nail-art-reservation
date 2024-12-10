<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- table --}}

                    @if ($errors->any())
                        <div class="mb-5 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Customer Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Customer Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Reservation Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Notes
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Service 
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservation as $r)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $r->customer_name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $r->customer_email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $r->customer_phone}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $r->reservation_date}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $r->status}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $r->notes}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $r->service_id}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    {{-- end table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>