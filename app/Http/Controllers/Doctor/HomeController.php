<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Constants\UserConstants;

use App\Services\Doctor\HomePageService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomePageService $homePageService)
    {
        $registeredActiveUsers = $homePageService->getUsersCount(UserConstants::STATUS_ACTIVE);
        $totalUsers = $homePageService->getUsersCount();
        $userRegistrationGraphData = $homePageService->getUserRegistrationGraphData();
        $userregistrationGrowthRate = $homePageService->getUserRegistrationGrowthRate();
        $registeredUsersList = $homePageService->getRegisteredUsersList();
        $userLoginLogs = $homePageService->getRecentLogins();
        return $this->renderView($this->getView('index'), compact(
            'registeredActiveUsers',
            'userRegistrationGraphData',
            'totalUsers',
            'userregistrationGrowthRate',
            'registeredUsersList', 
            'userLoginLogs'), 'Dashboard');
    }

}
