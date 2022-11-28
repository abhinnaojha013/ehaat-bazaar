@extends('frontend.home')
@section('title', 'Sulav Haat Bazaar')
@section('main_content')
   <section>
       <script>
           let c_cat = {{$data['c_cat']}};
           function cat_sel()
           {
               document.getElementById('cat' + c_cat).style.background = 'rgba(128,0,0,0.5)';
           }
           function calculate_amount(i)
           {
               let p = 'price' + i;
               let q = 'quantity' + i;
               let a = 'amount' + i;
               let price = parseFloat(document.getElementById(p).innerHTML);
               let quantity = parseFloat(document.getElementById(q).value);
               document.getElementById(a).innerHTML = price * quantity;
           }
       </script>
       {{--        error messages--}}
       <div style="height: 60px">
           <div style="display: flex; justify-content: center">
               <a href="{{route('cart.view')}}"
               style="color: orange">
                   <i class="fa fa-cart-arrow-down" aria-hidden="true" style="font-size: 40px" id="cart_icon"
                   onmouseover="cart_hover()" onmouseout="cart_unhover()"></i>
               </a>
           </div>
           <div>

           </div>
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
       <div style="display: flex; flex-direction: row;">
           <div style="flex-basis: 25%;">
               @foreach($data['categories'] as $category)
                   <a href="{{route('frontend.index', $category->id)}}"
                      style="font-size: 1rem;
                                text-decoration: none;
                                text-transform: capitalize;
                                color: gray;">
                       <div class="cat cat{{$category->id}}" id="cat{{$category->id}}"
                            style="margin-top: 3px; margin-bottom: 3px; padding: 0px 6px; border-radius: 5px ; background: rgba(128,0,0,0.2);"
                            onmouseover="hover({{$category->id}})" onmouseout="unhover({{$category->id}})">
                               <span style="color: darkblue">
                                   {{$category->name}}
                               </span>
                       </div>
                   </a>

               @endforeach
           </div>

           <div>

                   <table class="table table-hover">
                       <thead>
                            <tr>
                               <th>SN</th>
                               <th>Name</th>
                               <th>Price</th>
                               <th>Quantity</th>
                               <th>Amount</th>
                               <th></th>
                            </tr>
                       </thead>
                       @php
                           $c_cat = 0;
                           $i = 1;
                       @endphp
                       <tbody>
                       @foreach($data['products'] as $product)
                           <form method="post" action="{{route('cart.add')}}">
                               @csrf
                               <tr>
                                   <td>{{$i}}</td>
                                   <td>
                                       <input type="hidden" name="product" value="{{$product->id}}">
                                       <input type="hidden" name="category" value="{{$product->category}}" class="c_cat">
                                       {{$product->name}}
                                   </td>
                                   <td id="price{{$i}}">{{$product->price}}</td>
                                   <td>
                                       <select id="quantity{{$i}}" onchange="calculate_amount({{$i}})" name="quantity">
                                           <option value="0.5">0.5</option>
                                           <option value="1.0">1.0</option>
                                           <option value="1.5">1.5</option>
                                           <option value="2.0">2.0</option>
                                           <option value="2.5">2.5</option>
                                           <option value="3.0">3.0</option>
                                       </select>
                                   </td>
                                   <td id="amount{{$i}}">
                                       <script>
                                           calculate_amount({{$i}});
                                       </script>
                                   </td>
                                   <td>
                                           <input type="submit" value="Add to Cart" class="btn btn-outline-success">

                                   </td>
                               </tr>
                           </form>
                           @php
                               $i++
                           @endphp
                       @endforeach
                       </tbody>
                   </table>


           </div>
       </div>
       <script>
           cat_sel();
           function hover(c)
           {
               document.getElementById('cat' + c).style.background = 'rgba(128,0,0,0.5)'
           }
           function unhover(c)
           {
               document.getElementById('cat' + c).style.background = 'rgba(128,0,0,0.2)'
               cat_sel();
           }
           function cart_hover()
           {
               document.getElementById('cart_icon').style.fontSize = '50px';
               document.getElementById('cart_icon').style.color = 'darkgoldenrod';
               document.getElementById('cart_icon').style.transitionDuration = '300ms';
               document.getElementById('cart_icon').style.transitionDelay = '100ms';
           }
           function cart_unhover()
           {
               document.getElementById('cart_icon').style.fontSize = '40px';
               document.getElementById('cart_icon').style.color = 'orange';
               document.getElementById('cart_icon').style.transitionDuration = '300ms';
               document.getElementById('cart_icon').style.transitionDelay = '100ms';
           }
       </script>

   </section>
@endsection
