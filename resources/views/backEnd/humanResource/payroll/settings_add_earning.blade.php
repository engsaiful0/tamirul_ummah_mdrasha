<section class="admin-visitor-area up_admin_visitor" id="add-earnings">
        <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'payroll-earnings-store','onsubmit' => "return validatePayrollEarningsSettings()"])}}
                    <h3 class="mb-20">Earning</h3>
                    <div class="white-box">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label for="setting-percentage">Grouping<span class="text-danger"> *</span></label>
                                

                                <select class="nice-select primary_select form-control{{ $errors->has('group_error_earnings') ? ' is-invalid' : '' }}" id="earnings_group_name" name="earnings_group_name">
                                    <option value="">select</option>
                                    @foreach($setting_group as $group)
                                        <option value="{{$group->id}}" {{ isset($earningsData->group_id) && $earningsData->group_id == $group->id ? 'selected' : '' }}>{{$group->group_name}}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                                <span class="text-danger"  id="group_error_earnings"></span>
                                @if ($errors->has('group_error_earnings'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('group_error_earnings') }}
                                    </span>
                                @endif                            
                           </div> 
                           <div class="col-lg-6">
                             <div class="form-group">
                                <label for="setting-name">Name<span class="text-danger"> *</span></label>
                                <input type="text" class="primary_input_field form-control{{ $errors->has('name_error_earnings') ? ' is-invalid' : '' }}" id="earnings_name" name="earnings_name" placeholder="Enter Name" value="{{isset($earningsData)? @$earningsData->name: ''}}">
                                <span class="text-danger"  id="name_error_earnings"></span>
                                @if ($errors->has('name_error_earnings'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('name_error_earnings') }}
                                    </span>
                                @endif
                                <input type="hidden" id="earning_id" name="earning_id" value="{{isset($earningsData)? @$earningsData->id: ''}}">
                             </div>
                           </div>
                           <div class="col-lg-6">
                             <div class="form-group">
                                <label for="setting-percentage">Percentage<span class="text-danger"> *</span></label>
                                <select class="nice-select primary_select form-control {{ $errors->has('type_name_error_earnings') ? ' is-invalid' : '' }}" id="earnings_type_name" name="earnings_type_name">
                                    <option value="">Select</option>
                                    <option value="% of CTC" {{ isset($earningsData->type_name) && $earningsData->type_name == '% of CTC' ? 'selected' : '' }}>% of CTC</option>

                                    <option value="% of Basic" {{ isset($earningsData->type_name) && $earningsData->type_name == '% of Basic' ? 'selected' : '' }}>% of Basic</option>

                                    <option value="Default" {{ isset($earningsData->type_name) && $earningsData->type_name == 'Default' ? 'selected' : '' }}>Default </option>
                                    <option value="None" {{ isset($earningsData->type_name) && $earningsData->type_name == 'None' ? 'selected' : '' }}>None</option>   
                                </select>                                
                             </div>
                             <span class="text-danger"  id="type_name_error_earnings"></span>
                                @if ($errors->has('type_name_error_earnings'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('type_name_error_earnings') }}
                                    </span>
                                @endif
                           </div> 
                           <div class="col-lg-12 text-right earning-btns">
                                <button type="button" class="primary-btn small fix-gr-br mr-10" id="earning-cancel-btn">
                                        Cancel  
                                </button>
                                <button type="submit" class="primary-btn small fix-gr-bg payroll-settings-btn">
                                    <span class="ti ti-plus pr-2"></span>
                                    @if(isset($earningsData->id) && $earningsData->id!='')
                                        Update
                                    @else
                                        Save
                                    @endif    
                                </button>
                           </div>
                        </div>    
                    </div>                    
                {{ Form::close() }}
                </div>            
            </div>    
        </div>
    </section>