<?php
namespace App\Repositories\Post;

use App\Models\CategoryPost;
use App\Models\User;

interface PostRepositoryInterface {
	public function createPost($request);
	public function createCategoryPost ($categoryId, $postId);
	public function updatePost($request, $id);
	public function getByUser(User $user);
}