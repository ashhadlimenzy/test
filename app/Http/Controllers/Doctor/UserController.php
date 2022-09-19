<?php

namespace App\Http\Controllers\Doctor;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Toastr;


class UserController extends BaseController
{

    /**
     * UserController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('user');
        $this->addBaseRoute('user');
    }

    /**
     * List users
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = new User();
        if ($request->has('name')) {
            $users = $users->where(function ($query) use($request) {
                $query->where('first_name', 'LIKE', '%'.$request->name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->name.'%');
            });
        }
        $users = $users->get();
        return $this->renderView($this->getView('index'), compact('users'), 'Patients List');
    }
}
