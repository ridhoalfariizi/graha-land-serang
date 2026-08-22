<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $data = Lead::latest()->get();
        return view('admin.leads.index', compact('data'));
    }
    public function destroy($id)
    {
        Lead::findOrFail($id)->delete();
        return back()->with('success', 'Lead dihapus.');
    }
}