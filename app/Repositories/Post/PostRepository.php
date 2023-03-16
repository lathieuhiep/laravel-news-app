<?php
namespace App\Repositories\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Log;

class PostRepository extends BaseRepository implements PostRepositoryInterface {
	public function __construct(Post $model)
	{
		parent::__construct($model);
	}

	// create category post
	public function createCategoryPost ($categoryId, $postId): bool
	{
		DB::beginTransaction();

		try {
			CategoryPost::create([
				'category_id' => $categoryId,
				'post_id' => $postId
			]);
			DB::commit();

			return true;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e);

			return false;
		}
	}

	// store a new post
	public function createPost($request): bool
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
		} catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

			return false;
		}
	}

	// update post
	public function updatePost($request, $id): bool
	{
		DB::beginTransaction();

		try {
			// update post
			$post= $this->model->find($id);
			$post->update( $request->all() );

			if ( $request->hasFile('image') ) {
				$post->clearMediaCollection();
				$post->addMediaFromRequest('image')->toMediaCollection();
			}

			// update category post
			$category_ids = $request->input('post_category');

			if ( empty( $category_ids ) ) {
				$category_ids = [Config::get('constants.CATEGORY_DEFAULT')];
			}

			foreach ($category_ids as $category_id ) {
				$checkHasCategory = CategoryPost::query()->where([
					['category_id', $category_id],
					['post_id', $id]
				])->first();

				if ( !$checkHasCategory ) {
					$this->createCategoryPost($category_id, $id);
				}
			}

			DB::commit();

			return true;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e);

			return false;
		}
	}

	public function getByUser(User $user): Builder
	{
		return $this->model->where('user_id', $user->id);
	}
}
