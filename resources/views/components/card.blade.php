<div class="card">
  @if(!empty($title) || !empty($color))
  <div class="card-header {{ (!empty($color)) ? $color : '' }}">
  	<h3 class="card-title">
        {{ (!empty($title)) ? $title : '' }}
     </h3>
  </div>
  @endif
  <div class="card-body">
     {{ $slot }}
  </div>
</div>