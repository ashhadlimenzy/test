<?php

namespace App\Http\Controllers\Doctor;

use App\Models\appointmentdate;
use App\Models\Appointment;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use Toastr;


class BookingController extends BaseController
{

    /**
     * BookingController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('booking');
        $this->addBaseRoute('booking');
    }

    /**
     * List bookingss
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $appointments = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
        ->join('appointmentdates', 'appointments.timeslot_id', '=', 'appointmentdates.id')
        ->where('appointments.doctor_id', '=',Auth::guard("doctor")->user()->id);
        if ($request->has('name')) {
            $appointments = $appointments->where(function ($query) use($request) {
                $query->where('users.first_name', 'LIKE', '%'.$request->name.'%');
            });
        }
        if ($request->has('doa')) {
            $appointments = $appointments->where(function ($query) use($request) {
                $query->where('appointmentdates.d_o_a', 'LIKE', '%'.$request->doa.'%');
            });
        }
        
        $appointments = $appointments->get(['appointments.*', 'users.first_name', 'appointmentdates.d_o_a', 'appointmentdates.time_slot' ]);
        
        return $this->renderView($this->getView('index'), compact('appointments'), 'Booking List');
    }

    public function VisitedAppointment($id)
    {
        $data=Appointment::find($id);
        $data->status='3';
        $data->save();
        return redirect()->back();
    }    
    
    public function NotVisitedAppointment($id)
    {
        $data=Appointment::find($id);
        $data->status='4';
        $data->save();
        return redirect()->back();
    }

}
