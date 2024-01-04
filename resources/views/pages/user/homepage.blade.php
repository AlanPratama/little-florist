@extends('layouts.user')

@section('title', 'Homepage')

@section('content')
    <section class="home" id="beranda">

        <div class="content">
            <h4>Little Florist</h4>
            <span>Anda berhak bahagia, jadi izinkan kami membantu Anda menemukannya!</span>
            <p>Florist adalah toko di Margonda City. Temukan bunga segar & karangan bunga dengan desain & warna unik
                untuk acara orang spesial Anda.
            </p>
            <a href="{{ url('/produk') }}" class="btn">shop now</a>
        </div>
    </section>

    <section class="about" id="about">
        <h1 class="heading"><span>about</span> us</h1>

        <div class="row">
            <div class="video-container">
                <video src="{{ asset('assets/vidio.mp4') }}" loop autoplay muted></video>
                <h3>why choose us?</h3>
            </div>
            <div class="text">
                <h4>BEST FLOWERS</h4>

                <p>Toko Little Florist telah dikenal sebagai toko bunga florist yang menyediakan berbagai rangkaian
                    bunga segar berkualitas untuk gift bucket, frame wedding, bunga papan, karangan bunga, bucket bunga,
                    bucket balon cake & flower box, single bucket dan berbagai bentuk pajangan bunga dekorasi bunga
                    hidup dan taman untuk berbagai momen spesial Anda khususnya bagi Anda yang bertempat di Jabodetabek.
                    Kami juga bisa membantu Anda untuk pengiriman ke berbagai kota di seluruh indonesia, karena kami
                    telah bekerjasama dengan florist seluruh indonesia.
                </p>
                <a href="#" class="btn">Learn more</a>
            </div>
        </div>


        <div class="tutor-list">
            <div class="kartu-tutor">
                <a href="https://instagram.com/nssya.dyfebsa " target="_blank"><img
                        src="{{ asset('assets/Gambar/nassya.jpg') }}"></a>
                <p>NASSYA DYFEBSA <i>(SUPERVISOR)</i></p>

            </div>
            <div class="kartu-tutor">
                <a href="https://instagram.com/its.dinssss" target="_blank"><img
                        src="{{ asset('assets/Gambar/dini.jpg') }}"></a>
                <p>RAHMA DINI<i>(ADMIN)</i></p>

            </div>
            <div class="kartu-tutor">
                <a href="https://instagram.com/iinyrm" target="_blank"><img
                        src="{{ asset('assets/Gambar/maryani.jpg') }}"></a>
                <br>
                <br>
                <p>MARYANI<i>(MANAGER)</i></p>

            </div>
        </div>
    </section>


    <section class="icons-container">

        <div class="icons">
            <img src="{{ asset('assets/Gambar/free_delivery.jpg') }}" alt="">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="{{ asset('assets/Gambar/return.jpg') }}" alt="">
            <div class="info">
                <h3>10 days returns</h3>
                <span>moneyback guarantee</span>
            </div>
        </div>

        <div class="icons">
            <img src="{{ asset('assets/Gambar/offer_gift.jpg') }}" alt="">
            <div class="info">
                <h3>offer & gifts</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="{{ asset('assets/Gambar/secure_paymens.jpg') }}" alt="">
            <div class="info">
                <h3>secure paymens</h3>
                <span>protected by paypal</span>
            </div>
        </div>


    </section>

    <!-- prodcuts section starts  -->



    <!-- prodcuts section ends -->

    <section class="products" id="pricelist">

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
    <!-- Your custom modal overlay -->
    {{-- <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <!-- Add an element to display modal content -->
            <button class="close-btn" onclick="closeModal()">Close</button>
            <h2 id="modalTitle"></h2>
            <p id="modalClass"></p>
            <p id="modalAbsen"></p>
        </div>
    </div> --}}

    <script>
        function openModal(name, className, absen) {
            // Set modal content dynamically
            document.getElementById('modalTitle').innerText = name + ' Details';
            document.getElementById('modalClass').innerText = 'Class: ' + className;
            document.getElementById('modalAbsen').innerText = 'Absen: ' + absen;

            // Show the modal overlay
            document.getElementById('modalOverlay').style.display = 'flex';
        }

        function closeModal() {
            // Hide the modal overlay
            document.getElementById('modalOverlay').style.display = 'none';
        }
    </script>

    <section class="products" id="gallery">

        <h1 class="heading"><span>Gallery</span> </h1>

        <div class="box-container">

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/12b043f4-4146-4de9-8899-35e9adf62007.jpeg') }}" alt="">
                </div>
            </div>

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/8d0ada32-fccb-40cc-93df-51ac0d34f902.jpeg') }}" alt="">
                </div>
            </div>

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/c7083d2e-1ac8-4ef3-819b-d90a5ce3e54d.jpeg') }}" alt="">
                </div>
            </div>

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/e63fa881-818b-48dc-a9dd-889d222efa84.jpeg') }}" alt="">
                </div>
            </div>

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/galllery_5.jpg') }}" alt="">
                </div>
            </div>

            <div class="box">

                <div class="image">
                    <img src="{{ asset('assets/images/gallery_6.jpg') }}" alt="">
                </div>
            </div>
        </div>

    </section>

    <!-- review section starts  -->

    <section class="review" id="review">

        <h1 class="heading"> customer's <span>review</span> </h1>

        <div class="box-container">

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Bucketnya cantik banget & lucu suka banget . seller nya ramah fast respon . pengirimannya juga cepet
                    banget , makasih yaaa, semoga banyak terus orderannya . Next order lagi insyaallah</p>
                <div class="user">
                    <img src="{{ asset('assets/Gambar/Tika.jpg') }}" alt="">
                    <div class="user-info">
                        <h3>Kartika Aprilia</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p> Bucket bunganya Realpict sesuai dengan foto etalase penjual. penjual Amanah , ramah dan sabar dalam
                    menjawab pertanyaan saya yang banyak , Thank you seller</p>
                <div class="user">
                    <img src="{{ asset('assets/Gambar/rika.jpg') }}" alt="">
                    <div class="user-info">
                        <h3>Yurika putri</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>udah ke dua kali pesen bunga disini gapernah nyesel, suka banget wrappingnya rapi, pengiriman aman,
                    sebelum pengiriman pasti seller konfirmasi dulu jadi sumpah best experience selama beli bunga!
                    recommended banget buat kalian yang lagi nyari buket buat hadiah</p>
                <div class="user">
                    <img src="{{ asset('assets/Gambar/manda.jpg') }}" alt="">
                    <div class="user-info">
                        <h3>Amanda putri</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

        </div>

    </section>

    <!-- review section ends -->

    <!-- contact section starts  -->

    <section class="contact" id="contactUs">

        <h1 class="heading"> <span> contact </span> us </h1>

        <div class="row">

            <form action=""
                style="display: flex; flex-direction: column; gap: 1.5rem; font-weight: 600; font-size: 20px; ">
                <a style="color: #333;" href="https://wa.me/6285811013635">
                    <i class="fa-brands fa-whatsapp" style="color: #00cc18;"></i> +62 858-1101-3635</a>
                <a style="color: #333;" href="https://instagram.com/little_florist_shop?igshid=OGQ5ZDc2ODk2ZA=="><i
                        class="fa-brands fa-instagram" style="color: #cc00b1;"></i> @little_florist_shop</a>
            </form>

            <div class="image">
                <img src="{{ asset('assets/images/contact-img.svg') }}" alt="">
            </div>

        </div>

    </section>

    <!-- contact section ends -->

    <!-- contact section starts  -->

    <section class="contact" id="order">

        <h1 class="heading"> <span> Order </span> Sekarang </h1>

        <div class="row">
            <form id="contactForm" onsubmit="submitForm(event)">
                <input type="text" placeholder="Name" class="box" id="name" required>
                <input type="email" placeholder="Email" class="box" id="email" required>
                <input type="tel" placeholder="Phone Number" class="box" id="phoneNumber" required>
                <textarea class="box" placeholder="Message" id="message" rows="10" required></textarea>
                <button type="submit" class="btn" >Send Message</button>
            </form>

            <div class="image">
                <img src="{{ asset('assets/Gambar/bg_order.jpg') }}" alt="">
            </div>

        </div>

    </section>
    <script>
        function submitForm(event) {
            event.preventDefault();

            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phoneNumber = document.getElementById("phoneNumber").value;
            var message = document.getElementById("message").value;

            // Ganti nomor WhatsApp dengan nomor yang ingin Anda tuju
            var whatsappNumber = "+6285811013635";

            // Format pesan untuk WhatsApp
            var whatsappMessage = "Name: " + name + " Email: " + email + " Phone Number: " + phoneNumber + " Pesanan: " +
                message;

            // URL untuk membuka aplikasi WhatsApp dengan pesan yang ditentukan
            var whatsappUrl = "https://wa.me/" + whatsappNumber + "?text=" + encodeURIComponent(whatsappMessage);

            // Buka link WhatsApp
            window.open(whatsappUrl, '_blank');
        }
    </script>

    <!-- contact section ends -->
@endsection
