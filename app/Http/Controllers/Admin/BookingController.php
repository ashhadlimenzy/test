<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\appointmentdate;
use App\Models\Appointment;

use App\Http\Requests\Admin\UserUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
        $appointments = Appointment::join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->join('users', 'appointments.user_id', '=', 'users.id')
        ->join('appointmentdates', 'appointments.timeslot_id', '=', 'appointmentdates.id');
        if ($request->has('name')) {
            $appointments = $appointments->where(function ($query) use($request) {
                $query->where('doctors.first_name', 'LIKE', '%'.$request->name.'%');
            });
        }
        if ($request->has('doa')) {
            $appointments = $appointments->where(function ($query) use($request) {
                $query->where('appointmentdates.d_o_a', 'LIKE', '%'.$request->doa.'%');
            });
        }
        
        $appointments = $appointments->get(['appointments.*', 'users.first_name as username', 'doctors.first_name', 'appointmentdates.d_o_a', 'appointmentdates.time_slot' ]);
        
        return $this->renderView($this->getView('index'), compact('appointments'), 'Booking List');
    }

    /**
     * Delete appointment
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return Response::json(['success' => 'The Appointment is deleted successfully']);
    }

    public function ConfirmAppointment($id)
    {
        $data=Appointment::find($id);
        $data->status='0';
        $data->save();
        return redirect()->back();
    }    
    
    public function RejectAppointment($id)
    {
        $data=Appointment::find($id);
        $data->status='1';
        $data->save();
        return redirect()->back();
    }

}
