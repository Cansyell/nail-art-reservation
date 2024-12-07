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
    public function create(){
        //
    }
    public function reservation(Request $request){
        $selectedService = Service::findOrFail($request->input('service'));
        $services = Service::all();
        

        return view('front.reservation', compact('services','selectedService'));
    }
}
