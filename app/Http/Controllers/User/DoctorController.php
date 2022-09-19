<?php

namespace App\Http\Controllers\User;

use App\Models\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Toastr;


class DoctorController extends BaseController
{

    /**
     * DoctorController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('doctor');
        $this->addBaseRoute('doctor');
    }

    /**
     * List doctors
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $doctors = new Doctor();
        if ($request->has('name')) {
            $doctors = $doctors->where(function ($query) use($request) {
                $query->where('first_name', 'LIKE', '%'.$request->name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->name.'%');
            });
        }
        if ($request->has('expertise')) {
            $doctors = $doctors->where(function ($query) use($request) {
                $query->where('expertise', 'LIKE', '%'.$request->expertise.'%');
            });
        }
        $doctors = $doctors->get();
        return $this->renderView($this->getView('index'), compact('doctors'), 'Doctor List');
    }
}
