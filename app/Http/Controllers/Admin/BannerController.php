<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $data = \App\Models\Banner::latest()->get();
        return view('admin.banners.index', compact('data'));
    }

    public function create()
    {
        return view('admin.banners.form');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'image' => 'nullable|image', 'mobile_image' => 'nullable|image']);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $request->file('image')->store('banners', 'public');
     if($request->hasFile('mobile_image')) $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
     $data['is_active'] = $request->has('is_active');
        \App\Models\Banner::create($data);
        return redirect()->route('admin.banners.index')->with('success', 'Data ditambahkan.');
    }

    public function edit($id)
    {
        $item = \App\Models\Banner::findOrFail($id);
        return view('admin.banners.form', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = \App\Models\Banner::findOrFail($id);
        $request->validate(['title' => 'required', 'image' => 'nullable|image', 'mobile_image' => 'nullable|image']);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $request->file('image')->store('banners', 'public');
     if($request->hasFile('mobile_image')) $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
     $data['is_active'] = $request->has('is_active');
        $item->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Data diupdate.');
    }

    public function destroy($id)
    {
        $item = \App\Models\Banner::findOrFail($id);
        if (isset($item->image) && $item->image) Storage::disk('public')->delete($item->image);
        if (isset($item->mobile_image) && $item->mobile_image) Storage::disk('public')->delete($item->mobile_image);
        $item->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Berhasil dihapus.');
    }
}