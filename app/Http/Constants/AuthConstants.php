<?php
/**
 * Auth Constants
 */

namespace App\Http\Constants;


class AuthConstants
{
    const LOGIN_FAILED = 0;
    const LOGIN_SUCCESS = 1;
    const LOGIN_LOGOUT = 2;
    const LOGIN_LOCKOUT = 3;

    const LOGIN_MESSAGE = [
        self::LOGIN_FAILED => 'Failed',
        self::LOGIN_SUCCESS => 'Success',
        self::LOGIN_LOGOUT => 'Logout',
        self::LOGIN_LOCKOUT => 'Lockout',
    ];

    const GUARD_API = 'api';
    const GUARD_WEB = 'web';
    const GUARD_USER = 'user';
    const GUARD_ADMIN = 'admin';
    const GUARD_DOCTOR = 'doctor';

}
