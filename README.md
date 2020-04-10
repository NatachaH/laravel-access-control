# Installation

# Test

```
<h3>Roles</h3>
  <p>Admin: {{ Auth::user()->hasRoles('admin') ? 'y' : 'n' }}</p>
  <p>Editor: {{ Auth::user()->hasRoles('editor') ? 'y' : 'n' }}</p>

  <h3>Permission</h3>
  <p>Admin: {{ Auth::user()->hasPermissions('only-admin') ? 'y' : 'n' }}</p>
  <p>Editor: {{ Auth::user()->hasPermissions('only-editor') ? 'y' : 'n' }}</p>
  <p>Everything: {{ Auth::user()->hasPermissions('everything') ? 'y' : 'n' }}</p>

  <h3>Access Model</h3>
  <p>User any: {{ Auth::user()->hasAccess('user') ? 'y' : 'n' }}</p>
  <p>User all: {{ Auth::user()->hasAccess('user', null, true) ? 'y' : 'n' }}</p>

  <p>User edit: {{ Auth::user()->hasAccess('user', 'edit') ? 'y' : 'n' }}</p>
  <p>User delete: {{ Auth::user()->hasAccess('user', 'delete') ? 'y' : 'n' }}</p>

  <p>User any edit or delete: {{ Auth::user()->hasAccess('user', ['edit','delete']) ? 'y' : 'n' }}</p>
  <p>User edit and delete: {{ Auth::user()->hasAccess('user', ['edit','delete'], true) ? 'y' : 'n' }}</p>

```
