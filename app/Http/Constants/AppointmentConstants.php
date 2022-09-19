<?php
/**
 * file destinations constants
 */

namespace App\Http\Constants;


class AppointmentConstants
{
    const STATUS_CONFIRMED = 0;
    const STATUS_REJECTED = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_VISITED = 3;
    const STATUS_NOTVISITED = 4;

    const STATUS = [
        self::STATUS_REJECTED => 'Rejected',
        self::STATUS_CONFIRMED => 'Confirmed',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_VISITED => 'Visited',
        self::STATUS_NOTVISITED => 'NotVisited',
    ];

}

