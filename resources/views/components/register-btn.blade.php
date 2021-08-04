<div class="reg-container">
  <div class="start_now">
    @if (isset($_SESSION["logged"]))
      <a href="{{ route("perfil") }}">
        Perfil
      </a>
    @else
      <a href="{{ route("registrate") }}">
        Regístrate
      </a>
    @endif
  </div>
</div>

<script>
  let mainContainer = document.querySelector(".container");
  window.addEventListener("resize", function () {
    if (isMobile()) {
      mainContainer.classList.add("mobile");
    } else {
      mainContainer.classList.remove("mobile");
    }
  });
</script>

<style>
  
</style>
