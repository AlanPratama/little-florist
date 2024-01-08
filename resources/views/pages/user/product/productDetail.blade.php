@extends('layouts.user')

@section('title', $product->name)

@section('content')
    <style>
        .container-product {
            width: 70%;
        }


        @media(max-width: 768px) {
            .container-product {
                width: 95%;
            }
        }

        .price {
            font-size: 20px;
            color: var(--pink);
            font-weight: bolder;
        }

        .price .priceAfter {
            font-size: 15px;
            color: #999;
            font-weight: lighter;
            text-decoration: line-through;
        }

        .price .sold {
            font-size: 19px;
            color: rgb(243, 71, 157);
            font-weight: lighter;
        }

        .button-buy {
            background-color: rgb(243, 71, 157);
            color: white
        }

        .button-cart {
            background-color: white;
            color: rgb(243, 71, 157);
            border: 1px solid rgb(243, 71, 157);
        }
    </style>

    <div class=" w-full flex justify-center items-center" style="padding: 70px 0px; background-color: #f6f6f6;">
        <div class="container-product">
            <div
                class="mt-14 flex flex-col items-start justify-center rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-64 md:rounded-none md:rounded-s-lg border-2 border-gray-200"
                    src="{{ $product->image_asset == 'YA' ? asset('assets/' . $product->image) : $product->image }}"
                    alt="">
                <div class="flex flex-col justify-between p-4 leading-normal md:w-1/2 w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}
                        <span class="text-lg font-normal">(Stok: {{ $product->stock }})</span>
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->description }}</p>
                    <div class="price"> <span class="priceAfter">Rp
                            {{ number_format($product->price_before) }}</span> Rp {{ number_format($product->price_after) }}
                        - <span class="sold">({{ $product->sold }})</span> </div>

                        <div class="flex flex-wrap justify-start items-center mt-2">
                            @if (Auth::user())
                                <button type="button" {{ Auth::user()->role == 'Admin' ? 'disabled' : '' }}
                                    class="button-buy text-lg font-semibold font-medium rounded text-sm px-3 py-2 me-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
                                    data-modal-target="buyNow-modal" data-modal-toggle="buyNow-modal">Pesan
                                    Sekarang</button>
                                <!-- Main modal -->
                                <div id="buyNow-modal" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <form action="{{ route('transaction.start.now', ['id' => $product->id]) }}"
                                            method="POST" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            @csrf
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3
                                                    class="text-xl font-semibold text-gray-900 dark:text-white flex justify-center items-center gap-1">
                                                    <img src="{{ asset('assets/LF_logo.png') }}" alt="little florist"
                                                        class="w-14"> <span>Little
                                                        Florist</span>
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="buyNow-modal">
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
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="flex justify-center items-center gap-2 w-auto h-auto">
                                                    <img src="{{ $product->image_asset == 'YA' ? asset('assets/' . $product->image) : $product->image }}"
                                                        alt="" class="md:w-48 w-24 rounded">
                                                    <div class="w-auto h-auto">
                                                        <p class="text-lg">{{ $product->name }}</p>

                                                        <div class="relative flex items-center max-w-[8rem]">

                                                            <button type="button" id="decrement-button"
                                                                data-input-counter-decrement="quantity-input"
                                                                onclick="decreaseQuantity_{{ $product->id }}()"
                                                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 p-2 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                                <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 18 2">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M1 1h16" />
                                                                </svg>
                                                            </button>
                                                            <input type="text" id="{{ $product->slug }}"
                                                                data-input-counter value="1" name="sold"
                                                                aria-describedby="helper-text-explanation"
                                                                class="bg-gray-50 border-x-0 border-gray-300 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="1" readonly required>
                                                            <button type="button" id="increment-button"
                                                                onclick="increaseQuantity_{{ $product->id }}()"
                                                                data-input-counter-increment="quantity-input"
                                                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 p-2 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                                <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 18 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 1v16M1 9h16" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <script>
                                                            let currentQuantity = 1;

                                                            function increaseQuantity_{{ $product->id }}() {
                                                                currentQuantity = Math.max(1, currentQuantity + 1);
                                                                document.getElementById('{{ $product->slug }}').value = currentQuantity;
                                                            }

                                                            function decreaseQuantity_{{ $product->id }}() {
                                                                currentQuantity = Math.max(1, currentQuantity - 1);
                                                                document.getElementById('{{ $product->slug }}').value = currentQuantity;
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesan
                                                    Sekarang</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <button type="button" {{ Auth::user()->role == 'Admin' ? 'disabled' : '' }}
                                    class="button-cart text-lg font-semibold font-medium rounded text-sm px-3 py-2 me-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
                                    data-product-slug="{{ $product->slug }}">Add To Cart</button>
                                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('.button-cart').on('click', function() {
                                            var productSlug = $(this).data('product-slug');

                                            $.ajax({
                                                url: '/addToCart',
                                                type: 'POST',
                                                data: {
                                                    productSlug: productSlug,
                                                    _token: $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        const Toast = Swal.mixin({
                                                            toast: true,
                                                            position: "top-start",
                                                            showConfirmButton: false,
                                                            timer: 3000,
                                                            timerProgressBar: true,
                                                            didOpen: (toast) => {
                                                                toast.onmouseenter = Swal.stopTimer;
                                                                toast.onmouseleave = Swal.resumeTimer;
                                                            }
                                                        });
                                                        Toast.fire({
                                                            icon: "success",
                                                            title: "BERHASIL MENAMBAH PRODUK"
                                                        });

                                                    }
                                                },
                                                error: function(error) {
                                                    console.log(error);
                                                }
                                            });
                                        });
                                    });
                                </script>
                            @else
                                <a href="{{ url('/login') }}">
                                    <button type="button"
                                        class="button-buy text-lg font-semibold font-medium rounded text-sm px-3 py-2 me-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Pesan
                                        Sekarang</button>
                                </a>
                                <a href="{{ url('/login') }}">
                                    <button type="button"
                                        class="button-cart text-lg font-semibold font-medium rounded text-sm px-3 py-2 me-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Add
                                        To Cart</button>
                                </a>
                            @endif
                        </div>

                </div>
            </div>
        </div>
    </div>



@endsection
