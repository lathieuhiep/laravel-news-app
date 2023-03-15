<?php
namespace App\Repositories\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostRepository extends BaseRepository implements PostRepositoryInterface {
	public function __construct(Post $model)
	{
		parent::__construct($model);
	}
	
	// create category post
	public function createCategoryPost ($categoryId, $postId)
	{
		CategoryPost::create([
			'category_id' => $categoryId,
			'post_id' => $postId
		]);
	}
	
	// store a new post
	public function createPost($request): bool|string
	{
		DB::beginTransaction();
		
		try {
			$post = $this->model->create([
				'user_id' => Auth::user()->id,
				'title' => $request->input('title'),
				'slug' => Str::of( $request->input('title') )->slug('-'),
				'content' => $request->input('content'),
				'excerpt' => $request->input('excerpt'),
				'status' => Config::get('constants.POST_STATUS.PUBLISH')
			]);
			
			if ( $request->hasFile('image') ) {
				$post->addMediaFromRequest('image')->toMediaCollection();
			}
			
			// create category of post
			$post_id = $post->id;
			$category_ids = $request->input('post_category');
	
			if ( empty( $category_ids ) ) {
				$category_ids = [Config::get('constants.CATEGORY_DEFAULT')];
			}
			
			foreach ($category_ids as $category_id ) {
				$this->createCategoryPost($category_id, $post_id);
			}
			
			DB::commit();
			
			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			
			return $e->getMessage();
		}
	}
	
	// update post
	public function updatePost($request, $id): bool|string
	{
		DB::beginTransaction();
		
		try {
			// update post
			$post= $this->model->find($id);
			$post->update( $request->all() );
			
			if ( $request->hasFile('image') ) {
				$post->deletePreservingMedia();
				$post->addMediaFromRequest('image')->toMediaCollection();
			}
			
			// update category post
			$category_ids = $request->input('post_category');
			
			if ( empty( $category_ids ) ) {
				$category_ids = [Config::get('constants.CATEGORY_DEFAULT')];
			}
			
			foreach ($category_ids as $category_id ) {
				$category_post = CategoryPost::query()->where([
					['category_id', $category_id],
					['post_id', $id]
				])->first();
				
				if ( $category_post->isEmpty() ) {
					$this->createCategoryPost($category_id, $id);
				}
			}
			
			DB::commit();
			
			return $post;
		} catch (\Exception $e) {
			DB::rollBack();
			
			return $e->getMessage();
		}
	}
	
	public function getByUser(User $user): Builder
	{
		return $this->model->where('user_id', $user->id);
	}
}