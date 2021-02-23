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
    | Superadmin
    |--------------------------------------------------------------------------
    |
    | Here you may sdefine the superadmin (superpower) role that can do anything !
    */

    'superadmin' => 'superadmin',

    /*
    |--------------------------------------------------------------------------
    | Guarded
    |--------------------------------------------------------------------------
    |
    | Here you may specify the roles that can be assigned only by the same role
    */

    'guarder' => ['superadmin'],


    /*
    |--------------------------------------------------------------------------
    | Protected
    |--------------------------------------------------------------------------
    |
    | Here you may specify the roles that are protected (to use in policies)
    */

    'protected' => ['superadmin','admin']


];
