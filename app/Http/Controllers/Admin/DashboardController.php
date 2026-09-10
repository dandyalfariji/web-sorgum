<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\Feature;
use App\Models\HeroSection;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles_count' => Article::count(),
            'products_count' => Product::count(),
            'partners_count' => Partner::count(),
            'team_count' => TeamMember::count(),
            'features_count' => Feature::count(),
            'hero_count' => HeroSection::count(),
        ];

        $recent_articles = Article::latest()->take(5)->get();
        $recent_products = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_articles', 'recent_products'));
    }
}
