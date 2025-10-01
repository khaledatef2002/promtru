<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    public function get_blogs($last_blog_id = null, $limit = 20)
    {
        $blogs = Blog::orderByDesc('id')->when($last_blog_id, function($query) use ($last_blog_id) {
            return $query->where('id', '<', $last_blog_id);
        })->limit($limit)->get();

        return $blogs;
    }
}
