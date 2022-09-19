<?php

namespace App\Services\Doctor;

use App\Http\Helpers\Core\DateHelper;
use App\Models\AdminLoginLog;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;


class HomePageService
{

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

    public function getUserRegistrationGrowthRate()
    {
        $currentYearRegistrationCount = User::whereYear('created_at', DateHelper::getCurrentYear())->count();
        $totalUsers = User::count();
        return ($currentYearRegistrationCount * 100) / $totalUsers;
    }

    public function getRegisteredUsersList($limit = 8)
    {
        return User::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * @param string $status // UserConstants::STATUS_INACTIVE, UserConstants::STATUS_ACTIVE
     * @return mixed
     */
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

