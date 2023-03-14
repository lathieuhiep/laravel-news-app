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
	
	public function create($request)
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
			
			$post->addMediaFromRequest('image')->toMediaCollection();
			
			//
			$post_id = $post->id;
			$category_ids = $request->input('post_category');
			
			foreach ($category_ids as $category_id ) {
				$this->categoryRepository->create([
					'category_id' => $category_id,
					'post_id' => $post_id
				]);
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