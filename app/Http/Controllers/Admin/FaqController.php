<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index()
    {
        $data = \App\Models\Faq::latest()->get();
        return view('admin.faqs.index', compact('data'));
    }

    public function create()
    {
        return view('admin.faqs.form');
    }

    public function store(Request $request)
    {
        $request->validate(['question' => 'required', 'answer' => 'required', 'category' => 'required']);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        \App\Models\Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'Data ditambahkan.');
    }

    public function edit($id)
    {
        $item = \App\Models\Faq::findOrFail($id);
        return view('admin.faqs.form', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = \App\Models\Faq::findOrFail($id);
        $request->validate(['question' => 'required', 'answer' => 'required', 'category' => 'required']);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $item->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'Data diupdate.');
    }

    public function destroy($id)
    {
        $item = \App\Models\Faq::findOrFail($id);
        if (isset($item->image) && $item->image) Storage::disk('public')->delete($item->image);
        if (isset($item->mobile_image) && $item->mobile_image) Storage::disk('public')->delete($item->mobile_image);
        $item->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Berhasil dihapus.');
    }
}