<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class FrontEnd extends Controller
{
    //this controller manages the frontend view

    public function index()
    {
        return view('welcome')->with('articles', Article::all());
    }

    public function admin()
    {
        return view('admin');
    }
}
