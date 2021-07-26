<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    @for ($i = 1; $i < 6; $i++)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i + 1}}"></button>
    @endfor
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset("images/index/slide/slide1.jpg") }}" class="d-block w-100" alt="...">
    </div>
    @for ($i = 2; $i <= 6; $i++)
      <div class="carousel-item">
        <img src="{{ asset("images/index/slide/slide$i.jpg") }}" class="d-block w-100" alt="...">
      </div>
    @endfor
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>