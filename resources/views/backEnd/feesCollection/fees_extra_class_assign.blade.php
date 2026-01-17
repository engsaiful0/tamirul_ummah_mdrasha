@extends('backEnd.master')
@section('title') 
@lang('fees.assign_fees_extra_class')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h1>@lang('fees.extra_class')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('fees.fees')</a>
                <a href="#">@lang('fees.extra_class')</a>
            </div>
        </div>
</div>
</div>
    </div>
</section>  
    <section class="admin-visitor-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('common.select_criteria')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">                   
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees-extraclass-assign-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA','onsubmit' => "return validateExtraFilters()"]) }}
                        <div class="row">


                            <div class="col-lg-3 mt-30-md">
                                <select class="primary_select  form-control{{ $errors->has('class_error') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('common.select_class')" value="">@lang('common.select_class')*</option>
                                    @if(isset($classes) && $classes!='')
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" >{{$class->class_name}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                <span class="text-danger"  id="class_error"></span>
                                @if ($errors->has('class_error'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('class_error') }}
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="primary_select  form-control{{ $errors->has('extra_class_error') ? ' is-invalid' : '' }}" id="select_extra_class" name="extra_class">
                                    <option data-display="@lang('common.select_extra_class')" value="">@lang('common.select_extra_class')*</option>
                                    @if(isset($extraclasses) && $extraclasses!='')
                                    @foreach($extraclasses as $class)
                                        <option value="{{$class->id}}" >{{$class->class_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="text-danger"  id="extra_class_error"></span>
                                @if ($errors->has('extra_class_error'))
                                    <span class="text-danger invalid-select" role="alert">
                                        {{ $errors->first('extra_class_error') }}
                                    </span>
                                @endif
                            </div>
                             <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti ti-search pr-2"></span>
                                    @lang('common.search')
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if(!empty($studentsExtraRecords))
                {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => 'fees-extraclass-assign-store'])}}
                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <div class="row mb-20">
                                <div class="col-lg-6 no-gutters">
                                    <div class="main-title">
                                        <h3 class="mb-0">@lang('fees.assign_fees_extra_class')</h3>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="std_class_id" name="std_class_id" value="{{$std_class_id}}">
                            <!-- <input type="hidden" name="fees_discount_id" value="" id="fees_discount_id"> -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <x-table>
                                        <table id="table_id_table" class="table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <tr>
                                                        <th>@lang('fees.extra_curricular_class')</th>
                                                        <th>@lang('fees.amount')</th>
                                                    </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" id="extra_class_id" name="extra_class_id" value="{{$extraClassId}}">
                                                        {{$extraClassName}}
                                                    </td>
                                                    <td><input type="text" class="primary_input_field" id="extra_class_fees" name="extra_class_fees" value="{{$fees_amount}}"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </x-table>
                                </div>
                                <div class="col-lg-8">
                                    <div class="table-responsive">
                                        <x-table>
                                            <table  class="table school-table-style" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">
                                                            <input type="checkbox" id="checkAll" class="common-checkbox" name="checkAll"  
                                                                @php
                                                                    if(count($studentsExtraRecords) > 0){
                                                                        if(count($studentsExtraRecords) == count($pre_assigned)){
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                @endphp>
                                                            <label for="checkAll"> @lang('common.all')</label>
                                                        </th>
                                                        <th width="20%">@lang('student.student_name')</th>
                                                        <th width="10%">@lang('student.admission_no')</th>                                                        
                                                        <th width="15%">@lang('common.status')</th>
                                                        <th width="15%">@lang('common.class')</th>
                                                        <th width="15%">@lang('student.father_name')</th>
                                                        <th width="10%">@lang('student.category')</th>
                                                        <th width="5%">@lang('common.gender')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_fine = 0;
                                                    $total_paid = 0;
                                                    $total_grand_paid = 0;
                                                    $total_balance = 0;
                                                    $assigned_amount=0;
                                                    $i=0;
                                                    @endphp
                                                    @if(count($studentsExtraRecords)>0)
                                                    @foreach($studentsExtraRecords as $student)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                $show='';
                                                                $paidclass='unpaid';
                                                                $checkPayment=App\SmExtraclassFees::feespaidSum($student->student_id, 'amount', $student->id);
                                                                if ($checkPayment>0) {
                                                                    $show='disabled';
                                                                    $paidclass = 'paid';
                                                                }

                                                                $studentInfo=App\SmExtraclassFees::studentclass($student->student_id);

                                                                $feesPayable = App\SmExtraclassFees::extraFeesPayable($std_class_id,$student->extra_class_id);
                                                                $paid = App\SmExtraclassFees::feespaidSum($student->student_id, 'amount', $student->id);

                                                                if(empty($paid))
                                                                { 
                                                                    $paid=0;
                                                                }

                                                                $total_grand_paid += $paid;                                                                
                                                                /*
                                                                $fine = App\SmExtraclassFees::feespaidSum($student->student_id, 'fine',$student->id);
                                                                if(empty($fine))
                                                                { 
                                                                    $fine=0;
                                                                }
                                                                $total_fine += $fine;
                                                                */
                                                                $total_paid = $paid;
                                                                @endphp
                                                                <!-- <input type="text" name="hidstudent_id" value="{{$student->student_id}}">
                                                                <input type="text" name="hidindex" value="{{$loop->index}}"> -->
                                                                <input type="checkbox" id="student.{{$student->id}}" {{@$show}} class="common-checkbox allcheckbox {{$paidclass}}" name="data[{{$loop->index}}][checked]" value="1" {{in_array($student->id, $pre_assigned)? 'checked':''}} {{in_array($student->student_id, $already_paid)? 'disabled="disabled"':''}} >
                                                                <label for="student.{{$student->id}}"></label>
                                                            </td>
                                                                <input type="hidden" name="data[{{$loop->index}}][class_id]" value="{{@$student->class_id}}">
                                                                <input type="hidden" name="data[{{$loop->index}}][section_id]" value="{{@$student->section_id}}">
                                                                <input type="hidden" name="data[{{$loop->index}}][record_id]" value="{{@$student->id}}">
                                                                <input type="hidden" name="data[{{$loop->index}}][student_id]" value="{{$student->student_id}}">
                                                            <td>{{$student->studentDetail->full_name}}</td>
                                                            <td>{{$student->studentDetail->admission_no}}</td>
                                                            <td>
                                                                @php
                                                                if(isset($assigned_fees_amount[$i]) && $assigned_fees_amount[$i]!=''){
                                                                    $assigned_amount = $assigned_fees_amount[$i];
                                                                }
                                                                    $rest_amount =  $assigned_amount - $total_paid;
                                                                    $total_balance +=  $rest_amount;
                                                                    $balance_amount = number_format($rest_amount, 2, '.', '');
                                                                @endphp
                                                                @if($feesPayable == 0)
                                                                <button class="primary-btn small bg-danger text-white border-0">@lang('fees.unpaid')</button>
                                                                @elseif($paid == 0)
                                                                    <button class="primary-btn small bg-danger text-white border-0">@lang('fees.unpaid')</button>
                                                                @elseif($balance_amount == 0)
                                                                    <button class="primary-btn small bg-success text-white border-0">@lang('fees.paid')</button>
                                                                @elseif($paid != 0)
                                                                    <button class="primary-btn small bg-warning text-white border-0">@lang('fees.partial')</button>
                                                                @endif
                                                            </td>

                                                            <td>{{$studentInfo!= ""? @$studentInfo->class_name :""}} </td>
                                                            

                                                            <td>{{$student->studentDetail->parents!=""?$student->studentDetail->parents->fathers_name:""}}</td>
                                                            <td>{{$student->studentDetail->category!=""?$student->studentDetail->category->category_name:""}}</td>
                                                            <td>{{$student->studentDetail->gender!=""?$student->studentDetail->gender->base_setup_name:""}}</td>
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="8">
                                                            @lang('fees.no_records')
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                                @if($studentsExtraRecords->count() > 0)
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="text-center">
                                                                <button type="submit" class="primary-btn fix-gr-bg mb-0" id="btn-assign-extrafees">
                                                                    <span class="ti-device-floppy pr"></span>
                                                                    @lang('fees.assign_extra_fees')
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </x-table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            @endif
        </div>
    </div>
</section>
@endsection
@include('backEnd.partials.data_table_js')