@extends('backend.home')
@section('title', 'Products - Edit - '. $data['record']->id . '. ' . $data['record']->name)
@section('main_content')
    <section>
        <div>
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

            <form action="{{route('product.update', $data['record']->id)}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div>
                    <div>
                        <label name="name">Product name:</label>
                    </div>
                    <div>
                        <input type="text" name="name" value="{{$data['record']->name}}"/>
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
                        <input type="number" name="price" min="0.01" step="0.01" value="{{$data['record']->price}}"/>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <input type="submit" value="Update product" class="btn btn-success">
                </div>
            </form>
            <div style="margin-top: 20px">
                <a href="{{route('product.index',$data['record']->category)}}">
                    <button type="button" class="btn btn-danger">Back to Products</button>
                </a>
            </div>
        </div>
    </section>
@endsection
