@extends('layouts.admin')


@section('title', 'Produk')

@section('content')


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>
                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <span class="sr-only">Action button</span>
                    Filter
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <form id="dropdownAction"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <button type="submit" name="filter" value="terlaris"
                                class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Terlaris</button>
                        </li>
                        <li>
                            <button type="submit" name="filter" value="stokTerbanyak"
                                class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Stock
                                Terbanyak</button>
                        </li>
                    </ul>
                </form>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <form class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users" name="nama"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari produk...">
            </form>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{-- // name, price_before, price_After, stock, sold, decription --}}
                    <th scope="col" class="p-4">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Sebelum
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Sesudah
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stok
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sold
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($products->count() > 0)
                    @foreach ($products as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                {{ $loop->iteration }}
                            </td>
                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full"
                                    src="{{ $item->image_asset == 'YA' ? asset('assets/' . $item->image) : $item->image }}"
                                    alt="produk">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $item->name }}</div>
                                    {{-- <div class="font-normal text-gray-500">{{  }}</div> --}}
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                Rp{{ number_format($item->price_before) }}
                            </td>
                            <td class="px-6 py-4">
                                Rp {{ number_format($item->price_after) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->stock }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->sold }}
                            </td>

                            <td class="px-6 py-4 flex justify-center items-center gap-1">
                                <a href="{{ url('/produk/' . $item->slug) }}"
                                    class="font-medium flex justify-center items-center w-auto text-white bg-blue-500 px-1 py-1.5 rounded dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button type="button" data-modal-target="{{ $item->slug }}-modal"
                                    data-modal-toggle="{{ $item->slug }}-modal"
                                    class="font-medium flex justify-center items-center w-auto text-white bg-green-500 px-1 py-1.5 rounded dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-gear"></i>
                                </button>

                                <!-- Main modal -->
                                <div id="{{ $item->slug }}-modal" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $item->name }}
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="{{ $item->slug }}-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5"
                                                action="{{ route('product.edit', ['slug' => $item->slug]) }}"
                                                method="post">
                                                @method('put')
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                                        <input type="text" name="name" id="name"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="{{ $item->name }}"
                                                            value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="category"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                                        <input type="number" name="stock" id="stock"
                                                            value="{{ $item->stock }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="99" required>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                                            Sebelum</label>
                                                        <input type="number" name="price_before" id="price_before"
                                                            value="{{ $item->price_before }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="100000" required>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="category"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                                            Sesudah</label>
                                                        <input type="number" name="price_after" id="price_after"
                                                            value="{{ $item->price_after }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="100000" required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                                            Produk</label>
                                                        <textarea id="description" rows="4" name="description"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Write product description here">{{ $item->description }}</textarea>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- END MODAL --}}

                                </div>


                            </td>

                        </tr>
                    @endforeach
                @else
                @endif

            </tbody>
        </table>
    </div>

@endsection
