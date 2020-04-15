@if(!is_null($permission))
  <x-bs-check :class="'permission-checkbox-'.$permission->action" :label="__('ac::action.'.$permission->action)" name="permissions[]" :value="$permission->id" :checked="$isOptionChecked($permission->id)" :disabled="$isDisabled || $isOptionDisabled($permission->id)"/>
@endif
