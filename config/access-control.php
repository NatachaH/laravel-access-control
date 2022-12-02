<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    |
    | Here you may specify if the role relationship is: one to many or many to many .
    | 1) A user has one role (one to many)
    | 2) A user can have multiple roles (many to many)
    */

    'manyRoles' => false,

    /*
    |--------------------------------------------------------------------------
    | Superpowers
    |--------------------------------------------------------------------------
    |
    | Here you may define the superpowers role that can do anything !
    */

    'superpowers' => 'superadmin',

    /*
    |--------------------------------------------------------------------------
    | Guarded
    |--------------------------------------------------------------------------
    |
    | Here you may specify the roles that can be assigned ONLY by the same role
    */

    'guarded' => ['superadmin'],


    /*
    |--------------------------------------------------------------------------
    | Protected
    |--------------------------------------------------------------------------
    |
    | Here you may specify the roles that are protected (to use in policies)
    */

    'protected' => ['superadmin','admin'],


    /*
    |--------------------------------------------------------------------------
    | Name Protected
    |--------------------------------------------------------------------------
    |
    | Here you may specify the roles that have the name protected (in case of hasRoles() you should avoid the update of the role guard name)
    */

    'name-protected' => ['superadmin','admin'],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Here you may specify the actions for permissions
    */

    'permissions' => [
        'actions' => ['view','create','update','delete','restore','force-delete']
    ]


];
