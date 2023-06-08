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

    <div class="py-5 my-5 container text-center">
        <div class="pt-5 mt-5 w-50 m-auto">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password confirm</label>
                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">sign up</button>
                <div class="py-2 d-flex">
                    <p>do you have an account? </p>
                    <a href="{{ route('signin') }}"> sign in</a>
                </div>
            </form>
        </div>
    </div>
@endsection
