@foreach($doctors as $doctor)
 
 <div id="add-timeslot-{{$doctor->id}}" class="modal fade" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title"><strong>ADD BOOKING SLOT FOR DOCTORS</strong></h4>
                <button type="button" class="close" data-dismiss="modal" style="outline: none;">×</button>
            </div>
            <form name="edup" method="post" action="{{route('admin.add.timeslot')}}" >
                @csrf
                <input type="hidden" name="did" value="{{$doctor->id}}">
                <table  class='table table-striped table-fit table-bordered table-hover' cellpadding="10px" style="text-align: center">
                    <tr>
                        <th>SELECT START DATE OF THE RANGE OF DATES: </th>
                        <td><div class="form-group">
                            <div class="input-group">
                                <input type="date" name="stadoa" class="form-control @error('stadoa')is-invalid @enderror" value="{{ old('stadoa') }}"
                                @error('stadoa')aria-describedby="stadoa-error" aria-invalid="true" @enderror required>
                                @error('stadoa')
                                    <span id="stadoa-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- /.input group -->
                            </div></td>
                        
                    </tr>
                    <tr>
                        <th>SELECT END DATE OF THE RANGE OF DATES: </th>
                        <td><div class="form-group">
                            <div class="input-group">
                                <input type="date" name="enddoa" class="form-control @error('enddoa')is-invalid @enderror" value="{{ old('enddoa') }}"
                                @error('enddoa')aria-describedby="enddoa-error" aria-invalid="true" @enderror required>
                                @error('enddoa')
                                    <span id="enddoa-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </td>
                        
                    </tr>
                    <tr><th>SLOT START TIME:</th>
                        <td><div class="form-group">
                            <div class="input-group">
                                <select name='stattim' id='stattim' class="form-control">
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="13:30">01:30 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="14:30">02:30 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="15:30">03:30 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="16:30">04:30 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="17:30">05:30 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="18:30">06:30 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                    <option value="19:30">07:30 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                    <option value="20:30">08:30 PM</option>
                                </select>
                                {{-- <input type="time" name="stattim" class="form-control @error('stattim')is-invalid @enderror" value="{{ old('stattim') }}"
                                @error('stattim')aria-describedby="stattim-error" aria-invalid="true" @enderror required> --}}
                                @error('stattim')
                                    <span id="stattim-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>SLOT END TIME:</th>
                        <td><div class="form-group">
                            <div class="input-group">
                                <select name='endtim' id='endtim' class="form-control">
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="13:30">01:30 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="14:30">02:30 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="15:30">03:30 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="16:30">04:30 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="17:30">05:30 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="18:30">06:30 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                    <option value="19:30">07:30 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                    <option value="20:30">08:30 PM</option>
                                </select>
                                {{-- <input type="time" name="endtim" class="form-control @error('endtim')is-invalid @enderror" value="{{ old('endtim') }}"
                                @error('endtim')aria-describedby="endtim-error" aria-invalid="true" @enderror required> --}}
                                @error('endtim')
                                    <span id="endtim-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>MINUTES PER SLOT:</th>
                        <td><div class="form-group">
                            <div class="input-group"> --}}
                                <input type="hidden" name="slottim" class="form-control @error('slottim')is-invalid @enderror" value="30" 
                                @error('slottim')aria-describedby="slottim-error" aria-invalid="true" @enderror required >
                                {{-- @error('slottim')
                                    <span id="slottim-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="2" >
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="submit" value="ADD SLOT" class="btn btn-success"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@endforeach