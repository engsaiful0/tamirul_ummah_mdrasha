<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
{{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'payroll-epfwages-settings-store'])}}


    <!-- Deduction content -->
    <div class="earning-title-info d-flex align-items-center justify-content-between mb-20">
        <!-- <h3> EPF Wages </h3> -->
    </div>
    <div class="table-responsive">
        <table id="table-deductions" class="table Crm_table_active3" cellspacing="0" width="100%" role="grid" aria-describedby="table_id_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="2" aria-sort="ascending" aria-label="Class: activate to sort column descending">EPF Wages</th>
                    <!-- <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Class: activate to sort column descending">Percentage</th>
                    <th class="" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Class: activate to sort column descending">Action</th> -->
                </tr>
            </thead>
            <tbody>                
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        EPF Wages(%)
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                            <input class="primary_input_field form-control" type="text" id="epf_wages" name="epf_wages" value="{{$epfwages_setting->epfwages}}">
                        </div>
                    </td>                 
                </tr>   
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        EPF(%)
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                            <input class="primary_input_field form-control" type="text" id="epf" name="epf" value="{{$epfwages_setting->epf}}">
                        </div>
                    </td>                                      
                </tr>     
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        EPS(%)
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                            <input class="primary_input_field form-control" type="text" id="eps" name="eps" value="{{$epfwages_setting->eps}}">
                        </div>
                    </td>                   
                </tr>
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        ESI salary limit
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                        <input class="primary_input_field form-control" type="text" id="esi_salary_limit" name="esi_salary_limit" value="{{$epfwages_setting->esi_salary_limit}}">
                        </div>
                    </td>
                </tr> 
                <tr role="row" class="odd">
                    <td valign="top" tabindex="0" class="sorting_1 earning-td">
                        Dearness Allawance Maximum 
                    </td>
                    <td valign="top" tabindex="0" class="sorting_1">
                        <div class="form-check p-0 d-flex align-items-center form-ctc">
                        <input class="primary_input_field form-control" type="text" id="da_allwance_max" name="da_allwance_max" value="{{$epfwages_setting->da_allawance}}">
                        </div>
                    </td>
                </tr>                          
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