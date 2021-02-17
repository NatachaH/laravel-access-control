# Installation

Install the package via composer:

```
composer require nh/access-control
```

Publish the databases and the models for the roles and permissions:

```
php artisan vendor:publish --tag=access-control
```

To make a model with role, you can create a migration via the console commande:

```
php artisan role:new {model? : the name of the model}
```

Then, add the **HasAccess** trait to your model:

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

Check if a model has some roles :
*You can pass a string or an array*

```
Auth::user()->hasRoles('admin')
```

Check if a model has some permissions :
*You can pass a string or an array*

```
Auth::user()->hasPermissions('only-admin')
```

Check if a model has access to a model/action :
*You can pass a string or an array*

```
// Has ANY permission of the Role model
Auth::user()->hasAccess('role')

// Has ALL permission of the Role model
Auth::user()->hasAccess('role', null, true)

// Has a specific permission of the Role model
Auth::user()->hasAccess('role', 'edit')

// Has ANY specific permission of the Role model
Auth::user()->hasAccess('role', ['edit','delete'])

// Has ALL specific permission of the Role model
Auth::user()->hasAccess('role', ['edit','delete'], true)
```

# Models

The package come with two models:

- Role
- Permission

## Role

The role have only a **name** attribute.

You can retrieve the restricted permissions:

```
$role->restriction();
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

You can use the **AccessEvent** for dispatch events that happen to the role access.

```
AccessEvent::dispatch('my-event', $model);
```
