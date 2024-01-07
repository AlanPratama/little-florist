@extends('layouts.admin')


@section('title', 'Diproses')

@section('content')


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>
                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <span class="sr-only">Action button</span>
                    Action
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAction"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                account</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                            User</a>
                    </div>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pembeli
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kode
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deadline
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Status
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($dikirim->count() > 0)

                    @foreach ($dikirim->groupBy('code') as $code => $item)
                        @php
                            $firstItem = $item->first();
                            $totalPrice = $item->sum('total_price');
                        @endphp
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                {{ $loop->iteration }}
                            </td>
                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="">
                                    <div class="text-base font-semibold">{{ $firstItem->users->name }}</div>
                                    <div class="font-normal text-gray-500">{{ $firstItem->users->phone }} -
                                        {{ $firstItem->users->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $firstItem->code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($firstItem->date)->format('d F Y') }} -
                                {{ $firstItem->created_at->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($firstItem->date_end)->format('d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp {{ number_format($totalPrice) }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div> {{ $firstItem->status }}
                                </div>
                            </td> --}}
                            <td class="px-6 py-4 flex justify-center items-center gap-1">
                                <a href="{{ url('/transaksi/diproses/'.$firstItem->code) }}" class="font-medium flex justify-center items-center w-auto text-white bg-blue-500 px-1 py-1.5 rounded dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="#" class="font-medium flex justify-center items-center w-auto text-white bg-green-500 px-1 py-1.5 rounded dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-gear"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                @endif

            </tbody>
        </table>
    </div>

@endsection
