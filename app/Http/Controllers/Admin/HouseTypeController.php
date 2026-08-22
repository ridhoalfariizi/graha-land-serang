<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\HouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HouseTypeController extends Controller
{
    public function index()
    {
        $houses = HouseType::latest()->get();
        return view('admin.house-types.index', compact('houses'));
    }

    public function create()
    {
        return view('admin.house-types.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'building_size' => 'required|numeric',
            'land_size' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'images.*' => 'nullable|image',
            'floor_plan_image' => 'nullable|image'
        ]);

        $data = $request->except(['images', 'floor_plan_image', 'features']);
        
        // Buat slug unik
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (HouseType::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;
        
        $data['features'] = $request->features ? array_filter($request->features) : [];

        if ($request->hasFile('floor_plan_image')) {
            $data['floor_plan_image'] = $request->file('floor_plan_image')->store('houses', 'public');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('houses', 'public');
            }
            $data['images'] = $images;
        }

        HouseType::create($data);
        return redirect()->route('admin.house-types.index')->with('success', 'Tipe Rumah berhasil ditambahkan.');
    }

    public function edit(HouseType $houseType)
    {
        return view('admin.house-types.form', ['house' => $houseType]);
    }

    public function update(Request $request, HouseType $houseType)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'building_size' => 'required|numeric',
            'land_size' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'required|string',
            'features' => 'nullable|array',
        ]);

        $data = $request->except(['images', 'floor_plan_image', 'features']);
        
        // Buat slug unik untuk update (pengecualian ID yang sama)
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (HouseType::where('slug', $slug)->where('id', '!=', $houseType->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $data['features'] = $request->features ? array_filter($request->features) : [];

        if ($request->hasFile('floor_plan_image')) {
            if ($houseType->floor_plan_image) Storage::disk('public')->delete($houseType->floor_plan_image);
            $data['floor_plan_image'] = $request->file('floor_plan_image')->store('houses', 'public');
        }

        if ($request->hasFile('images')) {
            if ($houseType->images) {
                foreach ($houseType->images as $img) Storage::disk('public')->delete($img);
            }
            $images = [];
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('houses', 'public');
            }
            $data['images'] = $images;
        }

        $houseType->update($data);
        return redirect()->route('admin.house-types.index')->with('success', 'Tipe Rumah berhasil diupdate.');
    }

    public function destroy(HouseType $houseType)
    {
        if ($houseType->floor_plan_image) Storage::disk('public')->delete($houseType->floor_plan_image);
        if ($houseType->images) {
            foreach ($houseType->images as $img) Storage::disk('public')->delete($img);
        }
        $houseType->delete();
        return redirect()->route('admin.house-types.index')->with('success', 'Berhasil dihapus.');
    }
}