<table {{ $attributes->merge(['class' => 'table']) }}>

    <thead>
        <th></th>
        <th class="text-center">@lang('ac::action.view')</th>
        <th class="text-center">@lang('ac::action.create')</th>
        <th class="text-center">@lang('ac::action.update')</th>
        <th class="text-center">@lang('ac::action.delete')</th>
        <th class="text-center">@lang('ac::action.restore')</th>
        <th class="text-center">@lang('ac::action.force-delete')</th>
    </thead>

    <tbody>
      @foreach ($permissions as $key => $permission)
        <tr>
          <td><b>{{ \Lang::has($translation.'.'.$key) ? trans_choice($translation.'.'.$key) : $key  }}</b></td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','view')])</td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','create')])</td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','update')])</td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','delete')])</td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','restore')])</td>
          <td class="text-center">@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','force-delete')])</td>
        </tr>
      @endforeach
    </tbody>

</table>
