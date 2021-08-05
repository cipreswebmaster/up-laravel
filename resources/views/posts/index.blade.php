@extends('posts.base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/actualidad.css") }}">
@endsection

@section('content')
  <div class="posts">
    @foreach ($posts as $post)
      <div class="post">
        <div class="info-image">
          <div class="image">
            <img src="{{ env("API_URL") . "/images/posts/" . $post["image"] }}" alt="Logo de UP">
          </div>
          <div class="info">
            <div class="title">
              <a href="{{ route("post", ["postName" => Str::slug($post["title"])]) }}">{{ $post["title"] }}</a>
            </div>
            <div class="created_at">{{ explode(" ", $post["created_at"])[0] }}</div>
          </div>
        </div>
        <div class="logo">
          <img src="{{ asset("images/posts/icons/logo.png") }}" alt="Logo de UP">
        </div>
      </div>
    @endforeach
  </div>
@endsection
