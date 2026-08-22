<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::latest()->get();
        return view('admin.articles.index', compact('data'));
    }

    public function create()
    {
        return view('admin.articles.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);
        $data = $request->except(['tags', 'image']);
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;
        
        if ($request->hasFile('image')) {
            $data['thumbnail'] = $request->file('image')->store('articles', 'public');
        }
        
        $data['tags'] = $request->tags ? explode(',', $request->tags) : [];
        $data['status'] = $request->status ?? 'draft';
        
        $data['author_id'] = auth()->id() ?? 1;
        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }
        
        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit($id)
    {
        $item = Article::findOrFail($id);
        return view('admin.articles.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Article::findOrFail($id);
        $request->validate(['title' => 'required', 'content' => 'required', 'image' => 'nullable|image']);
        $data = $request->except(['tags', 'image']);
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $counter = 1;
        while (Article::where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            if ($item->thumbnail) Storage::disk('public')->delete($item->thumbnail);
            $data['thumbnail'] = $request->file('image')->store('articles', 'public');
        }
        $data['tags'] = $request->tags ? explode(',', $request->tags) : [];
        $data['status'] = $request->status ?? 'draft';
        if ($data['status'] === 'published' && !$item->published_at) {
            $data['published_at'] = now();
        }
        $item->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel diperbarui.');
    }

    public function destroy($id)
    {
        $item = Article::findOrFail($id);
        if ($item->thumbnail) Storage::disk('public')->delete($item->thumbnail);
        $item->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Berhasil dihapus.');
    }
}