<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class FrontController extends Controller
{
    public function index(){
        $services = Service::all();
        return view('front.index', compact('services'));
    }

}
