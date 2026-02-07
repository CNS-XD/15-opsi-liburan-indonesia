<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Blog;

class NewsController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('show', Blog::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.frontsite.news.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('show', Blog::SHOW['publish'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedBlogs = Blog::where('show', Blog::SHOW['publish'])
            ->where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('pages.frontsite.news.show', compact('blog', 'relatedBlogs'));
    }
}
