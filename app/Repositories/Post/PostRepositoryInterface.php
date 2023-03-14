<?php
namespace App\Repositories\Post;

use App\Models\User;

interface PostRepositoryInterface {
	public function getByUser(User $user);
}