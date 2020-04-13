<table {{ $attributes->merge(['class' => 'table']) }}>

    <thead>
        <th>@lang('ac::action.all')</th>
        <th class="text-center">@lang('ac::action.view')</th>
        <th class="text-center">@lang('ac::action.create')</th>
        <th class="text-center">@lang('ac::action.update')</th>
        <th class="text-center">@lang('ac::action.delete')</th>
        <th class="text-center">@lang('ac::action.restore')</th>
        <th class="text-center">@lang('ac::action.force-delete')</th>
    </thead>

    <tbody>
      @foreach ($permissions->whereNull('model') as $permission)
        <tr>
          <td><b>{{ $permission->name }}</b></td>
          <td class="text-center">
            @include('ac::permissions.includes.icon', ['permission' => $permission])
          </td>
          <td colspan="5"></td>
        </tr>
      @endforeach

      @foreach ($permissions->whereNotNull('model')->groupBy('model') as $key => $permission)
        <tr>
          <td><b>@lang($translation.'.'.$key)</b></td>
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
