<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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

  #region API
  /**
   * Route: /api/add_post
   */
  public function add_post(Request $request) {
    $post = $request->all();
    $image = $request->file("image");
    $post["image"] = rand(100000, 999999) . "." . $image->getClientOriginalExtension();
    $image_new_path = public_path("\images\posts\post");
    $post_created = Post::create($post);
    
    try {
      $image->move($image_new_path, $post["image"]);
    } catch (FileException $e) {
      $post_created->delete();
      return response()->json([
        "success" => false,
        "message" => $e->getMessage()
      ]);
    }

    return response()->json([
      "success" => true,
      "id_post" => $post_created->id_post
    ]);
  }

  /**
   * Route: /api/get_posts
   */
  public function get_posts() {
    $posts = array_reverse(Post::all()->toArray());
    
    return response()->json($posts);
  }

  /**
   * Route: /api/delete_post
   */
  public function delete_post(Request $request) {
    try {
      $post = Post::find($request->id);
      $post->delete();
      $image = public_path('\images\posts\post\\' . $post->image);
      if (file_exists($image))
        unlink($image);
    } catch (Exception $e) {
      return response()->json([
        "success" => false,
      ]); 
    }

    return response()->json([
      "success" => true,
    ]);
    }
  #endregion
}
