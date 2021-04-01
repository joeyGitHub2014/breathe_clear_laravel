<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountUserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List users
        return view('users');    
    }
    public function edit()
    {
        return view('users');    
    }
    public function create()
    {
        return view('users');    
    }
    public function destroy()
    {
        return view('users');    
    }
    public function profile() {
        return view('profile');
    }
}
