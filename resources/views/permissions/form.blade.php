<table class="table">

    <thead>
        <th>@lang('ac::action.all')</th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.view')" name="permissionCheckboxAll[]" value="view"/>
        </th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.create')" name="permissionCheckboxAll[]" value="create"/>
        </th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.update')" name="permissionCheckboxAll[]" value="update"/>
        </th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.delete')" name="permissionCheckboxAll[]" value="delete"/>
        </th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.restore')" name="permissionCheckboxAll[]" value="restore"/>
        </th>
        <th>
          <x-bs-check class="permission-checkbox-all" :label="__('ac::action.force-delete')" name="permissionCheckboxAll[]" value="force-delete"/>
        </th>
    </thead>

    <tbody>
      @foreach ($permissions->whereNull('model') as $permission)
        <tr>
          <td><b>{{ $permission->name }}</b></td>
          <td colspan="5">
            <x-bs-check class="permission-checkbox-view" :label="__('ac::action.view')" name="permissions[]" :value="$permission->id"/>
          </td>
        </tr>
      @endforeach

      @foreach ($permissions->whereNotNull('model')->groupBy('model') as $key => $permission)
        <tr>
          <td><b>@lang($translation.'.'.$key)</b></td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','view')])</td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','create')])</td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','update')])</td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','delete')])</td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','restore')])</td>
          <td>@include('ac::permissions.includes.checkbox', ['permission' => $permission->firstWhere('action','force-delete')])</td>
        </tr>
      @endforeach
    </tbody>

</table>
