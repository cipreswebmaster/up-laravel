<link rel="stylesheet" href="{{ asset("css/showcase.css") }}">

<div class="results">
  <x-showcase-filter :title="$title" />
  <x-sample
    :samples="$samples"
    :cardComponent="$cardComponent"
    :imageFieldName="$imageFieldName"
    :cardTitle="$cardTitle"
  />
</div>
