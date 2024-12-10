<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction') }}
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
                                            Reservation ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Service
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Discount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Final Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Method
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction as $t)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $t->reservation_id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $t->service->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->total_amount }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->discount}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->final_amount}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->payment_status}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->payment_method}}
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