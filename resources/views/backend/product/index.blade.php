@extends('backend.home')
@section('title', 'Product - Home')
@section('main_content')
    <section>
        <div>
            <h1>{{$data['category']->name}} list</h1>
        </div>

        {{--        error messages--}}
        <div>
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <p class="alert alert-success" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </p>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <p class="alert alert-danger" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('error')}}
                </p>
            @endif
        </div>

        <div>
            <a href="{{route('product.create')}}">
                <button type="button" class="btn btn-primary">Create Product</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($data['records'] as $datum)
                    <tr>
                        <td>{{$datum->id}}</td>
                        <td>{{$datum->name}}</td>
                        <td>{{$datum->price}}</td>
                        <td>{{$datum->stock}}</td>
                        <td>
                            <a href="{{route('product.add', $datum->id)}}">
                                <button type="button" class="btn btn-info">Add to stock</button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route('product.edit', $datum->id)}}">
                                <button type="button" class="btn btn-warning">Edit</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{route('category.index')}}">
                    <button type="button" class="btn btn-danger">Back to Categories</button>
                </a>
            </div>
        </div>
    </section>
@endsection
