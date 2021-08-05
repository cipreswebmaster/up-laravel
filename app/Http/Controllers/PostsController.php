<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  use HelpersTrait;

  public function index() {
    $posts = Post::all()->reverse();

    return view("posts.index", compact("posts"));
  }

  public function post($postName) {
    $post = $this->getDatabaseInfoWithSlugifyiedName(
      "posts",
      $postName,
      "title"
    );
    return view("posts.post", compact("post"));
  }
}
