@extends('base')

@section('title')
  {{ $post["title"] }}
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/post.css") }}">
@endsection

@php
  function getPublicationDate($datetime) {
    $date = explode(" ", $datetime)[0];
    $dateExploded = explode("-", $date);
    $arrayReversed = array_reverse($dateExploded);
    return implode("/", $arrayReversed);
  }
@endphp

@section('body')
  <div class="post">
    <h1 class="title">{{ $post["title"] }}</h1>
    <div class="publication_date">
      {{ getPublicationDate($post["created_at"]) }}
    </div>
    <div class="entradilla">{{ $post["entradilla"] }}</div>
    <div class="image">
      <img
        src="{{ env("API_URL") . "/images/posts/" . $post["image"] }}"
        alt="Post for {{ $post["title"] }}"
      />
    </div>
    <div class="post_text">{!! $post["post"] !!}</div>
    <div class="tags">Etiquetas: {{ $post["tags"] }}</div>
  </div>
@endsection
