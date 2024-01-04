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
                    <img src="{{ $product->image_asset == 'YA' ? asset('assets/'.$product->image) : $product->image }}" alt="">
                    <div class="icons">
                        <a href="#" class="">{{ $product->sold }}</a>
                        <a href="#" class="cart-btn">add to cart</a>
                        <a href="#" class="fa-solid fa-eye"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>{{ $product->name }}</h3>
                    <div class="price"> Rp {{ number_format($product->price_after) }} <span>Rp {{ number_format($product->price_before) }}</span> </div>
                </div>
            </div>
        @endforeach

    </div>

</section>
@endsection
