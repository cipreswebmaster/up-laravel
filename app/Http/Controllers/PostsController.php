<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  use HelpersTrait;

  public function post($postName) {
    $post = $this->getDatabaseInfoWithSlugifyiedName(
      "posts",
      $postName,
      "title"
    );
    return view("posts.post", compact("post"));
  }
}
