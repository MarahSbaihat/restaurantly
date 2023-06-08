@extends('dashboard.layout.app')

@section('pagename', 'products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection

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
    <div class="d-flex justify-content-between">
        <h4>products</h4>
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">create new product</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">description</th>
                <th scope="col">status</th>
                <th scope="col">category</th>
                <th scope="col">image</th>
                <th scope="col">price</th>
                <th scope="col">created_at</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @if($product->status == 1)
                            ✅
                        @else
                            ❌
                        @endif
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td><img class="w-50" src="{{asset('storage/'.$product->image) }}" alt="{{ $product->name }} image"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                    <td scope="col" class="d-flex">
                        <form action="{{ route('dashboard.products.edit' , $product->id) }}" method="GET">
                            @csrf
                            <button class="btn btn-sm btn-primary mx-1">📝</button>
                        </form>
                        <form action="{{ route('dashboard.products.destroy' , ['product'=>$product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1">📮</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">there is no product</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
