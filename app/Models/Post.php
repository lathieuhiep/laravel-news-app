<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'user_id',
		'title',
		'slug',
		'content',
		'excerpt',
		'status',
	];
	
	// get author
	public function author(): HasOne
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}
	
	// get categories for the blog post
	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class, 'category_posts', 'post_id', 'category_id');
	}
	
	// get list name category
	public function getCategoryName(): string
	{
		$listCate = '';
		
		$categories = $this->categories()
			->pluck('name')
			->toArray();
		
		if ( $categories ) {
			$listCate = implode(", ", $categories);
		}
		
		return $listCate;
	}
}
