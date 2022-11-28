<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Category;
use App\Models\backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->model = new Product();
    }

    public function index($id)
    {
        $data['records'] = $this->model::all()
            ->where('category','=',$id);
        $data['category'] = Category::find($id);
//        $data['records'] = DB::table('products')
//            ->join('categories','products.category','=','categories.id')
//            ->select('products.id as id',
//                'products.name as name',
//                'categories.name as category')
//            ->get();
        return view('backend.product.index', compact('data'));
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')
            ->select('id', 'name')
            ->get();
        return view('backend.product.create', compact('data'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'=>'required|unique:products,name'
            ]);
            $record = $this->model::create($request->all());

            if($record)
            {
                request()->session()->flash('success', "Product created");
            }else{
                request()->session()->flash('error', "Product creation failed");
                return redirect()->route('product.create');
            }
        }
        catch(\Exception $exception){
            request()->session()->flash('error', "Product creation failed");
            return redirect()->route('product.create');
        }
        return redirect()->route('product.index', $record->category);
    }


    public function edit($id)
    {
        $data['record'] = $this->model::find($id);
        $data['categories'] = DB::table('categories')
            ->select('id', 'name')
            ->get();

        if(!$data['record'])
        {
            request()->session()->flash('error',"Data not found, please enter a valid request.");
            return redirect()->route('category.index');
        }
        return view('backend.product.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name'=>'required'
            ]);
            $data['record']=$this->model::find($id);
            if(!$data['record']){
                request()->session()->flash('error',"Data not found, please enter a valid request.");
                return redirect()->route('category.index');

            }
            $record=$data['record']->update($request->all());
            if($record)
            {
                request()->session()->flash('success',"Product updated");
            }else{
                request()->session()->flash('error',"Product update failed");
                return redirect()->route('product.edit', $id);
            }
        }
        catch(\Exception $exception){
            request()->session()->flash('error',"Product update failed");
            return redirect()->route('product.edit', $id);
        }
        return redirect()->route('category.index');
    }

    public function add($id)
    {
        $data['record'] = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.id as id',
                'products.name as name',
                'products.category as category',
                'products.stock as stock',
                'categories.name as cat_name')
            ->where('products.id', '=', $id)
            ->get();
        if(!$data['record'])
        {
            request()->session()->flash('error',"Data not found, please enter a valid request.");
            return redirect()->route('category.index');
        }
        return view('backend.product.add', compact('data'));
    }

    public function insert(Request $request, $id)
    {
        try{
            $request->validate([
                'stock'=>'required'
            ]);
            $data['record']=$this->model::find($id);
            if(!$data['record']){
                request()->session()->flash('error',"Data not found, please enter a valid request.");
                return redirect()->route('product.index');
            }
            $record=$data['record']->update($request->all());
            if($record)
            {
                request()->session()->flash('success',"Product updated");
            }else{
                request()->session()->flash('error',"Product update failed");
                return redirect()->route('product.add');
            }
        }
        catch(\Exception $exception){
//            request()->session()->flash('error',$exception->getMessage());
            request()->session()->flash('error',"Product update failed");
            return redirect()->route('product.add', $id);
        }
        return redirect()->route('category.index');
    }
}
