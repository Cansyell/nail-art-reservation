<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(){
        $service = Service::all();
        return view('service.index', compact('service'));
    }
    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
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
     public function update(Request $request, Service $service){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'category' => 'required|in:manicure,pedicure,nail_art,treatment',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($service->photo && Storage::exists($service->photo)) {
                Storage::delete($service->photo);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('service_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Update service
        $service->update($validatedData);

        return redirect()->route('service.index')
            ->with('success', 'Service updated successfully.');
    
    }
    public function destroy(Service $service){

        if ($service->photo && Storage::exists($service->photo)) {
            Storage::delete($service->photo);
        }

        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service deleted successfully.');
    }
}
