<?php

namespace App\Controller;

use Core\View;
use Core\ErrorHandler;
use Exception;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class HomeController {
    public function index(){
        $posts = Post::getRecent(5);
        return View::render(
            template : 'home/index', 
            data: ['posts' => $posts], 
            layout: 'layouts/main'
        );
    }
}