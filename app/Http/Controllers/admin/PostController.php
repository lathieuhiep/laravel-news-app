<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	
	// get post list
	public function index()
	{
		$dataPost = Post::query()->paginate();
		
		return view('admin.posts.list')->with('dataPost', $dataPost);
	}
	
	// create post
	public function create()
	{
		$getCategories = Category::all();
		
		return view('admin.posts.create')->with('categories', $getCategories);
	}
}
