@extends('backend.home')
@section('title', 'Category - Edit - '. $data['record']->id . '. ' . $data['record']->name)
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

            <form action="{{route('category.update', $data['record']->id)}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div>
                    <div>
                        <label name="name">Category name:</label>
                    </div>
                    <div>
                        <input type="text" name="name" value="{{$data['record']->name}}"/>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <input type="submit" value="Update category" class="btn btn-success">
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
