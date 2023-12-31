<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'tags',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   public function categoryFilter($category)
   {
       return $this->where('category_id', $category->id);
   }
}
