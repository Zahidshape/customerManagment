<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('upload.form');
        } else {
            return redirect()->route('login');
        }
        
    }

}
    


