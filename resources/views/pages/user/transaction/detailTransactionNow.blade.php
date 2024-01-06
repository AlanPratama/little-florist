@extends('layouts.user')

@section('title', 'Homepage')

@section('content')

    <div class="w-full flex justify-center items-center" style="margin-top: 100px;">
        <div class="relative flex lg:flex-row flex-col lg:justify-between justify-start lg:items-start items-start"
            style="width: 85%;">
            @php
                $totalPrice = 0;
            @endphp
            <div class="lg:w-1/2 w-full">
                    <div
                        class="flex flex-col m-2 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover rounded-t-lg md:h-auto md:w-48 w-44 md:rounded-none md:rounded-s-lg"
                            src="{{ $product->image_asset == 'YA' ? asset('assets/' . $product->image) : $product->image }}"
                            alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                Rp {{ number_format($product->price_after) }} - Jumlah: {{ $sold }}
                            </p>

                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                @php
                                    $total = $product->price_after * $sold;
                                    $totalPrice += $total;
                                @endphp
                                Total: {{ number_format($total) }}
                            </p>

                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                                style="
                            overflow: hidden;
                            display: -webkit-box;
                            -webkit-line-clamp: 3; /* number of lines to show */
                                    line-clamp: 2;
                            -webkit-box-orient: vertical;

                            ">
                                {{ $product->description }}</p>
                        </div>
                    </div>
            </div>


            <div
                class="w-full m-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <ul class="flex justify-between text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
                    id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                    <li class="w-1/2">
                        <button id="detail-tab" data-tabs-target="#detail" type="button" role="tab"
                            aria-controls="detail" aria-selected="true"
                            class="inline-block w-full p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Detail</button>
                    </li>
                    <li class="w-1/2">
                        <button id="informasi-tab" data-tabs-target="#informasi" type="button" role="tab"
                            aria-controls="informasi" aria-selected="false"
                            class="inline-block w-full  p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Informasi</button>
                    </li>
                    {{-- <li class="me-2">
                        <button id="alamat-tab" data-tabs-target="#alamat" type="button" role="tab"
                            aria-controls="alamat" aria-selected="false"
                            class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Alamat</button>
                    </li> --}}
                </ul>

                <div id="defaultTabContent">
                    <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="detail" role="tabpanel"
                        aria-labelledby="detail-tab">
                        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Detail
                            Transaksi</h2>
                            <p class="flex justify-start items-center gap-1 mb-3 text-gray-500 dark:text-gray-400">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                @php
                                    $totalHarga = $product->price_after * $sold;
                                @endphp
                                <span class="font-semibold">{{ $product->name }}:</span> Rp {{ number_format($totalHarga) }}
                                ({{ $sold }} PCS)
                            </p>
                        <hr style="height: 2px" class="my-2 bg-gray-400 border-0 dark:bg-gray-700">
                        <p class="text-xl mb-3 text-gray-500 dark:text-gray-400">
                            <span class="font-bold">TOTAL HARGA: </span> Rp {{ number_format($totalPrice) }}
                        </p>

                        {{-- <p class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                            Selanjutnya
                            <svg class=" w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                        </p> --}}

                    </div>

                    {{-- PESAN PESAN PESAN --}}
                    <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="informasi" role="tabpanel"
                        aria-labelledby="informasi-tab">
                        <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Information
                            Input</h2>
                        <!-- List -->

                        <form action="{{ route('transaction.order.now') }}" method="post">
                            @csrf

                            <input type="hidden" name="product" value="{{ $product->slug }}">
                            <input type="hidden" name="sold" value="{{ $sold }}">

                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                                    <div
                                        class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                                        <h3>Message</h3>
                                    </div>
                                </div>
                                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                                    <label for="editor" class="sr-only">Message</label>
                                    <textarea id="editor" rows="2" name="message"
                                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Varian warna Bunga-nya berwarna merah ya..."></textarea>
                                </div>
                            </div>

                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                                    <div
                                        class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                                        <h3>Alamat Lengkap</h3>
                                    </div>
                                </div>
                                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                                    <label for="editor" class="sr-only">Alamat Lengkap</label>
                                    <textarea id="editor" rows="3" name="address"
                                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Masukkan alamat lengkap..." required></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Pesan
                            </button>
                        </form>

                    </div>


                    {{-- ALAMAT ALAMAT ALAMAT --}}
                    {{-- <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="alamat" role="tabpanel"
                        aria-labelledby="alamat-tab">
                        <dl
                            class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Developers</dd>
                            </div>
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Public repositories</dd>
                            </div>
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Open source projects</dd>
                            </div>
                        </dl>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
@endsection
