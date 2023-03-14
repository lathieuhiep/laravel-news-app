<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'slug',
		'parent_id',
		'description'
	];
	
    public function categoryPost(): HasMany
    {
		return $this->hasMany(CategoryPost::class, 'category_id', 'id');
    }
}
