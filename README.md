# Installation

Install the package via composer:

```
composer require nh/access-control
```

Publish the databases and the models for the roles:

```
php artisan vendor:publish --tag=access-control
```

To make a model with role, you can create a migration via the console commande:
*The --many option will create a roleables table with many to many morph relationship*

```
php artisan role:new {--model= : the name of the model (singular/lowercase)} {--many : is the model using many to many}
```

Then, if your model is has only one role add the **HasAccess** trait to your model:

```
use Nh\AccessControl\Traits\HasAccess;

use HasAccess;
```

# Create permission

You can create permission via the console commande:
*You can create a single permission, or all action permissions for a model.*

```
php artisan permission:new {--model= : the name of the model (singular/lowercase)} {--softDelete : is the model using SoftDelete}
```


# Check the access

Check if a model has any role :
```
Auth::user()->hasAnyRole()
```

Check if a model has some roles :
*You must pass a string or an array*
*By default it will check on the guard column, but you can specify the column*

```
Auth::user()->hasRoles('admin')
Auth::user()->hasRoles('Administrator','name')
```

Check if a model has some permissions :
*You must pass a string or an array*

```
Auth::user()->hasPermissions('only-admin')
```

Check if a model has access to a model/action :
*You must pass a string for the model and a string or an array for the actions*

```
// Request
hasAccess(string $model, mixed $actions = null, boolean $strict = false)

// Has ANY permission of the Role model
Auth::user()->hasAccess('role')

// Has ALL permission of the Role model
Auth::user()->hasAccess('role', null, true)

// Has a specific permission of the Role model
Auth::user()->hasAccess('role', 'update')

// Has ANY specific permission of the Role model
Auth::user()->hasAccess('role', ['update','delete'])

// Has ALL specific permission of the Role model
Auth::user()->hasAccess('role', ['update','delete'], true)
```

Check if a model has superpower :
*You can change the superpowers role in the config file*

```
// Return a boolean
Auth:user()->has_superpowers;
```

Scope the model with role(s) :

```
User::withRole('admin')->get();
User::withRole(['superadmin','admin'])->get();
User::withRole(2,'role_id')->get();
```

# Models

The package come with two models:

- Role
- Permission

## Role

The role have a **guard** and **name** attribute.

You can retrieve the restricted permissions:

```
$role->restrictions();
```

You can also retrieve the restricted permissions from a model with multiple roles:

```
Auth::user()->permission_restrictions;
```

You can check if a role have a permission:
*$permissions can be a string or an array*

```
$role->hasPermissions($permissions, $column)
```

You can check if a role have a permission by model/action:
*$actions can be a string or an array*
*$strict must be a boolean, and check if AS ANY or AS ALL permission*

```
$role->hasPermissionsModel($model,$actions,$strict)
```

# Permission

You can retrieve a list of all permission, ordered by model:
*The key is the model field*
*If there is no model, the key will be name, and the action will be 'view'*

```
Permission::getByModel();
```


# Events

You can use the **RoleEvent** for dispatch events that happen to the role access.

```
RoleEvent::dispatch('my-event', $model);
```

# Gates

You can use the **set-roles** Gate to check if current Auth can set the roles.
*$roles must be an array of ids*
*In the config file you can specify the roles that are guarded and required an Auth of the same role*

```
Gate::authorize('set-roles', $roles);
```

You can use the **set-permissions** Gate to check if current Auth can set the permission for a role.
*$permissions must be an array of ids*
*In the config file you can specify the roles that are guarded and required an Auth of the same role*

```
Gate::authorize('set-permissions', $permissions);
```
