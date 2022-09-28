@extends('layouts.user-dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form method="POST" action="{{ route('user.booking.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uid" value="{{Auth::guard('user')->user()->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DOCTOR's NAME <span class="text-danger">*</span></label>
                                    <select name='docname' id='docname' class="form-control">
                                        @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->first_name}}</option>
                                        @endforeach
                                        </select>
                                    @error('docname')
                                    <span id="docname-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DATE OF APPOINMENT <span class="text-danger">*</span> </label>
                                    <select name='doa' id='doa' class="form-control doa">
                                        {{-- @foreach($appointmentdates as $appointmentdate)
                                        <option value="{{$appointmentdate->d_o_a}}">{{$appointmentdate->d_o_a}}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('doa')
                                    <span id="doa-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TIME SLOT <span class="text-danger">*</span></label>
                                    <select name='tslt' id='tslt' class="form-control">
                                        
                                    </select>
                                    @error('tslt')
                                    <span id="tslt-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Illness you Want to Consult the doctor for<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('illness')is-invalid @enderror" id="illness" name="illness" value="{{ old('illness') }}"  placeholder="Enter your Illness you want to consult the doctor for"
                                           @error('illness')aria-describedby="illness-error" aria-invalid="true" @enderror required>
                                    @error('illness')
                                    <span id="illness-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            var App = {
                initialize: function () {

                }
            };
            App.initialize();
        })
    </script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#docname').change(function(){
            var docId = $(this).val();

                    $.ajax({
                    url: '/user/booking/available-dates',
                    type: 'GET',
                    data: {
                    'docId':docId

                    },
                    beforeSend: function() {
                    },
                    complete: function() {
                    },
                    success: function(data) {
                    console.log(data);
                    $('#doa').empty().append('<option value="">Select Date</option>');
                    // if(data.length==0){
                   
                    // }else
                    // {
                    
                    // }

                    $.each(data, function (i, item) {
                    $('#doa').append($('<option>', {
                    value: item.d_o_a,
                    text : item.d_o_a
                    }));
                    });

                    },
                    error: function(e) {

                    console.log(e.message);
                    }
                    });
        });
    });
    
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#doa').change(function(){
            var avaiDoa = $(this).val();

                    $.ajax({
                    url: '/user/booking/available-slots',
                    type: 'GET',
                    data: {
                    'avaiDoa':avaiDoa

                    },
                    beforeSend: function() {
                    },
                    complete: function() {
                    },
                    success: function(data) {
                    console.log(data);
                    $('#tslt').empty().append('<option value="">Select Time Slot</option>');
                    // if(data.length==0){
                   
                    // }else
                    // {
                    
                    // }

                    $.each(data, function (i, item) {
                    $('#tslt').append($('<option>', {
                    value: item.id,
                    text : item.time_slot
                    }));
                    });

                    },
                    error: function(e) {

                    console.log(e.message);
                    }
                    });
        });
    });
    
</script>
    
@endpush
