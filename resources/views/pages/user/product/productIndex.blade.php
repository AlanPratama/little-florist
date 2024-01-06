@extends('layouts.user')

@section('title', 'Homepage')

@section('content')
    <section class="products mt-14" id="pricelist">

        <h1 class="heading"> pricelist <span>products</span> </h1>

        <div class="box-container">

            @foreach ($products as $product)
                @php
                    $discount = $product->price_before - $product->price_after;
                    $percentage = ($discount / $product->price_before) * 100;
                @endphp
                <div class="box">
                    <span class="discount">-{{ round($percentage, 2) }}%</span>
                    <div class="image">
                        <img src="{{ $product->image_asset == 'YA' ? asset('assets/' . $product->image) : $product->image }}"
                            alt="">
                        <div class="icons">
                            <a href="#" class="">{{ $product->sold }}</a>
                            <button class="cart-btn" data-product-slug="{{ $product->slug }}">Add to Cart</button>
                            <a href="{{ url('/produk/'. $product->slug) }}" class="fa-solid fa-eye"></a>
                        </div>
                    </div>
                    <div class="content">
                        <h3>{{ $product->name }} ({{ $product->id }})</h3>
                        <div class="price"> Rp {{ number_format($product->price_after) }} <span>Rp
                                {{ number_format($product->price_before) }}</span> </div>
                    </div>
                </div>
            @endforeach

        </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.cart-btn').on('click', function() {
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

@endsection
