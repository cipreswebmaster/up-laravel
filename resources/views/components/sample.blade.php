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
              :arrow="'images/select-area/arrows/' . $sample['area_img'] . '.svg'"
            />
            @break
        @case("universities")
            <x-university-card
              :title="$sample[$cardTitle]"
              :imgSrc="$sample[$imageFieldName]"
            />
            @break
        @default
    @endswitch
  @endforeach
</div>