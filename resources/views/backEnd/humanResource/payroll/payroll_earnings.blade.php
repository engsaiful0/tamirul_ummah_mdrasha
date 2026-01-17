<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
{{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'payroll-earning-settings-store','onsubmit' => "return validateEarnings()"])}}

<!-- earning tab -->
    <!-- earning content -->
    <div class="earning-title-info d-flex align-items-center justify-content-between mb-20">
        <h3> Earnings </h3>
        <button type="button" id="add-earning-btn" class="primary-btn small fix-gr-bg add-earning-btn">
            <span class="ti ti-plus pr-2"></span>
            Add
        </button>
    </div>
    <div class="table-responsive earning-table">
        <table id="table-earning" class="table Crm_table_active3 earning-table-active1" cellspacing="0" width="100%" role="grid" aria-describedby="table_id_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Name</th>
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Percentage</th>
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $previousEarningName='';
                $earning_title=true;
                $total_percentage='';
                @endphp
                
                @foreach($setting_group as $group)
                @foreach($earnings as $earning)
                    @php
                        if($group->id==$earning->group_id){
                           $group_name = $group->group_name;
                            
                            if($group->id==1){
                                $total_percentage = $basic_percentage;
                            }elseif($group->id==2){
                                $total_percentage = $earning_percentage;
                            }
                           
                    @endphp
               
               @php
                if($previousEarningName=='')
                {
                    $previousEarningName=$group_name;
                    $earning_title=true;
                }elseif($group_name==$previousEarningName){
                    $earning_title=false;
                }elseif($group_name!=$previousEarningName){
                    $earning_title=true;
                    $previousEarningName=$group_name;
                }  
                @endphp
                @if((isset($group_name) && $group_name!='None') && $earning_title==true)
                <tr role="row" class="odd">
                    <td colspan="3" class="pf-title">
                        {{$group_name}} <span id="earning_percentage_{{$group->id}}">({{$total_percentage}}%)</span></td>
                </tr> 
                @endif
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        {{$earning->name}}
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                            <input type="hidden" name="earning_ids[]" id="earning_ids" value="{{$earning->id}}">
                            <input type="hidden" name="earning_type[]" id="earning_ids" class="percentage-type" value="{{$earning->type_name}}">

                            <input type="text" class="primary_input_field primary_input_field form-control input-earning percentage-input" id="earning_data" name="earning_data[]" value="{{$earning->percentage}}" placeholder="10" onblur="earningPercentage('{{$earning->id}}','{{$group->id}}')">
                            <span class="earning-info">{{$earning->type_name}}</span>
                        </div>
                    </td>
                    @if($earning->id>23)
                    <td valign="top">
                        @php
                            $routeList = [
                                
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_earnings_edit', [@$earning->id]).'">'.__('common.edit').'</a>',
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_earnings_delete', [@$earning->id]).'">'.__('common.delete').'</a>',
                                
                                ];
                        @endphp
                        <x-drop-down-action-component :routeList="$routeList" />
                    </td>
                    @else
                    <td valign="top">
                        @php
                            $routeList = [
                                
                                    '<a class="dropdown-item"
                                       href="'.route('payroll_earnings_edit', [@$earning->id]).'">'.__('common.edit').'</a>',
                                
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
        <div class="text-center p-15">
            <p id="percentageError" style="color: red;"></p>
            <p id="hraPercentError" style="color: red;"></p>
        </div>
    </div>  
    <div class="text-center mt-20">
        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="" data-original-title="">
            <span class="ti ti-check"></span>
            Save Earnings                                                
        </button>
    </div>  
    <!-- earning tab -->    
{{ Form::close() }}