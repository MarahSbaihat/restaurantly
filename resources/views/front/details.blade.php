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

    <div class="container py-5 my-5">
        <div class="row py-5 my-5">
            <div class="col-md-5">
                <img src="{{asset('storage/'.$product->image) }}" class="rounded-circle w-75 m-auto menu-img" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6 offset-1">
                <h3>{{ $product->name }}</h3>
                <h4>price: ${{ $product->price }}</h4>
                <p>category: {{ $product->category->name }}</p>
                <p>{{ $product->description }}</p>
                <a href="" class="btn btn-success">Add to cart</a>
            </div>
        </div>
    </div>
@endsection
