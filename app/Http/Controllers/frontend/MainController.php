<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Category;
use App\Models\backend\Order;
use App\Models\backend\Order_Item;
use App\Models\backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class MainController extends Controller
{
    public function index($id)
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::all()->where('category', '=',$id);
        $data['c_cat'] = $id;
        return view('frontend.index', compact('data'));
    }

    //payment, order, order_items
    public function add(Request $request)
    {
        $userId = Auth::id();
        $data['order'] = DB::table('orders')
            ->where('payment', '=', 1)
            ->where('user','=', $userId)
            ->select('id')
            ->get();

        if ($data['order']->isNotEmpty())
        {
            $data['order_items'] = Order_Item::all()
                ->where('order', '=', $data['order'][0]->id)
                ->where('product','=', $request->get('product'));

            if ($data['order_items']->isNotEmpty())
            {
                request()->session()->flash('error',"Multiple order of same product being made.");
                return redirect()->route('frontend.index', $request->get('category'));
            }
        }

        if (!$data['order']->isNotEmpty())
        {
            DB::table('orders')
                ->insert(
                    ['user' => $userId,
                        'payment' => 1]
                );

            $data['order'] = DB::table('orders')
                ->where('payment', '=', 1)
                ->where('user','=', $userId)
                ->select('id')
                ->get();

            DB::table('order_items')
                ->insert(
                    ['order' => $data['order'][0]->id,
                        'product' => $request->get('product'),
                        'quantity' => $request->get('quantity')]
                );
        }
        else
        {
            $data['order'] = DB::table('orders')
                ->where('payment', '=', 1)
                ->where('user','=', $userId)
                ->select('id')
                ->get();

            DB::table('order_items')
                ->insert(
                    ['order' => $data['order'][0]->id,
                        'product' => $request->get('product'),
                        'quantity' => $request->get('quantity')]
                );
        }
        request()->session()->flash('success',"Added to cart.");
        return redirect()->route('frontend.index', $request->get('category'));
    }

    //view cart items
    public function view()
    {
        $userId = Auth::id();

        $data['order'] = DB::table('orders')
            ->where('payment', '=', 1)
            ->where('user','=', $userId)
            ->select('id')
            ->get();

        if (!$data['order']->isNotEmpty()) {
            DB::table('orders')
                ->insert(
                    ['user' => $userId,
                        'payment' => 1]
                );
        }


        $data['records'] = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order')
            ->join('payments', 'orders.payment', '=', 'payments.id')
            ->join('products', 'order_items.product', '=', 'products.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->where('orders.payment','=', 1)
            ->where('orders.user','=', $userId)
            ->select(
                'order_items.id as id',
                'orders.id as order_id',
                'products.name as product',
                'categories.name as category',
                'products.price as price',
                'order_items.quantity as quantity'
            )
            ->orderBy('order_items.id')
            ->get();

        return view('frontend.cart', compact('data'));
 }

    //remove orders after cancelling
    public function remove(Request $request)
    {
        DB::table('order_items')
            ->where('id', '=', $request->get('id'))
            ->delete();
        return redirect()->route('cart.view',);

    }

    public function redir()
    {
        return redirect()->route('frontend.index', 1);
    }
}
