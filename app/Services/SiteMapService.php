<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Service;
use Spatie\Sitemap\Sitemap;

class SiteMapService
{
    /**
     * Create a new class instance.
     */
    public static function generate()
    {
        $sitemap = Sitemap::create()
            ->add(route('front.home'))
            ->add(route('front.blogs.index'));
        
        Blog::chunk(100, function ($blogs) use (&$sitemap) {
            foreach($blogs as $blog) {
                $sitemap->add(route('front.blogs.show', $blog));
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
