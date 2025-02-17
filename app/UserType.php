<?php

namespace App;

enum UserType: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case CLIENT = 'client';

    // public static function getLabels(): array
    // {
    //     return [
    //         self::ADMIN => 'Admin',
    //         self::STAFF => 'Staff',
    //         self::CLIENT => 'Client',
    //     ];
    // }
}
