<?php
/**
 * file destinations constants
 */

namespace App\Http\Constants;


class UserConstants
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_ARCHIVED = 2;

    const STATUS = [
        self::STATUS_INACTIVE => 'InActive',
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_ARCHIVED => 'Archived',
    ];

}

