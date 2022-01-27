@extends('posts.base')

@section('keywords', $post["tags"])
@section('title', $post["title"])
@section('description', $post["entradilla"])
@section('og_image_url', asset("images/posts/post/" . $post["image"]))
@section('og_image_alt', $post["title"])

@section('styles')
  <link rel="stylesheet" href="{{ mix("css/post.css") }}">
@endsection

@php
  function getPublicationDate($datetime) {
    $date = explode(" ", $datetime)[0];
    $dateExploded = explode("-", $date);
    $arrayReversed = array_reverse($dateExploded);
    return implode("/", $arrayReversed);
  }
@endphp

@section('content')
  <div class="post">
    <h1 class="title">{{ $post["title"] }}</h1>
    <div class="publication_date">
      {{ getPublicationDate($post["created_at"]) }}
    </div>
    <div class="entradilla">{{ $post["entradilla"] }}</div>
    <div class="image">
      <img
        src="{{ asset("images/posts/post/" . $post["image"]) }}"
        alt="Post for {{ $post["title"] }}"
      />
    </div>
    <div class="post_text">{!! $post["post"] !!}</div>
    {{-- <div class="tags">Etiquetas: {{ $post["tags"] }}</div> --}}
    <div class="share">
      <ul>
        <li>Comparte: </li>
        <li>
          <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" target="_blank" rel="noopener noreferrer">
            <object
              type="image/svg+xml"
              data="{{ asset("images/posts/icons/fb.svg") }}"
              class="logo fb"
              title="Facebook logo">
              Facebook logo
            </object>
          </a>
        </li>
      </ul>
    </div>
  </div>
@endsection
