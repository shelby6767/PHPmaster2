<?php

namespace App\Controller;

use App\Models\Comment;
use App\Models\Post;
use Core\Router;
use Core\View;

class PostController {
    public function index(){
        $search = $_GET['search'] ?? '';
        $page =$_GET['page'] ?? 1;
        $limit = 2;


        $posts = Post::getRecent($limit, $page, $search);
        $total = Post::count($search);

        return View::render(
            template : 'posts/index', 
            data: [
                'posts' => $posts,
                'search' => $search,
                'currentPage' => $page,
                'totalPages' => ceil($total/$limit)
            ], 
            layout: 'layouts/main'
        );
    }

    public function show($id){
        //1) Fetch Post from db
        //2) 404 if not found
        //3) Load Comments
        //4) Increment view count
        //5) Render
        $post = Post::find($id);
        if(!$post){
            Router::notFound();
        }
        $comments = Comment::forPost($id);
        Post::incrementViews($id);
        return VIew::render(
            template: 'posts/show',
            layout: 'layouts/main',
            data: ['post' => $post, 'comments' => $comments]
        );
    }
}