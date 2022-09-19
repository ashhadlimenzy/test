<?php

namespace App\Http\Controllers\Admin;

use App\Http\Constants\UserConstants;

use App\Http\Constants\DoctorConstants;

use App\Services\Admin\HomePageService;

use Illuminate\Http\Request;


class HomeController extends BaseController
{

    /**
     * HomeController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param HomePageService $homePageService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|int
     */
    public function index(HomePageService $homePageService)
    {
        $registeredActiveDoctors = $homePageService->getDoctorsCount(DoctorConstants::STATUS_ACTIVE);
        $registeredInActiveDoctors = $homePageService->getInactiveDoctorsCount(DoctorConstants::STATUS_INACTIVE);
        $totalDoctors = $homePageService->getDoctorsCount();
        $registeredActiveUsers = $homePageService->getUsersCount(UserConstants::STATUS_ACTIVE);
        $registeredInActiveUsers = $homePageService->getInactiveUsersCount(UserConstants::STATUS_INACTIVE);
        $totalUsers = $homePageService->getUsersCount();
        $adminLoginLogs = $homePageService->getRecentLogins();
        $doctorRegistrationGraphData = $homePageService->getDoctorRegistrationGraphData();
        $userRegistrationGraphData = $homePageService->getUserRegistrationGraphData();
        $doctorregistrationGrowthRate = $homePageService->getDoctorRegistrationGrowthRate();
        $userregistrationGrowthRate = $homePageService->getUserRegistrationGrowthRate();
        $registeredDoctorsList = $homePageService->getRegisteredDoctorsList();
        $registeredUsersList = $homePageService->getRegisteredUsersList();
        return $this->renderView($this->getView('index'), compact(
            'registeredActiveDoctors',
            'registeredInActiveDoctors',
            'registeredActiveUsers',
            'registeredInActiveUsers',
            'doctorRegistrationGraphData',
            'userRegistrationGraphData',
            'totalDoctors',
            'totalUsers',
            'adminLoginLogs',
            'doctorregistrationGrowthRate',
            'userregistrationGrowthRate',
            'registeredDoctorsList',
            'registeredUsersList'
        ), 'Dashboard');
    }

}
