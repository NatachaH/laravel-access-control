<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

    <table class="table bg-white mb-0">

        <thead>
            <th></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.view')" name="permissionCheckboxAll[]" value="view"/></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.create')" name="permissionCheckboxAll[]" value="create"/></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.update')" name="permissionCheckboxAll[]" value="update"/></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.delete')" name="permissionCheckboxAll[]" value="delete"/></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.restore')" name="permissionCheckboxAll[]" value="restore"/></th>
            <th><x-bs-check class="checkbox-all" :label="__('ac::action.force-delete')" name="permissionCheckboxAll[]" value="force-delete"/></th>
        </thead>

        <tbody>
          @foreach ($permissions as $key => $permission)
            <tr>
              <td><b>{{ \Lang::has($translation.'.'.$key) ? trans_choice($translation.'.'.$key,1) : $key  }}</b></td>
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

</fieldset>
