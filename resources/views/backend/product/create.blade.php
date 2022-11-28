@extends('backend.home')
@section('title', 'Product - Create')
@section('main_content')
    <section>
        <div>
            <div>
                <h1>Product page</h1>
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
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div>
                    <div>
                        <label name="name">Product name:</label>
                    </div>
                    <div>
                        <input type="text" name="name"/>
                    </div>
                    <div>
                        <label for="category">Category:</label>
                    </div>
                    <div>
                        <select name="category" id="category">
                            @foreach($data['categories'] as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label name="price">Product price:</label>
                    </div>
                    <div>
                        <input type="number" name="price" min="0.01" step="0.01"/>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <input type="submit" value="Make new product" class="btn btn-success">
                </div>
            </form>
            <div style="margin-top: 20px">
                <a href="{{route('category.index')}}">
                    <button type="button" class="btn btn-danger">Back to Categories</button>
                </a>
            </div>
        </div>
    </section>
@endsection
