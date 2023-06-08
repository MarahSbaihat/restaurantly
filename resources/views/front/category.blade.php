@extends('front.layout.app')
@section('content')

    @if (session()->has('success'))
        <p class="alert alert-success text-center m-auto my-2 mx-5">
            {{session('success')}}
        </p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger text-center m-auto my-2 mx-5">
            {{session('error')}}
        </p>
    @endif

    <!-- ======= Menu Section ======= -->
    <section class="menu section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Category</h2>
                <p>Check Our Tasty Category</p>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul class="py-5 my-5" id="menu-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($categories as $category)
                            <li>
                                <div class="dropdown z-3">
                                    <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $category->name }}
                                    </button>
                                    <ul class="dropdown-menu z-3">
                                        @foreach ($category->childrens as $child)
                                            <li class="w-100">
                                                <a data-filter=".filter-starters" class="dropdown-item w-100 py-2 rounded" href="{{ route('category') }}?category=$child->id">
                                                    {{$child->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row menu-container pb-5" data-aos="fade-up" data-aos-delay="200">
                @forelse ($products as $product)
                    <div class="col-lg-6 menu-item filter-{{ $product->category }}">
                        <img src="{{asset('storage/'.$product->image) }}" class="menu-img" alt="">
                        <div class="menu-content">
                            <a href="#">{{ $product->name }}</a><span>${{ $product->price }}</span>
                        </div>
                        <div class="menu-ingredients d-flex justify-content-between">
                            {{ $product->description }}
                            <div>
                                <a href="{{ route('details' , $product->id) }}">info</a>
                                @auth
                                    <form action="{{ route('cart.add' , $product->id) }}" method="POST">
                                        @csrf
                                        <button class="btn text-light" href="">cart</button>
                                    </form>
                                @endauth
                                @guest
                                    <a href="{{ route('signin') }}">cart</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
            <div class="d-flex justify-content-around">
                {{ $products->links() }}
                <select onchange="location=this.value" class="form-select w-25" aria-label="Default select example">
                    <option value="{{ route('category') }}?select=5">Show 5</option>
                    <option value="{{ route('category') }}?select=10">Show 10</option>
                    <option value="{{ route('category') }}?select=15">Show 15</option>
                </select>
            </div>

        </div>
    </section>
    <!-- End Menu Section -->
@endsection
