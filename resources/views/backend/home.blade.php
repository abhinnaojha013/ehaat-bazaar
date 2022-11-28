@extends('layouts.app')

@section('content')
    @php
        $admin = \Illuminate\Support\Facades\DB::table('admins')
                    ->where('user', '=', \Illuminate\Support\Facades\Auth::id())
                    ->get();
    @endphp
    @if($admin->isEmpty())
        <script>
            window.location.href = "{{route('frontend.index', 1)}}";
        </script>
    @endif

    @guest
        @if (Route::has('login') || Route::has('register'))
            <div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <section>
                                        <div style="text-align: center; padding: 10px">
                                            <p>
                                                Please login or signup.
                                            </p>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                @yield('main_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
