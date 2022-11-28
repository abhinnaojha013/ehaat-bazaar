@extends('backend.home')
@section('title', 'Admin - Create')
@section('main_content')
    <section>
        <div>
            <div>
                <h1>Admin page</h1>
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

            <form action="{{route('admin.store')}}" method="POST">
                @csrf
                <div>
                    <div>
                        <label name="user">Username:</label>
                    </div>
                    <div>
                        <select name="user">
                            <option value="0">-select user-</option>
                            @foreach($data['records'] as $datum)
                                <option value="{{$datum->user_id}}">{{$datum->user_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Make admin" class="btn btn-success">
                </div>
            </form>
            <div>
                <a href="{{route('admin.index')}}">
                    <button type="button" class="btn btn-danger">Back to admin</button>
                </a>
            </div>
        </div>
    </section>
@endsection
