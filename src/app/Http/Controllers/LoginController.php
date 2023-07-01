<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        $user = Auth::user();
        $name = $user->name;
    return view('timestamps', compact('name','user'));
}

}