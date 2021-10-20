<div class="{{ $containerClass }}">
  <iframe 
    width="560"
    height="315"
    src="{{ "https://www.youtube.com/embed/" . trim($videoId) }}"
    title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
    class="{{ $class }}"
    ></iframe>
</div>
