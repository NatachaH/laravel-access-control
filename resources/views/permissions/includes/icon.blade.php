@if(!is_null($permission))
  <i class="icon icon-{{ $optionIcon($permission->id) }} text-{{ $optionColor($permission->id) }}"></i>
@endif
