<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
			$post = Post::create([
                'user_id' => Auth::user()->id,
                'title' => $request->input('title'),
                'slug' => Str::of( $request->input('title') )->slug('-'),
                'content' => $request->input('content'),
                'excerpt' => $request->input('excerpt'),
                'status' => Config::get('constants.POST_STATUS.PUBLISH')
            ]);

            $post->addMediaFromRequest('image')->toMediaCollection();

            $post_id = $post->id;
            $category_ids = $request->input('post_category');

            foreach ($category_ids as $category_id ) {
                CategoryPost::create([
                    'category_id' => $category_id,
                    'post_id' => $post_id
                ]);
            }

			DB::commit();
		} catch (Exception $e) {
			DB::rollBack();

			throw new Exception($e->getMessage());
		}
	}
}
