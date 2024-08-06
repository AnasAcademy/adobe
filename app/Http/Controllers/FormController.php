<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }
    
}