<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getNews()
    {
        $news = News::all();
        return $news;
    }
}
