<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function profile($username)
    {
    	// return $author = User::where('user_name',$username)->first()->posts()->approved()->status()->get();
    	$author = User::where('user_name',$username)->first();
    	$posts = $author->posts()->approved()->status()->get();
    	return view('profile',compact('author','posts'));
    }
}
