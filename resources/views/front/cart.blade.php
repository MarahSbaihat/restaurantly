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
        <h3 class="py-5 mt-5">This is your cart</h3>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <table class="table table-stripe text-light">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">total price</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($cart as $item)
                        <tr>
                            <th scope="row"></th>
                            <td><img class="w-25" src="{{asset('storage/'.$item['image']) }}"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                        
                        @php
                            $total += $item['price'] * $item['quantity'];
                        @endphp

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>No item in cart</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <div class="py-5 d-flex justify-content-between">
                    <h5>Total price: ${{ $total }}</h5>
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <button class="btn btn-success">order</button>
                </div>
            </table>
        </form>
    </div>
@endsection
