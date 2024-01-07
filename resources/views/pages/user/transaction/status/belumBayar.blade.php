@extends('layouts.user')

@section('title', 'Belum Bayar')

@section('content')

    <style>
        .smHidden {
            display: inline-block;
        }

        @media(max-width: 640px) {
            .smHidden {
                display: none;
            }
        }
    </style>

    <div class="w-full flex justify-center items-center" style="margin: 110px 0px;">
        <div class="flex flex-col justify-center items-start" style="width: 85%;">
            <ol
                class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li
                    class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <i class="fa-solid fa-credit-card w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5"></i>
                        Belum <span class="hidden sm:inline-flex sm:ms-2">Bayar</span>
                    </span>
                </li>
                <li
                    class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <i class="fa-solid fa-book-open-reader w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5"></i>
                        Sedang <span class="hidden sm:inline-flex sm:ms-2">Diproses</span>
                    </span>
                </li>
                <li
                    class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <i class="fa-solid fa-truck-fast w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5"></i>
                        Sedang <span class="hidden sm:inline-flex sm:ms-2">Dikirim</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Selesai
                </li>
            </ol>
            @php
            $lala = [];
            $grandPrice = 0;
        @endphp
        @foreach ($transaction as $item)
            @if (!in_array($item->code, $lala))
                @php
                    $lala[] = $item->code;
                @endphp
                <div class="flex flex-wrap w-full justify-between items-center pb-2" style="margin-top: 25px; border-bottom: 2px solid #999;">
                    <div class="">
                        <span class="font-semibold text-xl">Kode:</span> {{ $item->code }}
                    </div>

                    <div class="">
                        @if (Auth::user()->role == 'Admin')
                            <button type="button"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-semibold rounded-lg text-sm px-3 py-2 text-center"
                                data-modal-target="accept-modal" data-modal-toggle="accept-modal">Accept</button>
                            <!-- Main modal -->
                            <div id="accept-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Kode: {{ $item->code }}
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="accept-modal">
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
                                        <div class="p-4 md:p-5">
                                            <form class="space-y-4"
                                                action="{{ route('transaction.process', ['code' => $item->code]) }}"
                                                method="POST">
                                                @csrf
                                                <div>
                                                    <label for="email"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                        Selesai</label>
                                                    <input type="date" name="date_end" id="date_end"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Tanggal Selesai" required>
                                                </div>
                                                <button type="submit"
                                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <button type="button"
                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-semibold rounded-lg text-sm px-3 py-2 text-center"
                            onclick="event.preventDefault(); cancelTransaction('{{ $item->code }}');">Cancel</button>

                        <script>
                            function cancelTransaction(transaction) {
                                Swal.fire({
                                    title: 'Apakah Anda yakin ?',
                                    text: 'Anda tidak dapat mengembalikan ini!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Hapus',
                                    confirmButtonColor: '#ff3d41',
                                    cancelButtonText: 'Batal',
                                    cancelButtonColor: '#8fcc34',
                                }).then((result) => {
                                    if (result.isConfirmed || result.status == 200) {
                                        axios.delete(`/cancelTransaction/${transaction}`)
                                            .then(response => {
                                                let timerInterval;
                                                Swal.fire({
                                                    title: "BERHASIL!",
                                                    html: "TRANSACTION DIBATALKAN!",
                                                    timer: 1000,
                                                    icon: 'success',
                                                    timerProgressBar: true,
                                                    didOpen: () => {
                                                        Swal.showLoading();
                                                        const timer = Swal.getPopup().querySelector("b");
                                                        timerInterval = setInterval(() => {
                                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                                        }, 100);
                                                    },
                                                    willClose: () => {
                                                        clearInterval(timerInterval);
                                                    }
                                                }).then((result) => {
                                                    if (result.dismiss === Swal.DismissReason.timer) {
                                                        window.location.href = '/produk';
                                                    }
                                                    window.location.href = '/produk';
                                                });
                                            })
                                            .catch(error => {
                                                console.error(error);
                                                window.location.reload(true);

                                            });
                                    }
                                });
                            }
                        </script>
                    </div>

                    <div class="">
                        <span class="font-semibold text-xl">Tanggal:</span> {{ $item->date }}
                    </div>
                </div>

            @endif
        @endforeach

            <div class="colReverse">


                @foreach ($transaction as $index => $item)
                    @php
                        $grandPrice += $item->total_price;
                    @endphp
                    <div
                        class="w-full my-2 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover rounded-t-lg h-auto md:h-auto w-32 md:rounded-none md:rounded-s-lg"
                            src="{{ $item->products->image_asset == 'YA' ? asset('assets/' . $item->products->image) : $item->products->image }}"
                            alt="product">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $item->products->name }}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Jumlah: {{ $item->total_product }}</p>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Harga: Rp
                                {{ number_format($item->total_price) }}</p>

                        </div>
                    </div>
                @endforeach

                <div class="w-full flex flex-wrap justify-between items-start gap-4 p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800"
                    id="detail">
                    <div class="">
                        <h2 class="mb-3 text-3xl font-semibold tracking-tight text-gray-700 dark:text-white">Detail
                            Transaksi</h2>
                        @php
                            $takeInfo = [];
                        @endphp
                        @foreach ($transaction as $item)
                            @if (!in_array($item->code, $takeInfo))
                                @php
                                    $takeInfo[] = $item->code;
                                @endphp
                                <p class="text-gray-500 dark:text-gray-400">
                                    <span class="font-bold">Pesan: </span>
                                    @if ($item->message != null)
                                        {{ $item->message }}
                                    @else
                                        -
                                    @endif
                                </p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    <span class="font-bold">Alamat: </span> {{ $item->address }}
                                </p>
                                <hr style="height: 2px" class="my-2 bg-gray-400 border-0 dark:bg-gray-700">
                            @endif
                        @endforeach

                        @foreach ($transaction as $item)
                            <p class="flex justify-start items-center gap-1 mb-3 text-gray-500 dark:text-gray-400">
                                <svg class="smHidden flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                @php
                                    $totalHarga = $item->products->price_after * $item->total_product;
                                @endphp
                                <span class="font-semibold">{{ $item->products->name }}:</span> Rp
                                {{ number_format($totalHarga) }}
                                <span class="smHidden">({{ $item->total_product }} PCS)</span>
                            </p>
                        @endforeach
                        <hr style="height: 2px" class="my-2 bg-gray-400 border-0 dark:bg-gray-700">
                        <p class="text-xl mb-3 text-gray-500 dark:text-gray-400">
                            <span class="font-bold">TOTAL HARGA: </span> Rp {{ number_format($grandPrice) }}
                        </p>
                    </div>
                    <div class="">
                        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-700 dark:text-white">Cara
                            Pembayaran
                        </h2>


                        <ol
                            class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400">
                            @php
                                $takeCode = [];
                            @endphp
                            @foreach ($transaction as $item)
                                @if (!in_array($item->code, $takeCode))
                                    @php
                                        $takeCode[] = $item->code;
                                    @endphp
                                    <li class="mb-4 ms-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 16">
                                                <path
                                                    d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                                            </svg>
                                        </span>
                                        <h3 class=" leading-tight font-bold">Salin Kode Order</h3>

                                        <p class="text-sm text-gray-600">{{ $item->code }}</p>

                                    </li>
                                    <li class="mb-4 ms-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 18 20">
                                                <path
                                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                                            </svg>
                                        </span>
                                        <h3 class="leading-tight font-bold">Hubungi Admin Dan Berikan Kode Order</h3>
                                        <a href="{{ url('https://wa.me/+6285817000942?text=Hallo%20Admin!%20Saya%20Sudah%20Order%20di%20Little%20Florist,%20Ini%20Kode%20Pembayaran-nya%20*' . $item->code . '*') }}"
                                            target="_blank" class="w-auto mt-1">
                                            <button type="button"
                                                class="text-sm bg-green-500 text-white px-2 py-1 rounded">Hubungi
                                                Admin</button>
                                        </a>
                                    </li>
                                    <li class="ms-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 18 20">
                                                <path
                                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                                            </svg>
                                        </span>
                                        <h3 class="leading-tight font-bold">Konfirmasi Pembayaran</h3>
                                        <p class="text-sm">Admin akan mengkonfirmasi pembayaran dan mengupdate status order
                                            menjadi sedang diproses</p>
                                    </li>
                                @endif
                            @endforeach
                        </ol>

                    </div>
                </div>
                {{-- END DETAIL TRANSACTION --}}
            </div>

        </div>
    </div>

@endsection
