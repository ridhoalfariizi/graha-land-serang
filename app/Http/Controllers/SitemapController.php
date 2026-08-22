<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\HouseType;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];
        $domain = url('/');

        // Static routes
        $urls[] = ['loc' => $domain, 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'];
        $urls[] = ['loc' => $domain . '/house-types', 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'];
        $urls[] = ['loc' => $domain . '/facilities', 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.8'];
        $urls[] = ['loc' => $domain . '/gallery', 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['loc' => $domain . '/articles', 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.8'];

        // Dynamic House Types
        $houseTypes = HouseType::all();
        foreach ($houseTypes as $house) {
            $urls[] = [
                'loc' => $domain . '/house-types/' . $house->slug,
                'lastmod' => $house->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ];
        }

        // Dynamic Articles
        $articles = Article::where('status', 'published')->get();
        foreach ($articles as $article) {
            $urls[] = [
                'loc' => $domain . '/articles/' . $article->slug,
                'lastmod' => $article->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            if(isset($url['lastmod'])) { $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>'; }
            if(isset($url['changefreq'])) { $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>'; }
            if(isset($url['priority'])) { $xml .= '<priority>' . $url['priority'] . '</priority>'; }
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
