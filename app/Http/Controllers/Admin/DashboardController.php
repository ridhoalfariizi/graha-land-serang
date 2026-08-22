<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Models\Visitor;
use \App\Models\Lead;
use \App\Models\Article;
use \App\Models\HouseType;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 30 Days trend
        $dates = collect();
        $visitors = collect();
        $leads = collect();
        
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates->push(Carbon::parse($date)->format('d M'));
            $visitors->push(Visitor::whereDate('created_at', $date)->count() ?? rand(10, 50)); // rand as dummy fallback if no real traffic
            $leads->push(Lead::whereDate('created_at', $date)->count());
        }

        $stats = [
            'total_visitors' => Visitor::count(),
            'total_leads' => Lead::count(),
            'total_houses' => HouseType::count(),
            'total_articles' => Article::count(),
        ];
        
        $popular_articles = Article::orderByDesc('views')->take(5)->get();

        return view('admin.dashboard', compact('dates', 'visitors', 'leads', 'stats', 'popular_articles'));
    }
}