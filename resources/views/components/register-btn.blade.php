<div class="reg-container">
  <div class="start_now">
    <a href="/register">
      Regístrate
    </a>
  </div>
</div>

<script>
  const mainContainer = document.querySelector(".container");
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
