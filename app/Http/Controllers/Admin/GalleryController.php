<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:image,video',
            'video_url' => 'required_if:type,video|nullable|url',
            'images.*' => 'required_if:type,image|nullable|image|max:2048',
            'category' => 'required|string'
        ]);

        $lastOrder = Gallery::max('sort_order') ?? 0;

        if ($request->type === 'video') {
            $lastOrder++;
            Gallery::create([
                'image' => 'external_video',
                'type' => 'video',
                'video_url' => $request->video_url,
                'category' => $request->category,
                'sort_order' => $lastOrder
            ]);
            return redirect()->back()->with('success', 'Video Galeri berhasil ditambahkan.');
        } else {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('galleries', 'public');
                    $lastOrder++;
                    Gallery::create([
                        'image' => $path,
                        'type' => 'image',
                        'category' => $request->category,
                        'sort_order' => $lastOrder
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Foto Galeri berhasil diunggah.');
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->delete();
        }
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $index => $id) {
            Gallery::where('id', $id)->update(['sort_order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
    
    public function destroyMass(Request $request)
    {
        $ids = $request->ids ?? [];
        $galleries = Gallery::whereIn('id', $ids)->get();
        foreach ($galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->delete();
        }
        return response()->json(['success' => true]);
    }
}