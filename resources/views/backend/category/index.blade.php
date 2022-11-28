@extends('backend.home')
@section('title', 'Category - Home')
@section('main_content')
    <section>
        <div>
            <h1>Category page</h1>
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

        <div style="display: flex; flex-direction: row">
            <div>
                <a href="{{route('category.create')}}">
                    <button type="button" class="btn btn-primary">Create Category</button>
                </a>
            </div>
            <div style="margin-left: 30px"></div>
            <div>
                <a href="{{route('product.create')}}">
                    <button type="button" class="btn btn-primary">Create Product</button>
                </a>
            </div>
        </div>

        <div>
            <table class="table">
                <thead>
                <th>id</th>
                <th>Category name</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($data['records'] as $datum)
                    <tr>
                        <td>{{$datum->id}}</td>
                        <td>
                            <a href="{{route("product.index",$datum->id)}}">
                                {{$datum->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('category.edit', $datum->id)}}">
                                <button type="button" class="btn btn-warning">Edit</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
