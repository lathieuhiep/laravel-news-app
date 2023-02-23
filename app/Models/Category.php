<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function categoryPost(): HasMany
    {
		return $this->hasMany(CategoryPost::class, 'category_id', 'id');
    }
}
