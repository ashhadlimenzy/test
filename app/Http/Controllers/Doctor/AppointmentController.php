<?php

namespace App\Http\Controllers\Doctor;

use App\Models\appointmentdate;
use App\Models\Appointment;
use App\Models\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests\User\AppointmentStoreRequest;
use Illuminate\Support\Facades\Response;
use Auth;
use Toastr;
use Carbon\Carbon;


class AppointmentController extends BaseController
{

    /**
     * BookingController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('available-appointment');
        $this->addBaseRoute('available-appointment');
    }

    /**
     * List bookingss
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
            $appointmentdates = appointmentdate::join('doctors', 'appointmentdates.doctor_id', '=', 'doctors.id')
            ->where('appointmentdates.doctor_id', '=',Auth::guard("doctor")->user()->id);
            if ($request->has('name')) {
                $appointmentdates = $appointmentdates->where(function ($query) use($request) {
                    $query->where('doctors.first_name', 'LIKE', '%'.$request->name.'%');
                });
            }
            if ($request->has('doa')) {
                $appointmentdates = $appointmentdates->where(function ($query) use($request) {
                    $query->where('appointmentdates.d_o_a', 'LIKE', '%'.$request->doa.'%');
                });
            }
            
            $appointmentdates = $appointmentdates->get(['appointmentdates.*', 'doctors.first_name']);
            
            return $this->renderView($this->getView('index'), compact('appointmentdates'), 'Your Assigned Appointment Slots');
        }

       
}
