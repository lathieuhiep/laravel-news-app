<?php
namespace App\Repositories\CategoryPost;

use App\Models\CategoryPost;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryPostRepository extends BaseRepository implements CategoryRepositoryInterface
{
	public function __construct(CategoryPost $model)
	{
		parent::__construct($model);
	}
}