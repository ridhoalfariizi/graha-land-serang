<?php

namespace App\Http\Controllers;

use App\Models\{Setting, HouseType, Facility, Gallery, Article, Faq, Promo, Testimonial, Lead};
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private function getSettings()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function index()
    {
        $settings = $this->getSettings();
        $promos = Promo::where('is_active', true)->get();
        $houses = HouseType::take(3)->get();
        $facilities = Facility::take(4)->get();
        $galleries = Gallery::inRandomOrder()->take(6)->get();
        $articles = Article::where('status', 'published')
                           ->where('published_at', '<=', now())
                           ->latest('published_at')
                           ->take(3)
                           ->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(6)->get();
        $faqs = Faq::orderBy('sort_order')->take(5)->get();

        return view('pages.home', compact('settings', 'promos', 'houses', 'facilities', 'galleries', 'articles', 'testimonials', 'faqs'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('pages.about', compact('settings'));
    }

    public function houseTypes()
    {
        $settings = $this->getSettings();
        $houses = HouseType::all();
        return view('pages.house-types.index', compact('settings', 'houses'));
    }

    public function houseTypeDetail($slug)
    {
        $settings = $this->getSettings();
        $house = HouseType::where('slug', $slug)->firstOrFail();
        return view('pages.house-types.show', compact('settings', 'house'));
    }

    public function facilities()
    {
        $settings = $this->getSettings();
        $facilities = Facility::all();
        return view('pages.facilities', compact('settings', 'facilities'));
    }

    public function location()
    {
        $settings = $this->getSettings();
        return view('pages.location', compact('settings'));
    }

    public function gallery()
    {
        $settings = $this->getSettings();
        $galleries = Gallery::latest()->get();
        $groupedGalleries = $galleries->groupBy('category');
        return view('pages.gallery', compact('settings', 'groupedGalleries'));
    }

    public function articles(Request $request)
    {
        $settings = $this->getSettings();
        
        $query = Article::where('status', 'published')
                        ->where('published_at', '<=', now());
                        
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $articles = $query->latest('published_at')
                          ->paginate(9)->withQueryString();
                          
        $categories = Article::where('status', 'published')->select('category')->distinct()->pluck('category');
        
        return view('pages.articles.index', compact('settings', 'articles', 'categories'));
    }

    public function articleDetail($slug)
    {
        $settings = $this->getSettings();
        $article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $relatedArticles = Article::where('status', 'published')
                                  ->where('id', '!=', $article->id)
                                  ->where('category', $article->category)
                                  ->take(3)->get();
        return view('pages.articles.show', compact('settings', 'article', 'relatedArticles'));
    }

    public function faq()
    {
        $settings = $this->getSettings();
        $faqs = Faq::orderBy('sort_order')->get();
        return view('pages.faq', compact('settings', 'faqs'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('pages.contact', compact('settings'));
    }

    public function storeLead(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'message' => 'nullable|string'
        ]);

        Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}
