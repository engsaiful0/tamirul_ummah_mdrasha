<section class="admin-visitor-area up_admin_visitor" id="add-deductions">
        <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'payroll-deduction-store','onsubmit' => "return validatePayrollDeductionSettings()"])}}
                    <h3 class="mb-20">Deduction</h3>
                    <div class="white-box">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label for="setting-percentage">Grouping<span class="text-danger"> *</span></label>

                                <select class="nice-select primary_select form-control{{ $errors->has('group_error_deductions') ? ' is-invalid' : '' }}" id="deductions_group_name" name="deductions_group_name">
                                    <option value="">select</option>
                                    @foreach($setting_group as $group)
                                        <option value="{{$group->id}}" {{ isset($deductionsData->group_id) && $deductionsData->group_id == $group->id ? 'selected' : '' }}>{{$group->group_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger"  id="group_error_deductions"></span>
                                @if ($errors->has('group_error_deductions'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('group_error_deductions') }}
                                    </span>
                                @endif 
                           </div> 
                           <div class="col-lg-6">
                             <div class="form-group">
                                <label for="setting-name">Name<span class="text-danger"> *</span></label>
                                <input type="text" class="primary_input_field form-control{{ $errors->has('name_error_deductions') ? ' is-invalid' : '' }}" id="deductions_name" name="deductions_name" placeholder="Enter Name" value="{{isset($deductionsData)? @$deductionsData->name: ''}}">
                                <span class="text-danger"  id="name_error_deductions"></span>
                                @if ($errors->has('name_error_deductions'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('name_error_deductions') }}
                                    </span>
                                @endif
                                <input type="hidden" id="deduction_id" name="deduction_id" value="{{isset($deductionsData)? @$deductionsData->id: ''}}">
                             </div>
                           </div>
                           <div class="col-lg-6">
                             <div class="form-group">
                                <label for="setting-percentage">Percentage<span class="text-danger"> *</span></label>
                                <select class="nice-select primary_select form-control{{ $errors->has('type_name_error_deductions') ? ' is-invalid' : '' }}" id="deductions_type_name" name="deductions_type_name">
                                    <option value="">Select</option>
                                    <option value="% of CTC" {{ isset($deductionsData->type_name) && $deductionsData->type_name == '% of CTC' ? 'selected' : '' }}>% of CTC</option>
                                    <option value="Default" {{ isset($deductionsData->type_name) && $deductionsData->type_name == 'Default' ? 'selected' : '' }}>Default </option>
                                    <option value="None" {{ isset($deductionsData->type_name) && $deductionsData->type_name == 'None' ? 'selected' : '' }}>None</option>
                                </select>
                             </div>
                             <span class="text-danger"  id="type_name_error_deductions"></span>
                                @if ($errors->has('type_name_error_deductions'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('type_name_error_deductions') }}
                                    </span>
                                @endif
                           </div> 
                           <div class="col-lg-12 text-right earning-btns">
                                <button type="button" class="primary-btn small fix-gr-br mr-10" id="deduction-cancel-btn">
                                        Cancel  
                                </button>
                                <button type="submit" class="primary-btn small fix-gr-bg payroll-settings-btn">
                                    <span class="ti ti-plus pr-2"></span>
                                    @if(isset($deductionsData->id) && $deductionsData->id!='')
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