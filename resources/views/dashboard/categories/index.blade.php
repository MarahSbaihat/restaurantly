@extends('dashboard.layout.app')

@section('pagename', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
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
        <h4>ctegories</h4>
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">create new category</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">status</th>
                <th scope="col">created_at</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                {{-- parent --}}
                <tr class="bg-secondary">
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td scope="col">{{ $category->name }}</td>
                    <td scope="col">
                        @if ( $category->status==1 )
                            ✅
                        @else
                            ❌
                        @endif
                    </td>
                    <td scope="col">{{ $category->created_at->toDateString() }}</td>
                    <td scope="col" class="d-flex">
                        <form action="{{ route('dashboard.categories.edit' , $category->id) }}" method="GET">
                            @csrf
                            <button class="btn btn-sm btn-primary mx-1">📝</button>
                        </form>
                        <form action="{{ route('dashboard.categories.destroy' , ['category'=>$category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1">📮</button>
                        </form>
                    </td>
                </tr>
                @php
                    $current_loop = $loop->iteration;
                @endphp
                {{-- childrens --}}
                @if (count($category->childrens) > 0)
                    @foreach ($category->childrens as $child)
                        <tr>
                            <th scope="col">{{ $current_loop .'-'. $loop->iteration }}</th>
                            <td scope="col">{{ $child->name }}</td>
                            <td scope="col">
                                @if ( $child->status==1 )
                                    ✅
                                @else
                                    ❌
                                @endif
                            </td>
                            <td scope="col">{{ $child->created_at->toDateString() }}</td>
                            <td scope="col" class="d-flex">
                                <form action="{{ route('dashboard.categories.edit' , $child->id) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-sm btn-primary mx-1">📝</button>
                                </form>
                                <form action="{{ route('dashboard.categories.destroy' , ['category'=>$child->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mx-1">📮</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @empty
                    <td colspan="5" class="text-center fw-bold">there is no category</td>
            @endforelse
        </tbody>
    </table>
@endsection
