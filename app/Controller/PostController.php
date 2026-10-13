<?php

namespace App\Controller;

class PostController {
    public function index(){
        return "All Posts";
    }

    public function show($id){
        return "Post nr $id";
    }
}