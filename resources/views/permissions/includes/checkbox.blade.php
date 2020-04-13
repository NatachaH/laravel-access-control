@if(!is_null($permission))
  <x-bs-check :class="'permission-checkbox-'.$permission->action" :label="__('ac::action.'.$permission->action)" name="permissions[]" :value="$permission->id" :checked="in_array($permission->id,$values)"/>
@endif
