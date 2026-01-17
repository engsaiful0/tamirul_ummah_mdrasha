@extends('backEnd.master')
@section('title') 
@lang('common.extra_class')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-20 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <h1>@lang('common.extra_class')</h1>
                    <div class="bc-pages">
                        <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                        <a href="#">@lang('academics.academics')</a>
                        <a href="#">@lang('common.extra_class')</a>
                    </div>
</div>
                </div> 
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid">
            @if(isset($classById->id))
                @if(userPermission("extra_class_store"))
                    <div class="row">
                        <div class="offset-lg-7 col-lg-5 text-right col-md-12 mb-20">
                            <a href="{{route('extra-curricular')}}" class="primary-btn small fix-gr-bg">
                                <span class="ti ti-plus pr-2"></span>
                                @lang('common.add') @lang('common.extra_class')
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
                                <h3 class="mb-20">@if(isset($classById->id))
                                        @lang('academics.edit_class')
                                    @else
                                        @lang('common.add') @lang('common.extra_class')
                                    @endif
                                   
                                </h3>
                            </div>
                            @if(isset($classById->id))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'extra_class_update', 'method' => 'POST']) }}
                            @else
                                @if(userPermission("extra_class_store"))

                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'extra_class_store', 'method' => 'POST']) }}
                                @endif
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="">@lang('common.name') <span class="text-danger"> *</span></label>
                                                <input class="primary_input_field text_numbers_only form-control{{ @$errors->has('name') ? ' is-invalid' : '' }}"
                                                       type="text" name="name" maxlength="60" autocomplete="off"
                                                       value="{{isset($classById)? @$classById->class_name: ''}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($classById)? $classById->id: ''}}">
                                               
                                                
                                                @if ($errors->has('name'))
                                                    <span class="text-danger" >
                                                       {{ @$errors->first('name') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @php
                                        $tooltip = "";
                                        if(userPermission("extra_class_store")){
                                              $tooltip = "";
                                          }else{
                                              $tooltip = "You have no permission to add";
                                          }
                                    @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip"
                                                    title="{{$tooltip}}">
                                                <span class="ti ti-check"></span>
                                                @if(isset($classById->id))
                                                    @lang('common.update')
                                                @else
                                                    @lang('academics.save')
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
                                <h3 class="mb-0">@lang('common.extra_class') @lang('common.list')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <x-table>
                                    <table id="table_id" class="table Crm_table_active3 table-type" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>@lang('common.extra_class')</th>
                                            <th>@lang('student.students')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            @endphp
                                        @foreach($classes as $class)
                                            <tr>
                                                <td valign="top">{{@$class->class_name}}
                                                    {{@$class->extra_class_id}}</td>
                                                <td>
                                                    <a href="{{route('extraclass_sorting_student_list',[$class->id])}}">{{$class->records_count}}</a>
                                                </td>
        
        
                                                <td valign="top">
                                                    @php
                                                        $routeList = [
                                                            userPermission('extra_class_edit') ?
                                                                '<a class="dropdown-item"
                                                                href="'.route('extra_class_edit', [@$class->id]).'">'.__('common.edit').'</a>' : null,
                                                            
                                                            userPermission('extra_class_delete') ? 
                                                                '<a class="dropdown-item" data-toggle="modal"
                                                                data-target="#deleteClassModal'.$class->id.'"
                                                                href="'.route('extra_class_delete', [@$class->id]).'">'.__('common.delete').'</a>' : null,
        
                                                            ];
                                                    @endphp
                                                    <x-drop-down-action-component :routeList="$routeList" />
                                                </td>
                                            </tr>
        
                                            <div class="modal fade admin-query" id="deleteClassModal{{@$class->id}}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">@lang('academics.delete_class')</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;
                                                            </button>
                                                        </div>
        
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>@lang('common.are_you_sure_to_delete')</h4>
                                                            </div>
        
                                                            <div class="mt-40 d-flex justify-content-between">
                                                                <button type="button" class="primary-btn tr-bg"
                                                                        data-dismiss="modal">@lang('common.cancel')</button>
                                                                <a href="{{route('extra_class_delete', [$class->id])}}"
                                                                class="text-light">
                                                                    <button class="primary-btn fix-gr-bg"
                                                                            type="submit">@lang('common.delete')</button>
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