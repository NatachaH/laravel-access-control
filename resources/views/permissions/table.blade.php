<table {{ $attributes->merge(['class' => 'table']) }}>

    <thead>
        <th>@lang('ac::action.all')</th>
        <th>@lang('ac::action.view')</th>
        <th>@lang('ac::action.create')</th>
        <th>@lang('ac::action.update')</th>
        <th>@lang('ac::action.delete')</th>
        <th>@lang('ac::action.restore')</th>
        <th>@lang('ac::action.force-delete')</th>
    </thead>

    <tbody>
      @foreach ($permissions->whereNull('model') as $permission)
        <tr>
          <td><b>{{ $permission->name }}</b></td>
          <td colspan="5">
            @include('ac::permissions.includes.icon', ['permission' => $permission])
          </td>
        </tr>
      @endforeach

      @foreach ($permissions->whereNotNull('model')->groupBy('model') as $key => $permission)
        <tr>
          <td><b>@lang($translation.'.'.$key)</b></td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','view')])</td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','create')])</td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','update')])</td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','delete')])</td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','restore')])</td>
          <td>@include('ac::permissions.includes.icon', ['permission' => $permission->firstWhere('action','force-delete')])</td>
        </tr>
      @endforeach
    </tbody>

</table>
