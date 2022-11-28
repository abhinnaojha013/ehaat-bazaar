@extends('frontend.home')
@section('title', 'Sulav Haat Bazaar')
@section('main_content')
    <section>
        <script>
            function calculate_amount(i)
            {
                console.log('entered');
                let p = 'price' + i;
                let q = 'quantity' + i;
                let a = 'amount' + i;
                let price = parseFloat(document.getElementById(p).innerHTML);
                let quantity = parseFloat(document.getElementById(q).innerHTML);
                document.getElementById(a).innerHTML = price * quantity;
            }

            function total_sum()
            {
                let a = document.getElementsByClassName('amount');
                let s = 0;
                for(let i = 0; i < a.length; i++)
                {
                    s = s + parseFloat(a[i].innerHTML);
                }

                document.getElementById('total').innerHTML = s;
                document.getElementById('total_amt').value = s;

                if (s == 0)
                {
                    document.getElementById('pay').style.display = 'none';
                }
                else
                {
                    document.getElementById('pay').style.display = 'inline';

                }
            }
        </script>
{{--        @php--}}
{{--            echo $data['records'];--}}
{{--            @endphp--}}
        <table class="table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
                $orderId = 0;
            @endphp
                @foreach($data['records'] as $record)
                    @php
                        $orderId = $record->order_id;
                    @endphp

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$record->product}}</td>
                        <td>{{$record->category}}</td>
                        <td id="price{{$i}}">{{$record->price}}</td>
                        <td id="quantity{{$i}}">{{$record->quantity}}</td>
                        <td id="amount{{$i}}" class="amount">
                            <script>
                                calculate_amount({{$i}});
                            </script>
                        </td>
                        <td>
                            <form method="post" action="{{route('cart.remove')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$record->id}}">
                                <input type="submit" value="Remove" class="btn btn-outline-danger   ">
                            </form>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <form method="post" action="{{route('stripe.load')}}">
            @csrf
            <input type="hidden" name="total_amt" id="total_amt" value="0">
            <input type="hidden" name="order_id" id="order_id" value="{{$orderId}}">
            <div>
                <p>
                    Final amount = <span id="total"></span>.
                </p>
            </div>

            <div>
                <input type="submit" value="Pay with Stripe" id="pay" class="pay btn btn-success">
            </div>
        </form>
        <div style="margin-top: 20px">
            <a href="{{route('frontend.index', 1)}}">
                <button class="btn btn-warning">Go back</button>
            </a>
        </div>
        <script>total_sum()</script>
    </section>
@endsection
