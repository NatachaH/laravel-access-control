@if(!is_null($permission))
  <i class="icon icon-{{ in_array($permission->id,$values) ? 'checkmark' : 'cross' }} text-{{ in_array($permission->id,$values) ? 'success' : 'danger' }}"></i>
@endif
