<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function __construct()
    {
        Session::put('currentLocal', 'en');
        App::setLocale('en');
    }

    public function index()
    {
        App::setLocale(Session::get('currentLocal'));
        $newses = Blog::with('blogTranslation','user')->where('status','approved')->orderBy('id','desc')->paginate(4);
        $popularTopics = BlogCategory::with('blogCategoryTranslation','blogs')->where('status',1)->get()->keyBy('id');
        $tags = Tag::with('tagTranslation','tagTranslationEnglish')->where('status',1)->get();
        return view('frontend.news',compact('newses','popularTopics','tags'));
    }

    public function show(Blog $news)
    {
        $popularTopics = BlogCategory::where('status',1)->get();
        $recentlyAddedPosts = Blog::latest()->take(3)->get();
        $tags = Tag::where('status',1)->get();
        return view('frontend.single-news',compact('news','popularTopics','recentlyAddedPosts','tags'));
    }

    public function searchBlogs(Request $request)
    {
        $blogs = Blog::where('title','LIKE','%'.$request->search.'%')->where('status','approved')->get();

        if(count($blogs) > 0)
        {
            foreach($blogs as $blog)
            {
                $createdAt = Carbon::parse($blog->created_at);

                $html = '
             <div class="col-md-6 col-sm-12">
                <div class="card single-blog-item v1">
                    <img src="storage/thumbnail/'.$blog->image.'" alt="...">
                    <div class="card-body">
                        <a href="#" class="blog-cat">'.$blog->category->name.'</a>
                        <h4 class="card-title"><a href="'.route('news.show',$blog).'">'.$blog->title.'</a></h4>
                    </div>
                    <div class="bottom-content">
                        <p>By<a href="#">'.$blog->user->f_name.'.'.$blog->user->l_name.'</a><span class="date">'.$createdAt->toFormattedDateString().'</span> </p>
                    </div>
                </div>
            </div>
            ';
                echo $html;
            }
        }else{
            $html = '<div class="col-md-6 col-sm-12">
                        <h1>No Results Found!</h1>
                     </div>';
            echo $html;
        }

    }
}
