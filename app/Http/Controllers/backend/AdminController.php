<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data['records'] = DB::table('admins')
            ->join('users', 'admins.user', '=', 'users.id')
            ->select('admins.id as admin_id', 'users.id as user_id', 'users.name as user_name')
            ->get();

        return view('backend.admin.index', compact('data'));
    }


    public function create()
    {
        $data['records'] = DB::table('users')
            ->select('users.id as user_id', 'users.name as user_name')
            ->whereNotIn('users.id', function ($query){
                $query->select('user')->from('admins');
            })
            ->get();

        return view('backend.admin.create', compact('data'));
    }

    public function store(Request $request)
    {
        try{
            $record=Admin::create($request->all());
            if($record)
            {
                request()->session()->flash('success', "Admin created");
            }else{
                request()->session()->flash('error', "Admin creation failed");
                return redirect()->route('admin.create');
            }
        }
        catch(\Exception $exception){
            request()->session()->flash('error', "Admin creation failed");
        }
        return redirect()->route('admin.index');
    }
}
