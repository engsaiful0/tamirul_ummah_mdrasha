@extends('backEnd.master')
@section('title') 
    @lang('fees.collect_fees')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h1>@lang('fees.collect_fees')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('fees.fees')</a>
                <a href="#">@lang('fees.collect_fees')</a>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'collect_extraclass_fees', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            @if(moduleStatusCheck('University'))
                            @includeIf('university::common.session_faculty_depart_academic_semester_level',  ['hide'=>['USUB'],'required'=> ['US','UF','UD','UA','USN','US','USL']])
                            @else
                            <div class="col-lg-6 mt-30-md infix_up_mt">
                                <select class="primary_select form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="extra_class">
                                    <option data-display="@lang('common.select_extra_class')" value="">@lang('common.select_extra_class')* </option>
                                    @foreach($extraclasses as $class)
                                    <option value="{{$class->id}}"  {{( old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="text-danger invalid-select" role="alert">
                                    {{ $errors->first('class') }}
                                </span>
                                @endif
                            </div>
                            @endif
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
            
        @if(isset($students))
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
                <div class="row mt-20">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8 no-gutters">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <x-table>
                                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><div class="admission-no">@lang('student.admission_no')</div></th>
                                                <th>@lang('common.name')</th>
                                                <th>@lang('common.date_of_birth')</th>
                                                <th>@lang('common.phone')</th>

                                                @if(! moduleStatusCheck('University'))
                                                <th>@lang('common.class')</th>
                                                <th>@lang('common.section')</th>
                                                <th>@lang('student.father_name')</th>
                                                @endif
                                                <th>@lang('common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>{{$student->studentDetail->admission_no}}</td>
                                                    <td>{{$student->studentDetail->first_name.' '.$student->studentDetail->last_name}}</td>
                                                    <td >{{$student->studentDetail->date_of_birth != ""? dateConvert($student->studentDetail->date_of_birth):''}}</td>
                                                    <td>{{$student->studentDetail->mobile}}</td>

                                                    @if(! moduleStatusCheck('University'))
                                                    <td>{{$student->class->class_name}}</td>
                                                    <td>{{$student->section->section_name}}</td>
                                                    <td>{{$student->studentDetail->parents != ""? $student->studentDetail->parents->fathers_name:""}}</td>
                                                    @endif

                                                    @if(userPermission("extraclass_fees_collect_student_wise"))
                                                        <td>
                                                            <a target="_blank" href="{{route('extraclass_fees_collect_student_wise', [$student->id])}}" class="primary-btn small tr-bg">
                                                                @lang('fees.collect_fees')
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </x-table>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        @endif
    </div>
</section>
@endsection
@include('backEnd.partials.data_table_js')
