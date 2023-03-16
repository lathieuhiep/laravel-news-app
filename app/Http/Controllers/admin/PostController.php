<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
		$dataPost = $this->postRepository->with(['author', 'categories'])->paginate();

		return view('admin.posts.list')->with('dataPost', $dataPost);
	}
	
	/**
	 * create post
	 * @throws Exception
	 */
	public function create()
	{
		$data = [];
		
		// get user list management
		$data['users'] = $this->userRepository->getManagementUsers();

		// get data categories
		$data['categories'] = $this->categoryRepository->all();

		return view('admin.posts.create')->with( $data );
	}

	/**
	 * store a new post
	 * @throws Exception
	 */
	public function store(Request $request)
	{
		$response = $this->postRepository->createPost($request);
	
		if ( !$response ) {
			abort( Config::get('constants.BAD_REQUEST') );
		}
		
		return redirect()->route('admin.post.index');
	}
	
	/**
	 * edit post
	 * @throws Exception
	 */
	public function edit($id)
	{
		// get data post
		$data['post'] = $this->postRepository->find($id);
	
		if ( !$data['post'] ) {
			abort( Config::get('constants.BAD_REQUEST') );
		}
		
		// get all category id
		$data['categoryIds'] = $data['post']->categories()->pluck('categories.id')->toArray();
		
		// get data categories
		$data['categories'] = $this->categoryRepository->all();
		
		return view('admin.posts.edit')->with($data);
	}
	
	public function update(Request $request, $id)
	{
		$response = $this->postRepository->updatePost($request, $id);
		
		if ( !$response ) {
			abort( Config::get('constants.BAD_REQUEST') );
		}
		
		return redirect()->route('admin.post.edit', $id);
	}
}
