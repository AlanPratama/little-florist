<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Little Florist</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    {{-- <link rel="stylesheet" href="assets/style.css"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/LF_logo.png') }}" type="image/x-icon">

    {{-- FONTAWASOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- FLOWBITE (FRAMEWORK CSS - TAILWINDCSS) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    {{-- SWEETALERT 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- AXIOS --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    {{-- HEADER START --}}
    <header>

        <input type="checkbox" name=" " id="toggler">
        <label for="toggler" class="fas  fa-bars"></label>


        <a href="https://www.instagram.com/little_florist_shop/" class="logo"><img
                src="{{ asset('assets/LF_logo.png') }}" alt="logo"> Little Florist<span>.</span></a>

        <nav class="navbar">
            <a href="{{ url('/#beranda') }}">Beranda</a>
            <a href="{{ url('/#about') }}">About us</a>
            <a href="{{ url('/#pricelist') }}">Pricelist</a>
            <a href="{{ url('/#gallery') }}">Gallery</a>
            <a href="{{ url('/#contactUs') }}">Contact Us</a>
            <a href="{{ url('/#order') }}">Order</a>
        </nav>

        <div class="icons">
            <i data-drawer-target="cart-right-drawer" data-drawer-show="cart-right-drawer" data-drawer-placement="right"
                aria-controls="cart-right-drawer" class="fa-solid fa-cart-shopping"></i>
            @if (!Auth::user())
                <a href="{{ url('/login') }}">
                    <i class="fa-solid fa-person-walking-arrow-right" title="login"></i>
                </a>
            @else
                <a href="{{ url('/logout') }}">
                    <i class="fa-solid fa-right-to-bracket" title="logout"></i>
                </a>
            @endif
        </div>

    </header>

    {{-- HEADER END --}}


    {{-- CONTENT START --}}
    @yield('content')

    @if (session('berhasil'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('berhasil') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('invalid'))
        <script>
            Swal.fire({
                title: "Invalid!",
                text: "{{ session('invalid') }}",
                icon: "error"
            });
        </script>
    @endif



    <!-- drawer init and toggle -->
    <div class="text-center hidden">
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            type="button" data-drawer-target="menu-drawer" data-drawer-show="menu-drawer"
            data-drawer-placement="bottom" data-drawer-edge="true" data-drawer-edge-offset="bottom-[60px]"
            aria-controls="menu-drawer">
            Show swipeable drawer
        </button>
    </div>
    <style>
        .cart-drawer {
            width: 340px;
        }
    </style>

    <!-- CART DRAWER -->
    <div id="cart-right-drawer" style="z-index: 999 !important;"
        class="fixed top-0 right-0 z-40 h-screen shadow p-4 overflow-y-auto transition-transform translate-x-full bg-white cart-drawer dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label">

        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-2 text-base text-lg font-semibold text-gray-700 dark:text-gray-400">
            {{-- <svg
            class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg> --}}
            <i class="fa-solid fa-cart-shopping w-4 h-4 me-2.5"></i>
            <span>KERANJANG</span>
        </h5>
        <button type="button" data-drawer-hide="cart-right-drawer" aria-controls="cart-right-drawer"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <hr style="height: 1.5px !important;" class="bg-gray-300 border-0 dark:bg-gray-700">

        <div class="" style="padding-bottom: 60px !important;">
            @if (Auth::user())
                @if ($carts->count() > 0)
                    <form method="post" action="{{ route('transaction.start') }}">
                        @csrf
                        @foreach ($carts as $cart)
                            <div class="flex justify-evenly items-start my-6">
                                <div class="w-auto rounded shadow" style="margin-right: 10px;">
                                    <img src="{{ $cart->products->image_asset == 'YA' ? asset('assets/' . $cart->products->image) : $cart->products->image }}"
                                        alt="product" class=""
                                        style="aspect-ratio: 1/1; width: 100px; min-width: 100px; max-width: 100px; ">
                                </div>
                                <div class="w-auto pl-1 flex flex-col items-start justify-start">

                                    <h3 class="" style="font-size: 17px;" id="cart-title">
                                        {{ $cart->products->name }}</h3>

                                    <p class="" style="color: #e84393; font-weight: 600; font-size: 16px;">Rp
                                        {{ number_format($cart->products->price_after) }}</p>


                                    <div class="relative flex items-center max-w-[8rem]">

                                        <button type="button" id="decrement-button"
                                            data-input-counter-decrement="quantity-input"
                                            onclick="decreaseQuantity_{{ $cart->id }}()"
                                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 p-2 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>

                                        <input type="text" value="{{ $cart->products->id }}" name="product[]"
                                            class="bg-gray-50 border-x-0 border-gray-300 hidden text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="1" readonly required>

                                        <input type="text" id="{{ $cart->products->slug }}" data-input-counter
                                            value="{{ $cart->total_product }}" name="sold[]"
                                            aria-describedby="helper-text-explanation"
                                            class="bg-gray-50 border-x-0 border-gray-300 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="1" readonly required>

                                        <button type="button" id="increment-button"
                                            onclick="increaseQuantity_{{ $cart->id }}()"
                                            data-input-counter-increment="quantity-input"
                                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 p-2 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>

                                        <i class="ml-1 text-md fa-solid fa-trash-can bg-red-500 text-white dark:bg-red-700 dark:hover:bg-red-600 dark:border-gray-600 hover:bg-red-600 border border-gray-300 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
                                            style="padding: 6px;"
                                            onclick="event.preventDefault(); deleteCart('{{ $cart->id }}');"></i>

                                    </div>


                                    <script>
                                        let currentQuantity_{{ $cart->id }} = {{ $cart->total_product }};

                                        function increaseQuantity_{{ $cart->id }}() {
                                            currentQuantity_{{ $cart->id }} = Math.max(1, currentQuantity_{{ $cart->id }} + 1);
                                            document.getElementById('{{ $cart->products->slug }}').value = currentQuantity_{{ $cart->id }};
                                        }

                                        function decreaseQuantity_{{ $cart->id }}() {
                                            currentQuantity_{{ $cart->id }} = Math.max(1, currentQuantity_{{ $cart->id }} - 1);
                                            document.getElementById('{{ $cart->products->slug }}').value = currentQuantity_{{ $cart->id }};
                                        }
                                    </script>

                                </div>
                            </div>
                        @endforeach

                        <div class="fixed bottom-0 flex justify-center items-center w-full bg-white"
                            style="width: 310px;">
                            <button type="submit" style="width: 100% !important;"
                                class="text-white text-lg bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center flex justify-center items-center gap-2 dark:focus:ring-[#2557D6]/50 mb-2">
                                <span class="font-semibold">CHECKOUT</span>
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center mt-6">
                        <h3 style="font-size: 24px; margin-bottom: 4px;">Tidak Ada Daftar Produk!</h3>
                        <div class="flex justify-center items-center">
                            <a href="{{ url('/produk') }}">
                                <button type="button"
                                    class="text-white text-lg font-semibold bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Lihat
                                    Produk</button>
                            </a>
                        </div>
                    </div>

                @endif
            @else
                <div class="text-center mt-6">
                    <h3 style="font-size: 24px; margin-bottom: 4px;">Kamu Belum Login!</h3>
                    <div class="flex justify-center items-center">
                        <a href="{{ url('/login') }}">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login</button>
                        </a>

                        <a href="{{ url('/register') }}">
                            <button type="button"
                                class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Register</button>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- drawer component -->
    <div id="menu-drawer"
        class="fixed z-40 w-full overflow-y-hidden bg-white border-t border-gray-200 rounded-t-lg dark:border-gray-700 dark:bg-gray-800 transition-transform bottom-0 left-0 right-0 translate-y-full bottom-[60px]"
        tabindex="-1" aria-labelledby="menu-drawer-label">
        <div class="p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700" data-drawer-toggle="menu-drawer">
            <span
                class="absolute w-8 h-1 -translate-x-1/2 bg-gray-300 rounded-lg top-3 left-1/2 dark:bg-gray-600"></span>
            <h5 id="menu-drawer-label"
                class="inline-flex items-center text-base text-gray-500 dark:text-gray-400 font-medium"><svg
                    class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 18">
                    <path
                        d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10ZM17 13h-2v-2a1 1 0 0 0-2 0v2h-2a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 0-2Z" />
                </svg>MENU</h5>
        </div>
        <div class="grid grid-cols-2 gap-4 p-4 lg:grid-cols-4">

            @if (Auth::user())
                <a href="{{ url('/akun') }}">
                    <div
                        class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 lg:block">
                        <div
                            class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <i class="fa-solid fa-user inline text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div class="font-medium text-center text-gray-500 dark:text-gray-400">Akun</div>
                    </div>
                </a>

                <a href="{{ url('/transaksi') }}">
                    <div
                        class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 lg:block">
                        <div
                            class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <svg class="inline w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                                <path
                                    d="M13.383.076a1 1 0 0 0-1.09.217L11 1.586 9.707.293a1 1 0 0 0-1.414 0L7 1.586 5.707.293a1 1 0 0 0-1.414 0L3 1.586 1.707.293A1 1 0 0 0 0 1v18a1 1 0 0 0 1.707.707L3 18.414l1.293 1.293a1 1 0 0 0 1.414 0L7 18.414l1.293 1.293a1 1 0 0 0 1.414 0L11 18.414l1.293 1.293A1 1 0 0 0 14 19V1a1 1 0 0 0-.617-.924ZM10 15H4a1 1 0 1 1 0-2h6a1 1 0 0 1 0 2Zm0-4H4a1 1 0 1 1 0-2h6a1 1 0 1 1 0 2Zm0-4H4a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                            </svg>
                        </div>
                        <div class="font-medium text-center text-gray-500 dark:text-gray-400">Histori Transaksi</div>
                    </div>
                </a>
            @else
                <a href="{{ url('/login') }}">
                    <div
                        class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 lg:block">
                        <div
                            class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <i
                                class="fa-solid fa-person-walking-arrow-right inline text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div class="font-medium text-center text-gray-500 dark:text-gray-400">Login</div>
                    </div>
                </a>

                <a href="{{ url('/register') }}">
                    <div
                        class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                        <div
                            class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <i class="fa-solid fa-id-card inline text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div class="font-medium text-center text-gray-500 dark:text-gray-400">Register</div>
                    </div>
                </a>
            @endif

            {{-- PRODUCTS --}}
            <a href="{{ url('/produk') }}">
                <div
                    class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div
                        class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <i class="fa-solid fa-box-archive inline text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <div class="font-medium text-center text-gray-500 dark:text-gray-400">Produk</div>
                </div>
            </a>

            <a href="{{ url('/gallery') }}">
                <div
                    class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div
                        class="flex justify-center items-center p-2 mx-auto mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <i class="fa-solid fa-photo-film inline w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <div class="font-medium text-center text-gray-500 dark:text-gray-400">Gallery</div>
                </div>
            </a>

        </div>
    </div>

    {{-- CONTENT END --}}



    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#about">about</a>
                <a href="#products">products</a>
                <a href="#review">review</a>
                <a href="#contact">contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#">my account</a>
                <a href="#">my order</a>
                <a href="#">my favorite</a>
            </div>

            <div class="box">
                <h3>locations</h3>
                <a href="#">Jakarta</a>
                <a href="#">Depok</a>
                <a href="#">bogor</a>
                <a href="#">Tangerang</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#">+62 858-1101-3635</a>
                <a href="#">littlefloristshop@gmail.com</a>
                <a href="#">Depok, Indonesia - 153467</a>
                <img src="images/payment.png" alt="">
            </div>

        </div>

        <div class="credit"> created by <span> LITTLE FLORIST</span> | all rights reserved </div>

    </section>

    <!-- footer section ends -->

    {{-- FLOWBITE (FRAMEWORK CSS -TAILWINDCSS) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     limitWords("cart-title", 2); //
        // });

        // function limitWords(elementId, wordLimit) {
        //     var element = document.getElementById(elementId);

        //     if (element) {
        //         var words = element.textContent.split(" ");

        //         if (words.length > wordLimit) {
        //             var limitedWords = words.slice(0, wordLimit).join(" ");
        //             element.textContent = limitedWords;

        //             var warningMessage = document.createElement("span");
        //             warningMessage.textContent = " ...";
        //             element.appendChild(warningMessage);
        //         }
        //     }
        // }

        function deleteCart(cart) {
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
                    axios.delete(`/deleteCart/${cart}`)
                        .then(response => {
                            let timerInterval;
                            Swal.fire({
                                title: "BERHASIL!",
                                html: "CART BERHASIL DIHAPUS",
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
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.reload(true);
                                }
                                window.location.reload(true);
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
</body>

</html>
