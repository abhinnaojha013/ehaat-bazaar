@extends('backend.home')
@section('title', 'Product - Add')
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

        <form action="{{route('product.insert', $data['record'][0]->id)}}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div style="text-transform: capitalize">
                <div>
                    <p>
                        {{$data['record'][0]->name}}, {{$data['record'][0]->cat_name}}
                        <input type="hidden" name="name" value="{{$data['record'][0]->name}}">
                        <input type="hidden" name="category" value="{{$data['record'][0]->category}}">
                    </p>
                </div>
                <div>
                    <p>Current Stock: {{$data['record'][0]->stock}}</p>
                    <input type="hidden" id="old_stock" value="{{$data['record'][0]->stock}}">
                </div>
                <div>
                    <label for="stock">Add to stock:</label>
                </div>
                <div>
                    <input type="number" step="1" min="1" onchange="calc_new_stock()" id="new_stock">
                    <input type="hidden" name="stock" id="stock">
                </div>
            </div>
            <div style="margin-top: 20px">
                <input type="submit" value="Add to stock" class="btn btn-success">
            </div>
        </form>
        <div style="margin-top: 20px">
            <a href="{{route('product.index', $data['record'][0]->category)}}">
                <button type="button" class="btn btn-danger">Back to Products</button>
            </a>
        </div>
    </div>
    <script>
        function calc_new_stock()
        {
            let old_stock = parseInt(document.getElementById('old_stock').value);
            let new_stock = parseInt(document.getElementById('new_stock').value);
            document.getElementById('stock').value = old_stock + new_stock;
        }
    </script>
</section>
@endsection
