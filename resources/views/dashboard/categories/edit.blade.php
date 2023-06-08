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
    <form class="w-50 text-center m-auto" action="{{ route('dashboard.categories.update' , $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h4>update category</h4>
        <div class="my-3">
            <label for="exampleInputEmail1" class="form-label">name</label>
            <input name="name" value="{{ old('name' , $category->name) }}" type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status</label>
            <select class="form-control" name="status" id="status">
                <option @selected(old('status' , $category->status) == 1) value="1">active</option>
                <option @selected(old('status' , $category->status) == 0) value="0">not active</option>
            </select>
            @error('status')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Parent</label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option selected value="">parent</option>
                @foreach ($parents as $parent)
                    <option @selected(old('parent_id' , $category->parent_id) == $parent->id) value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section('pagename', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">categories</a></li>
    <li class="breadcrumb-item active">update</li>
@endsection
