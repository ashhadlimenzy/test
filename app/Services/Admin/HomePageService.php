<?php

namespace App\Services\Admin;

use App\Http\Helpers\Core\DateHelper;
use App\Models\AdminLoginLog;
use App\Models\User;
use App\Models\Doctor;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;


class HomePageService
{

    public function getDoctorRegistrationGraphData()
    {
        $registrations = DB::table(Doctor::getTableName())
            ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', DateHelper::getCurrentYear())
            ->groupBy('month')
            ->get();
        $keyed = $registrations->mapWithKeys(function ($item) {
            return [$item->month => $item->total];
        });
        $formattedOrders = $keyed->all();
        $graphData = [];
        foreach ($formattedOrders as $month => $registrationCount) {
            $graphData['item'][] = $month;
            $graphData['data'][] = $registrationCount;
        }
        if( empty($graphData)) {
            $graphData['item'][] = Carbon::now()->format('F');
            $graphData['data'][] = 0;
        }
        return $graphData;
    }

    public function getUserRegistrationGraphData()
    {
        $registrations = DB::table(User::getTableName())
            ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', DateHelper::getCurrentYear())
            ->groupBy('month')
            ->get();
        $keyed = $registrations->mapWithKeys(function ($item) {
            return [$item->month => $item->total];
        });
        $formattedOrders = $keyed->all();
        $graphData = [];
        foreach ($formattedOrders as $month => $registrationCount) {
            $graphData['item'][] = $month;
            $graphData['data'][] = $registrationCount;
        }
        if( empty($graphData)) {
            $graphData['item'][] = Carbon::now()->format('F');
            $graphData['data'][] = 0;
        }
        return $graphData;
    }

    public function getDoctorRegistrationGrowthRate()
    {
        $currentYearRegistrationCount = Doctor::whereYear('created_at', DateHelper::getCurrentYear())->count();
        $totalUsers = Doctor::count();
        return ($currentYearRegistrationCount * 100) / $totalUsers;
    }

    public function getUserRegistrationGrowthRate()
    {
        $currentYearRegistrationCount = User::whereYear('created_at', DateHelper::getCurrentYear())->count();
        $totalUsers = User::count();
        return ($currentYearRegistrationCount * 100) / $totalUsers;
    }

    public function getRegisteredDoctorsList($limit = 8)
    {
        return Doctor::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function getRegisteredUsersList($limit = 8)
    {
        return User::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * @param string $status // UserConstants::STATUS_INACTIVE, UserConstants::STATUS_ACTIVE
     * @return mixed
     */
    public function getDoctorsCount($status = '')
    {
        return ('' == $status) ? Doctor::count() : Doctor::where('status', $status)->count();
    }

    public function getInactiveDoctorsCount($status = '1')
    {
    return ('1' == $status) ? Doctor::count() : Doctor::where('status', $status)->count();
    }

    public function getUsersCount($status = '')
    {
        return ('' == $status) ? User::count() : User::where('status', $status)->count();
    }

    public function getInactiveUsersCount($status = '1')
    {
        return ('1' == $status) ? User::count() : User::where('status', $status)->count();
    }

    public function getRecentLogins($limit = 8)
    {
        return AdminLoginLog::orderBy('id', 'desc')->limit($limit)->get();
    }


}

