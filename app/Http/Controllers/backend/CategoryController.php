<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new Category();
    }

    public function index()
    {
        $data['records'] = $this->model::all();
        return view('backend.category.index', compact('data'));
    }


    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'=>'required|unique:categories,name'
            ]);
            $record = $this->model::create($request->all());
            if($record)
            {
                request()->session()->flash('success', "Category created");
            }else{
                request()->session()->flash('error', "Category creation failed");
                return redirect()->route('category.create');
            }
        }
        catch(\Exception $exception){
            request()->session()->flash('error', "Category creation failed");
            return redirect()->route('category.create');

        }
        return redirect()->route('category.index');
    }


    public function edit($id)
    {
        $data['record'] = $this->model::find($id);

        if(!$data['record'])
        {
            request()->session()->flash('error',"Data not found, please enter a valid request.");
            return redirect()->route('category.index');
        }
        return view('backend.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name'=>'required|unique:categories,name'
            ]);
            $data['record']=$this->model::find($id);
            if(!$data['record' ]){
                request()->session()->flash('error',"Data not found, please enter a valid request.");
                return redirect()->route('category.index');
            }
            $record=$data['record']->update($request->all());
            if($record)
            {
                request()->session()->flash('success',"Category updated");
            }else{
                request()->session()->flash('error',"Category update failed");
                return redirect()->route('category.edit', $id);
            }
        }
        catch(\Exception $exception){
            request()->session()->flash('error',"Category update failed");
            return redirect()->route('category.edit',   $id);
        }
        return redirect()->route('category.index');
    }
}

