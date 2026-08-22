<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = \App\Models\Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('data'));
    }

    public function create()
    {
        return view('admin.testimonials.form');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'job_title' => 'nullable', 'content' => 'required', 'rating' => 'required|numeric', 'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240']);
        
        $data = $request->except(['_token', '_method']);
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['photo'] = $request->file('image')->store('testimonials', 'public');
        }
        unset($data['image']);
        
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        
        \App\Models\Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Data ditambahkan.');
    }

    public function edit($id)
    {
        $item = \App\Models\Testimonial::findOrFail($id);
        return view('admin.testimonials.form', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = \App\Models\Testimonial::findOrFail($id);
        $request->validate(['name' => 'required', 'job_title' => 'nullable', 'content' => 'required', 'rating' => 'required|numeric', 'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240']);
        
        $data = $request->except(['_token', '_method']);
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete old valid image if updating
            if ($item->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->photo);
            }
            $data['photo'] = $request->file('image')->store('testimonials', 'public');
        }
        unset($data['image']);
        
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        
        $item->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Data diupdate.');
    }

    public function destroy($id)
    {
        $item = \App\Models\Testimonial::findOrFail($id);
        if (isset($item->image) && $item->image) Storage::disk('public')->delete($item->image);
        $item->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Berhasil dihapus.');
    }
}