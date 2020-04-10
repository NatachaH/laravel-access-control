<table class="table">

    <thead>
        <th>@lang('ac::all')</th>
        <th>@lang('ac::view')</th>
        <th>@lang('ac::create')</th>
        <th>@lang('ac::update')</th>
        <th>@lang('ac::delete')</th>
        <th>@lang('ac::restore')</th>
        <th>@lang('ac::force-delete')</th>
    </thead>

    <tbody>
      @foreach ($permissions->whereNull('model') as $permission)
        <tr>
          <td><b>{{ $permission->name }}</b></td>
          <td colspan="5">@include('ac::permissions.includes.checkbox', ['permission' => $permission])</td>
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
