@extends('dashboard.layout.app')

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
    <form class="w-50 text-center m-auto" action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>create product</h4>
        <div>
            <label for="exampleInputEmail1" class="form-label">name</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="my-3">
            <label for="exampleInputEmail1" class="form-label">description</label>
            <input name="description" value="{{ old('description') }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="my-3">
            <label for="exampleInputEmail1" class="form-label">price</label>
            <input name="price" step="0.1" value="{{ old('price') }}" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('price')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="my-3">
            <label for="exampleInputEmail1" class="form-label">image</label>
            <input name="image" type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status</label>
            <select class="form-control" name="status" id="status">
                <option @selected(old('status') == 1) value="1">active</option>
                <option @selected(old('status') == 0) value="0">not active</option>
            </select>
            @error('status')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">category</label>
            <select class="form-control" name="category_id" id="category_id">
                <option selected value="">category</option>
                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection

@section('pagename', 'products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}">products</a></li>
    <li class="breadcrumb-item active">add</li>
@endsection
