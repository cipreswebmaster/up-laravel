<link rel="stylesheet" href="{{ asset("css/sample.css") }}">

<div class="sample">
  @foreach ($samples as $sample)
    @switch($cardComponent)
        @case("professions")
            @php
              $curr = json_decode(json_encode($sample), true);
            @endphp
            <x-profession-card 
              :imgSrc="'images/carreras/'.$curr[$imageFieldName]"
              :title="$curr[$cardTitle]"
              :arrow="$sample['area_img']"
            />
            @break
        @case("universities")
            <x-university-card
              :title="$sample[$cardTitle]"
              :imgSrc="$sample[$imageFieldName]"
              :idCiudad="$sample['id_ciudad']"
            />
            @break
        @default
    @endswitch
  @endforeach
</div>
