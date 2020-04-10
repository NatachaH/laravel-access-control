@if(!is_null($permission))
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="{{ 'permission'.$permission->id }}">
    <label class="form-check-label" for="{{ 'permission'.$permission->id }}">
      @lang('ac::action.'.$permission->action )
    </label>
  </div>
@endif
