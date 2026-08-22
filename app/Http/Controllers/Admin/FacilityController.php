<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $data = \App\Models\Facility::latest()->get();
        return view('admin.facilities.index', compact('data'));
    }

    public function create()
    {
        return view('admin.facilities.form');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'image' => 'nullable|image', 'icon' => 'nullable|string']);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $request->file('image')->store('facilities', 'public');
     $data['is_active'] = $request->has('is_active');
        \App\Models\Facility::create($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Data ditambahkan.');
    }

    public function edit($id)
    {
        $item = \App\Models\Facility::findOrFail($id);
        return view('admin.facilities.form', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = \App\Models\Facility::findOrFail($id);
        $request->validate(['name' => 'required', 'image' => 'nullable|image', 'icon' => 'nullable|string']);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $request->file('image')->store('facilities', 'public');
     $data['is_active'] = $request->has('is_active');
        $item->update($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Data diupdate.');
    }

    public function destroy($id)
    {
        $item = \App\Models\Facility::findOrFail($id);
        if (isset($item->image) && $item->image) Storage::disk('public')->delete($item->image);
        if (isset($item->mobile_image) && $item->mobile_image) Storage::disk('public')->delete($item->mobile_image);
        $item->delete();
        return redirect()->route('admin.facilities.index')->with('success', 'Berhasil dihapus.');
    }
}