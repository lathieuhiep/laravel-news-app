<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    // get list category post
	public function index()
	{
		$categories = Category::query()->paginate();
		
		return view('admin.category.list')->with('categories', $categories);
	}
}
