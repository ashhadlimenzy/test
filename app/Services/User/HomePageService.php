<?php

namespace App\Services\User;

use App\Models\Doctor;
use App\Models\UserLoginLog;


class HomePageService
{
    /**
     * Get latest user login logs
     *
     * @param int $limit
     * @return mixed
     */
    public function getRecentLogins($limit = 8)
    {
        return UserLoginLog::orderBy('id', 'desc')->limit($limit)->get();
    }

    /**
     * @param string $status // DoctorConstants::STATUS_INACTIVE
     * @return mixed
     */
    public function getDoctorsCount($status = '')
    {
        return ('' == $status) ? Doctor::count() : Doctor::where('status', $status)->count();
    }

}
