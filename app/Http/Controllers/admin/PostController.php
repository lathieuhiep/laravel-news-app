<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
	private $userRepository;
	private $postRepository;
	private $categoryRepository;
	
	public function __construct(
		UserRepositoryInterface $userRepository,
		PostRepositoryInterface $postRepository,
		CategoryRepositoryInterface $categoryRepository
	)
	{
		$this->userRepository = $userRepository;
		$this->postRepository = $postRepository;
		$this->categoryRepository = $categoryRepository;
	}

	// get post list
	public function index()
	{
		$dataPost = $this->postRepository->paginate();

		return view('admin.posts.list')->with('dataPost', $dataPost);
	}

	// create post
	public function create()
	{
		$data = [];
		
		// get user list management
		$data['users'] = $this->userRepository->getManagementUsers();

		// get data categories
		$data['categories'] = $this->categoryRepository->all();

		return view('admin.posts.create')->with( $data );
	}

	// store a new post

	/**
	 * @throws Exception
	 */
	public function store(Request $request)
	{
		$data = $this->postRepository->create($request);
	
		if ( empty( $data ) ) {
			return abort( Config::get('constants.BAD_REQUEST') );
		}
		
		return redirect()->route('admin.post.index');
	}
}
