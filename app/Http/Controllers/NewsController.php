<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    public function getNews()
    {
        $news = News::orderBy('date', 'desc')->take(10)->get();
        return $news;
    }
}
