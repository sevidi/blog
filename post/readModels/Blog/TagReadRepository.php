<?php


namespace post\readModels\Blog;

use post\entities\Blog\Tag;

class TagReadRepository
{

    public function findBySlug($slug): ?Tag
    {
        return Tag::findOne(['slug' => $slug]);
    }

}