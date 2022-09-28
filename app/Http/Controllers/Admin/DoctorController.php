<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\appointmentdate;

use App\Http\Requests\Admin\DoctorStoreRequest;
use App\Http\Requests\Admin\DoctorUpdateRequest;
use App\Http\Requests\Admin\SlotdateStoreRequest;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
        if ($request->has('status') && '' != $request->status) {
            $doctors = $doctors->where('status', $request->status);
        }
        $doctors = $doctors->get();
        return $this->renderView($this->getView('index'), compact('doctors'), 'Doctor List');
    }

    /**
     * Show form to create doctor
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->renderView($this->getView('create'), [], 'Add Doctor');
    }

    /**
     * Show form to edit doctor
     *
     * @param Doctor $doctor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Doctor $doctor)
    {
        return $this->renderView($this->getView('edit'), compact('doctor'), 'Edit Doctor');
    }

    /**
     * Store doctor to DB
     *
     * @param DoctorStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DoctorStoreRequest $request)
    {
        Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'expertise' => $request->expertise,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);
        Toastr::success('Doctor added successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Update doctor
     *
     * @param DoctorUpdateRequest $request
     * @param Doctor $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
        Toastr::success('Doctor updated successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Delete doctor
     *
     * @param Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return Response::json(['success' => 'Doctor deleted successfully']);
    }

    public function activedoctor($id)
    {
        $data=Doctor::find($id);
        $data->status='1';
        $data->save();
        return redirect()->back();
    }

    public function Inactivedoctor($id)
    {
        $data=Doctor::find($id);
        $data->status='0';
        $data->save();
        return redirect()->back();
    }

    /**
     * Store sltodate to DB
     *
     * @param SlotdateStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addtimeslot(SlotdateStoreRequest  $request)
    {   
        // dd($endTime);
        $startDate = Carbon::createFromFormat('Y-m-d', $request->stadoa);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->enddoa);
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $period = new CarbonPeriod($request->stattim, $request->slottim.' minutes', $request->endtim);
        $slots = [];
        
        foreach($dateRange as $date) {
            $timeSplit=[];
            foreach($period as $item) {
                $timeSplit['slot']=$item->format("h.i");
                $timeSplit['slot_time']=$item->format("h:i");
                array_push($slots,$timeSplit);
                //array_push($slots,$slots['slot_time']);
                //array_push($slots['slot_time'],$item->format("h:i"));
            } 
            
          //  dd(json_encode($slots,true));
        
          $getSlots = json_encode($slots);

          foreach($slots as $getSlot)
          { 
            // dd($getSlot);
            $time = strtotime($getSlot['slot_time']);
            $endTime = date("H.i", strtotime('+'.$request->slottim.' minutes', $time));
            
            $slotvlu = floatval($getSlot['slot']);
            $stattimslt= appointmentdate::select('time_slot','end_time_slot')->get();
            // $endtimslt= appointmentdate::select('end_time_slot')->get();
            // dd(appointmentdate::where('doctor_id',$request->did)->where('d_o_a',$date->format('Y-m-d'))->whereNotBetween('time_slot',[$stattimslt,$endtimslt])->exists());
            // foreach($stattimslt as $item){
            if(appointmentdate::where('doctor_id',$request->did)->where('d_o_a',$date->format('Y-m-d'))->where('time_slot','=',$slotvlu)->exists()==false) {   
                       
                // if(appointmentdate::where('doctor_id',$request->did)->where('d_o_a',$date->format('Y-m-d'))->whereBetween('time_slot',[$item->time_slot,$item->end_time_slot])->exists()==false) {
                    appointmentdate::create([
                        'doctor_id' => $request->did,
                        'd_o_a' => $date,
                        'duration' => $request->slottim,
                        'time_slot' => $getSlot['slot'],
                        'end_time_slot' => floatval($endTime),
                    ]);
                // }
                // }     
            }
          }
        }
        Toastr::success('Doctor time slot is added successfully');
        return redirect()->route($this->getRoute('index'));
    }    
}
