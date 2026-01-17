@extends('backEnd.master')
@section('title')
@lang('exam.exam_type')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-20 white-box">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h1>@lang('exam.exam_type')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('exam.examination')</a>
                <a href="#">@lang('exam.exam_type')</a>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid">

        <div class="row">
            <div class="offset-lg-9 col-lg-3 text-right col-md-12 mb-20">
                <a href="{{route('exam')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti ti-plus pr-2"></span>
                    @lang('exam.exam_setup')
                </a>
            </div>

        </div>
        @if(isset($exam_type_edit))
         @if(userPermission('exam_type_store'))
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('exam-type')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti ti-plus pr-2"></span>
                    @lang('common.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
           

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-20">@if(isset($exam_type_edit))
                                    @lang('exam.edit_exam_type')
                                @else
                                    @lang('exam.add_exam_type')
                                @endif
                              
                            </h3>
                        </div>
                        @if(isset($exam_type_edit))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_update', 'method' => 'POST']) }}
                        @else
                         @if(userPermission('exam_type_store'))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_store', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                       
                                        <div class="primary_input">
                                            <label> @lang('exam.exam_name') <span class="text-danger"> *</span></label>
                                            <input class="primary_input_field text_numbers_only form-control{{ $errors->has('exam_type_title') ? ' is-invalid' : '' }}" type="text" name="exam_type_title" autocomplete="off" maxlength="60" value="{{isset($exam_type_edit)? $exam_type_edit->title : ''}}">
                                            <input type="hidden" name="id" value="{{isset($exam_type_edit)? $exam_type_edit->id: Request::old('exam_type_title')}}">
                                            
                                            
                                            @if ($errors->has('exam_type_title'))
                                                <span class="text-danger" >
                                                    {{ $errors->first('exam_type_title') }}
                                                </span>
                                            @endif
                                        </div>


                                    </div>
                                </div>  

                                <div class="row">
                                    <div class="col-lg-12">
                                       
                                        <div class="primary_input">
                                            <label> Exam Type <span class="text-danger"> *</span></label>
                                            <select
                                            class="primary_select form-control {{ $errors->has('name_of_examtype') ? ' is-invalid' : '' }}"
                                            id="" name="name_of_examtype">
                                            <option data-display="Exam Type *" value="">
                                            Exam Type
                                                *</option>
                                            <option value="1" {{ isset($exam_type_edit)?($exam_type_edit->name_of_the_type == 1?'selected':''):''}}>Daily</option>
                                            <option value="2" {{ isset($exam_type_edit)?($exam_type_edit->name_of_the_type == 2?'selected':''):''}}>Monthly</option>
                                            <option value="3" {{ isset($exam_type_edit)?($exam_type_edit->name_of_the_type == 3?'selected':''):''}}>Weekly</option>
                                            <option value="4" {{ isset($exam_type_edit)?($exam_type_edit->name_of_the_type == 4?'selected':''):''}}>Cycle</option>
                                            <option value="5" {{ isset($exam_type_edit)?($exam_type_edit->name_of_the_type == 5?'selected':''):''}}>Term</option>
                                            </select>
                                            
                                            
                                            @if ($errors->has('name_of_examtype'))
                                                <span class="text-danger" >
                                                    {{ $errors->first('name_of_examtype') }}
                                                </span>
                                            @endif
                                        </div>


                                    </div>
                                </div>  


	                            @php 
                                  $tooltip = "";
                                  if(userPermission('exam_type_store') || userPermission('exam_type_edit')){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{@$tooltip}}">
                                            <span class="ti ti-check"></span>
                                            @if(isset($exam_type_edit))
                                                @lang('exam.update_exam_type')
                                            @else
                                                @lang('exam.save_exam_type')
                                            @endif
                                           

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0 ">@lang('exam.exam_type_list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <x-table>
                        <table id="table_id" class="table table-type" cellspacing="0" width="100%">
                            <thead>
                              
                                <tr>
                                    <th>@lang('common.sl')</th>
                                    <th>@lang('exam.exam_name')</th>
                                    {{-- <th>@lang('common.status')</th> --}}
                                    <th>@lang('common.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=0; @endphp
                                @foreach($exams_types as $exams_type)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ @$exams_type->title}}</td>
                                    <td class="d-flex">
                                        <x-drop-down>

                                                        @if(userPermission('exam_type_edit'))

                                                        <a class="dropdown-item" href="{{route('exam_type_edit', [$exams_type->id])}}">@lang('common.edit')</a>
                                                        @endif
                                                        @if(userPermission('exam_type_delete'))

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal{{@$exams_type->id}}"  href="#">@lang('common.delete')</a>
                                                   @endif
                                                    </div>
                                                </div>
                                                 <a style="margin-left: 10px !important" class="primary-btn small tr-bg" href="{{route('exam-marks-setup',$exams_type->id)}}">
                                                    <span class="pl ti-settings"></span> @lang('exam.exam_setup')
                                                </a>
                                            </x-drop-down>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal{{@$exams_type->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('exam.delete_exam_type')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('common.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                    <a href="{{route('exam_type_delete', [@$exams_type->id])}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('common.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </x-table>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('script')
<script>
    $('.text_numbers_only').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z0-9  _]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
</script>
@endsection
@endsection
@include('backEnd.partials.data_table_js')