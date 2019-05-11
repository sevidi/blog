<?php


namespace post\services\Blog;

use post\entities\Blog\Post\Comment;
use post\forms\Blog\CommentForm;
use post\repositories\Blog\PostRepository;
use post\repositories\UserRepository;

class CommentService
{
    private $posts;
    private $users;

    public function __construct(PostRepository $posts, UserRepository $users)
    {
        $this->posts = $posts;
        $this->users = $users;
    }

    public function create($postId, $userId, CommentForm $form): Comment
    {
        $post = $this->posts->get($postId);
        $user = $this->users->get($userId);
        $comment = $post->addComment($user->id, $form->parentId, $form->text);
        $this->posts->save($post);
        return $comment;
    }

}