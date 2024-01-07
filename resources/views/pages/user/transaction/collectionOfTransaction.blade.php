@extends('layouts.user')

@section('title', 'Homepage')

@section('content')

    <div class="w-full flex justify-center items-center" style="margin-top: 110px;">
        <div style="width: 85%;" class="flex flex-col justify-center items-center">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Belum Bayar</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">Diproses</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Dikirim</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Selesai</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden flex flex-wrap justify-evenly items-center gap-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    @if ($belumBayar->count() > 0)
                        @php
                            $arrayBelumBayar = [];
                        @endphp
                        @foreach ($belumBayar as $item)
                            @if (!in_array($item->code, $arrayBelumBayar))
                                @php
                                    $arrayBelumBayar[] = $item->code;
                                @endphp

                                <div
                                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        <img class="rounded-t-lg"
                                            src="{{ $item->products->image_asset == 'YA' ? asset('assets/' . $item->products->image) : $item->products->image }}"
                                            alt="" />
                                    </a>
                                    <div class="p-5">
                                        <a href="#">
                                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $item->code }}</h5>
                                        </a>
                                        <div
                                            class="flex justify-between items-center mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            <p>{{ $item->date }}</p>

                                        </div>
                                        <a href="{{ url('/transaksi/belum-bayar/' . $item->code) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Lihat
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset('assets/data/no-data.jpg') }}" class="w-48" alt="no-data">
                            <p>TIDAK ADA DATA TRANSAKSI</p>
                        </div>
                    @endif
                </div>




                {{-- DIPROSES --}}
                <div class="hidden flex flex-wrap justify-evenly items-center gap-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    @if ($diproses->count() > 0)
                        @php
                            $arrayDiproses = [];
                        @endphp
                        @foreach ($diproses as $item)
                            @if (!in_array($item->code, $arrayDiproses))
                                @php
                                    $arrayDiproses[] = $item->code;
                                @endphp

                                <div
                                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        <img class="rounded-t-lg"
                                            src="{{ $item->products->image_asset == 'YA' ? asset('assets/' . $item->products->image) : $item->products->image }}"
                                            alt="" />
                                    </a>
                                    <div class="p-5">
                                        <a href="#">
                                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $item->code }}</h5>
                                        </a>
                                        <div
                                            class="flex justify-between items-center mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            <p>{{ $item->date }}</p>

                                        </div>
                                        <a href="{{ url('/transaksi/diproses/' . $item->code) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Lihat
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset('assets/data/no-data.jpg') }}" class="w-48" alt="no-data">
                            <p>TIDAK ADA DATA TRANSAKSI</p>
                        </div>
                    @endif
                </div>


                {{-- DIKIRIM --}}
                {{-- <div class="hidden flex flex-wrap justify-evenly items-center gap-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    @if ($dikirim->count() > 0)
                        @php
                            $arrayDikirim = [];
                        @endphp
                        @foreach ($dikirim as $item)
                            @if (!in_array($item->code, $arrayDikirim))
                                @php
                                    $arrayDikirim[] = $item->code;
                                @endphp

                                <div
                                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        <img class="rounded-t-lg"
                                            src="{{ $item->products->image_asset == 'YA' ? asset('assets/' . $item->products->image) : $item->products->image }}"
                                            alt="" />
                                    </a>
                                    <div class="p-5">
                                        <a href="#">
                                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $item->code }}</h5>
                                        </a>
                                        <div
                                            class="flex justify-between items-center mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            <p>{{ $item->date }}</p>

                                        </div>
                                        <a href="{{ url('/transaksi/diproses/' . $item->code) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Lihat
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset('assets/data/no-data.jpg') }}" class="w-48" alt="no-data">
                            <p>TIDAK ADA DATA TRANSAKSI</p>
                        </div>
                    @endif
                </div> --}}



                {{-- SELESAI --}}
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                    aria-labelledby="settings-tab">
                    @if ($selesai->count() > 0)
                    @php
                    $arraySelesai = [];
                @endphp
                @foreach ($selesai as $item)
                    @if (!in_array($item->code, $arraySelesai))
                        @php
                            $arraySelesai[] = $item->code;
                        @endphp

                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="{{ $item->products->image_asset == 'YA' ? asset('assets/' . $item->products->image) : $item->products->image }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $item->code }}</h5>
                                </a>
                                <div
                                    class="flex justify-between items-center mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <p>{{ $item->date }}</p>

                                </div>
                                <a href="{{ url('/transaksi/belum-bayar/' . $item->code) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Lihat
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach

                    @else
                    <div class="flex flex-col justify-center items-center">
                        <img src="{{ asset('assets/data/no-data.jpg') }}" class="w-48" alt="no-data">
                        <p>TIDAK ADA DATA TRANSAKSI</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
