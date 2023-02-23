<?php

namespace App\Http\Controllers;

use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = News::getOrderedNews();

        return view('welcome', compact('latestNews'));
    }
}
