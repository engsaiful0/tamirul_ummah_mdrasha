<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
{{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'payroll-deduction-settings-store'])}}


    <!-- Deduction content -->
    <div class="earning-title-info d-flex align-items-center justify-content-between mb-20">
        <h3> Deductions </h3>
        <button type="button" id="add-deduction-btn" class="primary-btn small fix-gr-bg add-deduction-btn">
            <span class="ti ti-plus pr-2"></span>
            Add
        </button>
    </div>
    <div class="table-responsive">
        <table id="table-deductions" class="table Crm_table_active3" cellspacing="0" width="100%" role="grid" aria-describedby="table_id_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Class: activate to sort column descending">Name</th>
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Class: activate to sort column descending">Percentage</th>
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Class: activate to sort column descending">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $previousDeductionName='';
                $deduction_title=true;
                @endphp
                
                @foreach($setting_group as $group)
                @foreach($deductions as $deduction)
                    @php
                        if($group->id==$deduction->group_id){
                           $group_name = $group->group_name;
                        
                    @endphp
               
               @php
                if($previousDeductionName=='')
                {
                    $previousDeductionName=$group_name;
                    $deduction_title=true;
                }elseif($group_name==$previousDeductionName){
                    $deduction_title=false;
                }elseif($group_name!=$previousDeductionName){
                    $deduction_title=true;
                    $previousDeductionName=$group_name;
                }  
                @endphp
                @if((isset($group_name) && $group_name!='None') && $deduction_title==true)
                <tr role="row" class="odd">
                    <td colspan="3" class="pf-title">{{$group_name}}</td>
                </tr> 
                @endif
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        {{$deduction->name}}
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                            <input type="hidden" name="deduction_ids[]" id="deduction_ids" value="{{$deduction->id}}" {{ isset($deduction->id) && $deduction->id == '1' ? 'disabled' : '' }}>
                            <input type="hidden" name="deduction_type[]" id="deduction_ids" class="percentage-type" value="{{$deduction->type_name}}"> 

                            <input type="text" class="primary_input_field primary_input_field form-control input-earning percentage-input" id="deduction_data" name="deduction_data[]" value="{{$deduction->percentage}}" placeholder="10" {{ isset($deduction->id) && $deduction->id == '1' ? 'disabled' : '' }}>
                            <span class="earning-info">{{$deduction->type_name}}</span>
                        </div>
                    </td>
                    @if($deduction->id>6)
                    <td valign="top">
                        @php
                            $routeList = [
                                
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_deductions_edit', [@$deduction->id]).'">'.__('common.edit').'</a>',
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_deductions_delete', [@$deduction->id]).'">'.__('common.delete').'</a>',
                                
                                ];
                        @endphp
                        <x-drop-down-action-component :routeList="$routeList" />
                    </td>
                    @else
                    <td valign="top">
                        @php
                            $routeList = [
                                
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_deductions_edit', [@$deduction->id]).'">'.__('common.edit').'</a>',
                                ];
                        @endphp
                        <x-drop-down-action-component :routeList="$routeList" />
                    </td>
                    @endif
                    
                </tr>
                @php
                }
                @endphp
                @endforeach                                 
                @endforeach                                 
            </tbody>
        </table>
    </div>  
    <div class="text-center">
        <button type="submit" class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="" data-original-title="">
            <span class="ti ti-check"></span>
            Save Settings                                             
        </button>
    </div>  
    <!-- Deduction tab -->                


{{ Form::close() }}