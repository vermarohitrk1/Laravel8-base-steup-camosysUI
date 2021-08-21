<div class="card">
                               <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Employment Setting</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                
                                    <form class="form form-horizontal axios-form" method="post" action="{{ url('admin/user/update_employment') }}">
                                    <div class="card-body">
                                        @csrf
                                               <input type="hidden" name="id" value="{{$user->id}}">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Hire Date</label>
                                                    <input type="date" id="hire-date" class="form-control" name="hire_date" value="{{$user->employments ? $user->employments->hire_date : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="Credentials-number">Credentials Number</label>
                                                 <input type="text" id="Credentials-number" class="form-control" name="credentials_number" placeholder="Credentials Numbers" value="{{$user->employments ? $user->employments->credentials_number : '' }}">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column"></br></label>
                                                    <a class="btn btn-outline-danger ml-1 send-to-server-click" data="id:{{ $user->id}}|_token:{{ csrf_token() }}" url="{{url('admin/user/terminate')}}" warning-title="Are you sure?" warning-message="This course and all it's data will be deleted." icon="warning" warning-button="Terminate" button-color="" loader="true">
                                                    Terminate User</a>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12 col-12">
                                            
                                                            <div class="table-responsive border rounded mt-1 mb-2">
                                                                <h6 class="py-1 mx-1 mb-0">
                                                                Working Days
                                                                </h6>
                                                                <table class="table">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th>Sun</th>
                                                                            <th>Mon</th>
                                                                            <th>Tue</th>
                                                                            <th>Wed</th>
                                                                            <th>Thu</th>
                                                                            <th>Fri</th>
                                                                            <th>Sat</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_sun" id="sun" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->sunday == 1 ? 'checked' : '' }} @endif />
                                                                                    <label class="custom-control-label" for="sun"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_mon" id="mon" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->monday == 1 ? 'checked' : '' }} @endif />
                                                                                    <label class="custom-control-label" for="mon"></label>
                                                                                </div></td>
                                                                            
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_tue" id="tue" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->tuesday == 1 ? 'checked' : '' }} @endif />
                                                                                    <label class="custom-control-label" for="tue"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_wed" id="wed" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->wednesday == 1 ? 'checked' : '' }} @endif />
                                                                                    <label class="custom-control-label" for="wed"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_thu" id="thu" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->thursday == 1 ? 'checked' : '' }} @endif/>
                                                                                    <label class="custom-control-label" for="thu"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_fri" id="fri" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->friday == 1 ? 'checked' : '' }} @endif/>
                                                                                    <label class="custom-control-label" for="fri"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="working_sat" id="sat" @if($user->usersWorkingDays) {{ $user->usersWorkingDays->saturday == 1 ? 'checked' : '' }} @endif/>
                                                                                    <label class="custom-control-label" for="sat"></label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                       
                                            </div>
                                        
                                            <div class="col-md-6 col-12">
                                                <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label for="itemname">Payout Type</label>
                                                            <select class="custom-select" name="payout_type" id="customSelect" aria-describedby='qualification'>
                                                                <option @if($user->payrate) {{ $user->payrate->payout_type == '' ? 'selected' : '' }} @endif disabled>Select Pay-rate Type</option>
                                                                <option value="monthly" @if($user->payrate) {{ $user->payrate->payout_type == 'monthly' ? 'selected' : '' }} @endif>Monthly</option>
                                                                <option value="weekly" @if($user->payrate) {{ $user->payrate->payout_type == 'weekly' ? 'selected' : '' }} @endif>Weekly</option>
                                                                <option value="daily"  @if($user->payrate) {{ $user->payrate->payout_type == 'daily' ? 'selected' : '' }} @endif>Daily</option>
                                                                <option value="hourly"  @if($user->payrate) {{ $user->payrate->payout_type == 'hourly' ? 'selected' : '' }} @endif>Hourly</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label for="itemname">Pay Rate</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                                 @php if($user->payrate && $user->payrate->payout_type != '')  $pay = $user->payrate->payout_type.'_rate'; else $pay = 'monthly_rate'; @endphp
                                                                <input type="text" class="form-control" placeholder="100" name="pay_rate" value="{{ $user->payrate ? $user->payrate->$pay : '' }}" aria-label="Amount (to the nearest dollar)" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                        <label for="itemname">Overtime Rate</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder="100" name="overtime_rate" value="{{ $user->payrate ? $user->payrate->overtime_rate : '' }}" aria-label="Amount (to the nearest dollar)" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">.00/Per Hrs</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12 form-group">
                                                            <label for="itemname">Working Shift</label>
                                                            <select class="custom-select" name="working_shift" id="customSelect" aria-describedby='qualification'>
                                                                <option @if($user->payrate) {{ $user->payrate->working_shift == '' ? 'selected' : '' }} @endif disabled>Select Working Shift</option>
                                                                <option value="24hrs" @if($user->payrate) {{ $user->payrate->working_shift == '24hrs' ? 'selected' : '' }} @endif>24Hrs</option>
                                                                <option value="day_shift" @if($user->payrate) {{ $user->payrate->working_shift == 'day_shift' ? 'selected' : '' }} @endif>Day Shift</option>
                                                                <option value="night_shift" @if($user->payrate) {{ $user->payrate->working_shift == 'night_shift' ? 'selected' : '' }} @endif>Night Shift</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 form-group">
                                                            <label for="fp-time">Clock-In</label>
                                                            <input type="text" id="fp-time" name="clock_in" class="form-control flatpickr-time text-left" value="{{ $user->payrate ? $user->payrate->clock_in : '' }}" placeholder="HH:MM" />
                                                        </div>
                                                        <div class="col-md-6 col-6 form-group">
                                                            <label for="fp-time">Clock-Out</label>
                                                            <input type="text" id="fp-time" name="clock_out" class="form-control flatpickr-time text-left" value="{{ $user->payrate ? $user->payrate->clock_out : '' }}" placeholder="HH:MM" />
                                                        </div>
                                                        <div class="col-md-12 col-12 form-group">
                                                            <label for="itemname">Payout Method</label>
                                                            <select class="custom-select payout-method" name="payout_method" id="customSelect" aria-describedby='qualification'>
                                                                <option @if($user->payrate) {{ $user->payrate->default_payout_method == '' ? 'selected' : '' }} @endif disabled>Select Payout Type</option>
                                                                <option value="deposit_bank" @if($user->payrate) {{ $user->payrate->default_payout_method == 'deposit_bank' ? 'selected' : '' }} @endif>Deposit Bank</option>
                                                                <option value="cheque" @if($user->payrate) {{ $user->payrate->default_payout_method == 'cheque' ? 'selected' : '' }} @endif>Cheque</option>
                                                                <option value="zell" @if($user->payrate) {{ $user->payrate->default_payout_method == 'zell' ? 'selected' : '' }} @endif>Zell</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>                  
                                                    
                                            </div>
                                                <div class="col-md-6 col-12 form-group">
                                                            <label for="itemname">Payout Schedule</label>
                                                            <select class="custom-select" name="pay_schedule" id="customSelect" aria-describedby='qualification'>
                                                                <option @if($user->payrate) {{ $user->payrate->pay_schedule == '' ? 'selected' : '' }} @endif disabled>Select pay date</option>
                                                                <option value="2_week"  @if($user->payrate) {{ $user->payrate->pay_schedule == '2_week' ? 'selected' : '' }} @endif>Every other 2 weeks</option>
                                                                <option value="specific" @if($user->payrate) {{ $user->payrate->pay_schedule == 'spesific' ? 'selected' : '' }} @endif>Specific Date</option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Pay Date</label>
                                                            <input type="date" id="pay-date" name="payout_date" value="{{ $user->payrate ? $user->payrate->payout_date : '' }}" class="form-control" name="pay_date"  value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                            <div class="tab-content payout-tabs">
                                                                <div class="tab-pane" id="deposit_bank" aria-labelledby="home-tab" role="tabpanel">
                                                                <h4 class="card-title">Bank Account Details</h4>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-12">
                                                                        <div class="form-group">
                                                                            <label for="acc_number">Account Number</label>
                                                                        <input type="text" id="acc_number" class="form-control" name="acc_number" placeholder="Account Number" value="{{ $user->bankAccounts ? $user->bankAccounts->account_number : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group">
                                                                            <label for="acc_name">Account Name</label>
                                                                        <input type="text" id="acc_name" class="form-control" name="acc_name" value="{{ $user->bankAccounts ? $user->bankAccounts->account_holder_name : '' }}" placeholder="Account Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="bnak">Bank Name</label>
                                                                        <input type="text" id="bank" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ $user->bankAccounts ? $user->bankAccounts->bank_name : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="ifsc">IFSC Code</label>
                                                                        <input type="text" id="ifsc" class="form-control" name="ifcs" placeholder="IFSC Code" value="{{ $user->bankAccounts ? $user->bankAccounts->ifsc_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="tab-pane" id="cheque" aria-labelledby="home-tab" role="tabpanel">
                                                                <h4 class="card-title">Cheque Payout Details</h4>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-12">
                                                                        <div class="form-group">
                                                                            <label for="name_for_check">Enter Name</label>
                                                                        <input type="text" id="name_for_check" class="form-control" name="cheque_name" placeholder="Enter Name for cheque" value="{{ $user->bankAccounts ? $user->bankAccounts->name_for_cheque : '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="tab-pane" id="zell" aria-labelledby="home-tab" role="tabpanel">
                                                                <h4 class="card-title">Zell Account Details</h4>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-12">
                                                                        <div class="form-group">
                                                                            <label for="zell">Zell Account ID</label>
                                                                        <input type="text" id="zell" class="form-control" name="zell_id" placeholder="Zell Account Id" value="{{ $user->bankAccounts ? $user->bankAccounts->zell_id : '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div> <!--end-main-row-->

                                    </div>
                                    <div class="modal-footer">
                                    <a class="btn btn-outline-danger" href="javascript:void(0);" data-toggle="modal" data-target="#terminate_modal">Terminate User</a>

                                    <button type="submit" class="btn btn-success mr-1 waves-effect waves-float waves-light">Submit</button>
                                    </div>
                                </form>
                                
                            </div>
                           <div class="modal-size-lg d-inline-block">
        <div class="modal fade text-left" id="terminate_modal" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                       <h4 class="modal-title" id="myModalLabel17">Terminate User</h4>
                       <button type="button" class="close" onclick="$('#terminate_modal').modal('hide');" aria-label="Close">
                           <span aria-hidden="true">×</span>
                       </button>
                   </div>
                   <form class="form form-horizontal axios-form" method="post" action="{{ url('admin/user/terminate') }}">
                       @csrf
                           <div class="modal-body">
                           <input type="hidden" name="id" value="{{ $user->id}}">
                                            <div class="row">
                                                   <div class="col-md-6 col-12">
                                                       <div class="form-group">
                                                           <label for="last-working-day">Last Working day</label>
                                                       <input type="date" id="last-working-day" class="form-control" name="last_working_day" placeholder="Last working day" value="">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6 col-12">
                                                       <div class="form-group">
                                                           <label for="termination-note">Notice Period</label>
                                                       <input type="text" id="termination-note" class="form-control" name="notice_period" placeholder="Notice Period" value="">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12 col-12">
                                                       <div class="form-group">
                                                           <label for="termination-note">Reason for end of contract</label>
                                                       <input type="text" id="termination-note" class="form-control" name="termination_note" placeholder="Resion" value="">
                                                       </div>
                                                   </div>
                                                   
                                                   <div class="col-lg-6 col-sm-12 col-12">
                                                       <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Ratings</h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="d-flex flex-wrap mb-1 align-items-center">
                                                                            <label class="h6 mb-0">Cleanliness:</label>
                                                                        <div class="ml-auto full-star-ratings" data-rateyo-full-star="true"></div>
                                                                        <input type="hidden" name="cleanliness" value="1">
                                                                        </div>
                                                                        <div class="d-flex flex-wrap mb-1 align-items-center">
                                                                            <label class="h6 mb-0">Cooking:</label>
                                                                        <div class="ml-auto full-star-ratings" data-rateyo-full-star="true"></div>
                                                                        <input type="hidden" name="cooking" value="1">
                                                                        </div>
                                                                        <div class="d-flex flex-wrap mb-1 align-items-center">
                                                                            <label class="h6 mb-0">Communication:</label>
                                                                        <div class="ml-auto full-star-ratings" data-rateyo-full-star="true"></div>
                                                                        <input type="hidden" name="communication" value="1">
                                                                        </div>
                                                                        <div class="d-flex flex-wrap mb-1 align-items-center">
                                                                            <label class="h6 mb-0">Reliability:</label>
                                                                        <div class="ml-auto full-star-ratings" data-rateyo-full-star="true"></div>
                                                                        <input type="hidden" name="reliability" value="1">
                                                                        </div>
                                                                        <div class="d-flex flex-wrap mb-1 align-items-center">
                                                                            <label class="h6 mb-0">Recommendation:</label>
                                                                        <div class="ml-auto full-star-ratings" data-rateyo-full-star="true"></div>
                                                                        <input type="hidden" name="recomendation" value="1">
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                           </div>
                           <div class="modal-footer">
                     <button type="submit" class="btn btn-outline-danger mr-1 waves-effect waves-float waves-light">Terminate</button>
                     </div>
                 </form>
                </div>
            </div>
        </div></div>
        <!--end terminate modal-->

        <div class="modal fade text-left" id="bank_detail_modal" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="bank_acc_holder"> </div>
                </div>
            </div>
        </div>
        <!--end-update-bank-account-modal-->
        <!-- <script src="{{ asset('app-assets/js/scripts/jquery-ui.min.js') }}"></script> -->
        <script>
            $('.full-star-ratings').rateYo({ rating: 1 });
            $(".full-star-ratings").on('click' ,function(){
                var f = $(this).find('.jq-ry-rated-group').width() / $(this).find('.jq-ry-rated-group').parent().width() * 100;
               var width = f / 20;
                $(this).next(':input').val(width);
            });
            $('.payout-method').on('change', function(){
                $('.payout-tabs .tab-pane').removeClass('active');
                $('.payout-tabs #'+$(this).val()).addClass('active');
            });
            $(document).ready(function(){
                $('.payout-tabs .tab-pane').removeClass('active');
                $('.payout-tabs #'+$('.payout-method').find(':selected').val()).addClass('active');
            });

            $(".modal .modal").on("hidden.bs.modal", function () {
                setTimeout(function(){$('body').addClass('modal-open');}, 1000);
            });
            </script>