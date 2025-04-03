<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['user'])->get();

        return response()->json([
            'data' => $articles
        ]);
    }
}
