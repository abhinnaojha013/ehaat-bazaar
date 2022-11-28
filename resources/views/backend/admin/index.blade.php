@extends('backend.home')
@section('title', 'Admin - Home')
@section('main_content')
    <section>
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

        <div>
            <a href="{{route('admin.create')}}" class="flex justify-center">
                <button type="button" class="btn btn-primary">Create Admin</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                <th>admin id</th>
                <th>user id</th>
                <th>username</th>
                </thead>
                <tbody>
                @foreach($data['records'] as $datum)
                    <tr>
                        <td>{{$datum->admin_id}}</td>
                        <td>{{$datum->user_id}}</td>
                        <td>{{$datum->user_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
