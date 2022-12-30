<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Blog::insert([
            [
                'id'          => 1,
                'title'       => 'Blog Title',
                'details'     => 'Blog Details',
                'image'       => 'blog.jpg',
                'slug'        => 'blog-title-1',
                'status'      => 1,
                'featured'    => 1,
                'meta_title'  => 'Blog Meta Title',
                'meta_desc'   => 'Blog Meta Description',
                'language_id' => 1,
            ],
            [
                'id'          => 2,
                'title'       => 'Blog Title',
                'details'     => 'Blog Details',
                'image'       => 'blog.jpg',
                'slug'        => 'blog-title-2',
                'status'      => 1,
                'featured'    => 1,
                'meta_title'  => 'Blog Meta Title',
                'meta_desc'   => 'Blog Meta Description',
                'language_id' => 1,
            ],
            [
                'id'          => 3,
                'title'       => 'Blog Title',
                'details'     => 'Blog Details',
                'image'       => 'blog.jpg',
                'slug'        => 'blog-title-3',
                'status'      => 1,
                'featured'    => 1,
                'meta_title'  => 'Blog Meta Title',
                'meta_desc'   => 'Blog Meta Description',
                'language_id' => 1,
            ],
        ]);
    }
}
