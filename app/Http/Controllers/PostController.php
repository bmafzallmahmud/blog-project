<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
class PostController extends Controller
{

	public function index()
	{
	    $posts = Post::latest()->approved()->status()->paginate(12);
		return view('posts',compact('posts'));
	}
    public function details($slug)
    {
    	$post = Post::where('slug',$slug)->approved()->status()->first();
    	$blogKey = 'blog_'.$post->id;
    	if (!Session::has($blogKey)) {
    		$post->increment('view_count');
    		Session::put($blogKey,1);
    	}
    	$randomposts = Post::approved()->status()->take(3)->inRandomOrder()->get();
    	return view('post',compact('post','randomposts'));
    }
}
