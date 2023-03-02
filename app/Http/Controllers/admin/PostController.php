<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
		$data = [];
		// get user list management
		$users = new User();
		$data['users'] = $users->getManagementUsers();
		
		// get data categories
		$data['categories'] = Category::all();
		
		return view('admin.posts.create')->with( $data );
	}
	
	// store a new post
	
	/**
	 * @throws Exception
	 */
	public function store(Request $request)
	{
		DB::beginTransaction();
		
		try {
			
			
			DB::commit();
		} catch (Exception $e) {
			DB::rollBack();
			
			throw new Exception($e->getMessage());
		}
	}
}
