# Installation

Install the package via composer:

```
composer require nh/access-control
```

Publish the databases for the roles and permissions:

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

# View component

To display a fieldset with the select option for the role:
*1) The roles are loaded from a composer*
*2) The trait HasAccess will automatically attache the role to your model!*

```
<x-ac-role-fieldset legend="Legend" label="Label" value="Default value selected" required/>
```

To display a fieldset with the permissions checkboxes:
*The permissions are loaded from a composer*

```
<x-ac-permission-fieldset legend="Legend" values="Array with the default value checked" translation="Name of the translation file for the permission name"/>
```

To display a table with the permissions with icon checkmark or cross:
*The permissions are loaded from a composer*

```
<x-ac-permission-table values="Array with the default value checked" translation="Name of the translation file for the permission name"/>
```
