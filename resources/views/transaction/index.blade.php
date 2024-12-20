<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-200 uppercase bg-pink-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Reservation ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Service
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total 
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Method
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Paid Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction as $t)
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                            
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            000{{ $t->reservation_id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $t->reservations->customer_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->service->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->total_amount }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->payment_status}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->payment_method}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->updated_at}}
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