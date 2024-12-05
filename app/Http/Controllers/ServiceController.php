<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $service = Service::all();
        return view('service.index', compact('service'));
    }
    public function edit(Service $service)
    {
        //
    }
    public function create(){
        return view('service.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'price' => 'required|numeric',
            'duration_minutes' => 'required|integer',
            'category' => 'required|in:manicure,pedicure,nail_art,treatment',
            'photo' => 'required|image|max:2048'
        ]);

        if(!$request->hasFile('photo')){
            return back()->withError(['photo' => 'Photo is requiered']);
        }
        // Generate a unique filename
        $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
        
        // Store the file with the generated filename
        $photoPath = $request->file('photo')->storeAs('services', $filename, 'public');
        
        $validated['photo'] = $photoPath;

        Service::create($validated);

        return redirect()->route('service.index')->with('success', 'Service created successfully');
     }

    public function destroy(Service $service){
        $service->delete();
        return redirect()->route('service.index');
    }
}
