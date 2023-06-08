@extends('front.layout.app')

@push('css')
    {{-- customized css
    <style>

    </style> --}}
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
@endpush
@push('js')
    {{-- customized js
    <script>

    </script> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush

@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success text-center m-auto my-2 mx-5">
            {{ session('success') }}
        </p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger text-center m-auto my-2 mx-5">
            {{ session('error') }}
        </p>
    @endif

    <div class="container">
        <section class="checkout_area section_gap">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="name">
                                    <span class="placeholder" data-placeholder="First name"></span>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="last" name="name">
                                    <span class="placeholder" data-placeholder="Last name"></span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="company" name="company"
                                        placeholder="Company name">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="number">
                                    <span class="placeholder" data-placeholder="Phone number"></span>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="compemailany">
                                    <span class="placeholder" data-placeholder="Email Address"></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <select class="country_select">
                                        <option value="1">Country</option>
                                        <option value="2">Country</option>
                                        <option value="4">Country</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add1" name="add1">
                                    <span class="placeholder" data-placeholder="Address line 01"></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add2" name="add2">
                                    <span class="placeholder" data-placeholder="Address line 02"></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="city" name="city">
                                    <span class="placeholder" data-placeholder="Town/City"></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <select class="country_select">
                                        <option value="1">District</option>
                                        <option value="2">District</option>
                                        <option value="4">District</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="zip"
                                        placeholder="Postcode/ZIP">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" id="f-option2" name="selector">
                                        <label for="f-option2">Create an account?</label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <h3>Shipping Details</h3>
                                        <input type="checkbox" id="f-option3" name="selector">
                                        <label for="f-option3">Ship to a different address?</label>
                                    </div>
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <h2>Your Order</h2>
                            <div class="order_box">
                                <ul class="list">
                                    <li><a href="#">Product <span>Total</span></a></li>
                                    @foreach ($order->items as $item)
                                        <li>
                                            <a href="#">{{ $item->product->name }}
                                                <span class="middle">x {{ $item->quantity }}</span>
                                                <span class="last">${{ $item->quantity * $item->product->price }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Total <span>${{ $order->amount }}</span></a></li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="selector">
                                        <label for="f-option5">Check payments</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                        Store Postcode.</p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="selector">
                                        <label for="f-option6">Paypal </label>
                                        <img src="img/product/card.jpg" alt="">
                                        <div class="check"></div>
                                    </div>
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                        account.</p>
                                </div>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option4" name="selector">
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>
                                <a class="primary-btn" href="{{ route('paypal.create' , $order->id) }}">Proceed to Paypal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
