<?php

namespace App\Http\Controllers\User;

use App\Models\appointmentdate;
use App\Models\Appointment;
use App\Models\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests\User\AppointmentStoreRequest;
use Illuminate\Support\Facades\Response;
use Auth;
use Toastr;
use Carbon\Carbon;


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
            ->join('appointmentdates', 'appointments.timeslot_id', '=', 'appointmentdates.id')
            ->where('appointments.user_id', '=',Auth::guard("user")->user()->id)
            ->whereNotIn('appointments.status',[3,4]);
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
            
            $appointments = $appointments->get(['appointments.*', 'doctors.first_name', 'appointmentdates.d_o_a', 'appointmentdates.time_slot' ]);
            
            return $this->renderView($this->getView('index'), compact('appointments'), 'Booking List');
        }

    /**
     * Show form to create booking
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $doctors = new Doctor();
        $doctors = $doctors->get();
        $appointmentdates = new appointmentdate();
        $appointmentdates = $appointmentdates->get();
        return $this->renderView($this->getView('create'), compact('doctors','appointmentdates'), 'Add New Appointment');
    }

    /**
     * Store doctor to DB
     *
     * @param DoctorStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AppointmentStoreRequest $request)
    {
        Appointment::create([
            'user_id' => $request->uid,
            'doctor_id' => $request->docname,
            'timeslot_id' => $request->tslt,
            'illness' => $request->illness,
        ]);
        Toastr::success('Your doctor`s apppointment is booked successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /** Ajax requests **/
    public function available_doa(Request $request){

        $doctorId = $request->docId;
        $dates = appointmentdate::select('d_o_a')->where('d_o_a','>', Carbon::now()->format('Y-m-d'))->where('doctor_id',$doctorId)->groupBy('d_o_a')->get();
        return $dates;
       
    }

    /** Ajax requests **/
    public function available_timeslot(Request $request){

        $availDoa = $request->avaiDoa;
        $timeslots = appointmentdate::select('time_slot','id')->whereNotIn('id',Appointment::select('timeslot_id')->whereIn('status',[0,3,4])->get())->where('d_o_a',$availDoa)->get();
        // ->where('time_slot','>', Carbon::now()->format("h:i A"))
        // $timeslots = appointmentdate::join('appointments', 'appointmentdates.id', '!=', 'appointments.timeslot_id')->where('d_o_a',$availDoa)->get();
       return $timeslots;
       
    }

    public function CancelAppointment($id)
    {
        $data=Appointment::find($id);
        $data->status='2';
        $data->save();
        return redirect()->back();
    }
    
}
