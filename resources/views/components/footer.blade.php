@php
    $portales = [
      ["Los Mejores Colegios", "https://losmejorescolegios.com/"],
      ["Los Mejores Jardines", "https://losmejoresjardines.com/"],
      ["Great Place to Study", "https://greatplacetostudy.co/"],
    ];

  $logos = [
    [
      "name" => "facebook",
      "logo" => asset("images/footer/facebook-logo.png"),
      "link" => "https://www.facebook.com/Universidades-y-Profesiones-UP-103513108523501/?ref=pages_you_manage",
    ],
    [
      "name" => "instagram",
      "logo" => asset("images/footer/instagram-logo.png"),
      "link" => "https://instagram.com/universidadesyprofesiones?utm_medium=copy_link",
    ],
    [
      "name" => "youtube",
      "logo" => asset("images/footer/yt-logo.png"),
      "link" => "https://www.youtube.com/channel/UC0idYOq09JX7jNjPdZue9Kw",
    ],
  ];
@endphp

<footer>
  <div class="copyright">
    <div class="img">
      <img src="{{ asset("images/footer/cipres-logo.png") }}" alt="" />
    </div>
    <p class="content">
      COPYRIGHT ©2021 www.universidadesyprofesiones.com ・<br>
      contacto@universidadesyprofesiones.com ・<br>
      Carrera 7 No. 156 - 10 Oficina 1707 ・<br>
      ÁREA COMERCIAL: (+57) 300 566 2412・<br>
      ADMINISTRACIÓN Y CARTERA: (+57) 318 381 8314 ・<br>
      Bogotá D.C, Colombia
    </p>
  </div>
  <div class="info">
    <div class="websites">
      <h2>Nuestra red de portales</h2>
      <ul>
        @foreach ($portales as $portal)
          <li>
            <a href="{{ $portal[1] }}" target="_blank" rel="noopener noreferrer">
              {{ $portal[0] }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="politics-social">
      <div class="politics">
        <h2>Información de interés</h2>
        <a
          href="https://google.com"
          target="_blank"
          rel="noopener noreferrer"
        >
          Política de tratamiento de Datos Personales
        </a>
      </div>
      <div class="social-media">
        <h2>Síguenos</h2>
        <div class="footer-icons">
          @foreach ($logos as $logo)
            <a
              href="{{ $logo["link"] }}"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img src="{{ $logo["logo"] }}" alt="{{ $logo["name"] }}" />
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</footer>
