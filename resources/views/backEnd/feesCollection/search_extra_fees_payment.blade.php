@extends('backEnd.master')
@section('title') 
@lang('fees.search_fees_payment')
@endsection
@section('mainContent')
@php  $setting = generalSetting(); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp

<section class="sms-breadcrumb mb-20 white-box">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h1>@lang('fees.search_fees_payment')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('fees.fees')</a>
                <a href="#">@lang('fees.search_fees_payment')</a>
            </div>
        </div>
    </div>
</div>
</div>
</section>


<section class="sms-breadcrumb mb-20 white-box">
    <div class="fees-btn">
        <a class="collect-fees eduction-fess" href="{{route('search_fees_payment')}}">Fees Payment</a>
        <a class="collect-fees transport-fess active" href="{{route('search_extra_fees_payment')}}">Extra Fees Payment</a>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">               
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'extra_fees_payment_search', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" id="class" name="class" value="{{@$class}}">
                        <input type="hidden" id="extra_class" name="extra_class" value="{{@$extra_class}}">
                        <input type="hidden" id="date_from" name="date_from" value="{{@$date_from}}">
                        <input type="hidden" id="date_to" name="date_to" value="{{@$date_to}}">
                        <input type="hidden" id="keyword" name="keyword" value="{{@$keyword}}">
                        <input type="hidden" id="pay_mode" name="pay_mode" value="{{@$pay_mode}}">
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                            @if(moduleStatusCheck('University'))
                            <div class="col-lg-4">
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">@lang('university::un.date_from') <span></span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input name="date_from" readonly
                                                    class="primary_input_field  primary_input_field date form-control {{ $errors->has('date_from') ? ' is-invalid' : '' }}"
                                                    type="text" autocomplete="off"
                                                    value="{{ isset($date_from) ? ($date_from != '' ? $date_from : '') : old('date_from') }}">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#startDate" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <div class="primary_input">
                                    @if ($errors->has('date_to'))
                                        <span class="text-danger invalid-select" role="alert" style="display:block">
                                            {{ $errors->first('date_to') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">@lang('university::un.date_to') <span></span> </label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input name="date_to" readonly
                                                    class="primary_input_field  primary_input_field date form-control {{ $errors->has('date_to') ? ' is-invalid' : '' }}"
                                                    type="text" autocomplete="off"
                                                    value="{{ isset($date_to) ? ($date_to != '' ? $date_to : '') : old('date_to') }}">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#startDate" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                </div>
                            </div>
                            @includeIf('university::common.session_faculty_depart_academic_semester_level',  ['hide'=>['USUB'],'required'=> ['US','UF','UD','UA','USN','US','USL'], 'dept_mt'=>'mt-25', 'ac_mt'=>'mt-25'])
                            @else
                            <div class="col-lg-4 mt-30-md">
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">@lang('fees.date_from') <span></span></label>
                                    <input name="date_from" readonly
                                           class="primary_input_field  primary_input_field date form-control {{ $errors->has('date_from') ? ' is-invalid' : '' }}"
                                           type="text" autocomplete="off"
                                           value="{{ isset($date_from) ? ($date_from != '' ? $date_from : '') : old('date_from') }}">
                                   
                                    
                                    @if ($errors->has('date_from'))
                                        <span class="text-danger"  style="display:block">
                                            {{ $errors->first('date_from') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 mt-30-lg">
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">@lang('fees.date_to') <span></span> </label>
                                    <input name="date_to" readonly
                                           class="primary_input_field  primary_input_field date form-control {{ $errors->has('date_to') ? ' is-invalid' : '' }}"
                                           type="text" autocomplete="off"
                                           value="{{ isset($date_to) ? ($date_to != '' ? $date_to : '') : old('date_to') }}">
                                   
                                    
                                    @if ($errors->has('date_to'))
                                        <span class="text-danger invalid-select" role="alert" style="display:block">
                                            {{ $errors->first('date_to') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="col-lg-4 mt-30-lg">
                                <label class="primary_input_label" for="">@lang('common.class')</label>
                                <select class="primary_select form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="" name="class">
                                    <option data-display="@lang('common.select_class')" value="">@lang('common.select_class') </option>
                                    @foreach(@$classes as $class)
                                    <option value="{{$class->id}}"  {{( old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="text-danger invalid-select" role="alert">
                                    {{ $errors->first('class') }}
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-20">
                                <label class="primary_input_label" for="">@lang('common.extra_class')</label>
                                <select class="primary_select form-control {{ $errors->has('extra_class') ? ' is-invalid' : '' }}" id="" name="extra_class">
                                    <option data-display="@lang('common.select_class')" value="">@lang('common.select_class') </option>
                                    @foreach($extra_classes as $extra_class)
                                    <option value="{{$extra_class->id}}"  {{( old("extra_class") == $extra_class->id ? "selected":"")}}>{{$extra_class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('extra_class'))
                                <span class="text-danger invalid-select" role="alert">
                                    {{ $errors->first('extra_class') }}
                                </span>
                                @endif
                            </div>
                            @endif

                            <div class="col-lg-4 mt-20">
                                <label class="primary_input_label" for="">@lang('fees.payment_mode')</label>
                                <select class="primary_select form-control {{ $errors->has('payment_mode') ? ' is-invalid' : '' }}" id="" name="payment_mode">
                                    <option data-display="@lang('fees.payment_mode')" value="">@lang('fees.payment_mode') </option>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank</option>
                                </select>
                                @if ($errors->has('payment_mode'))
                                <span class="text-danger invalid-select" role="alert">
                                    {{ $errors->first('payment_mode') }}
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-4 mt-20">
                                <label class="primary_input_label" for="">@lang('common.search_by_name')</label>
                                <div class="primary_input">
                                    <input class="primary_input_field form-control" type="text" name="keyword">
                                  
                                </div>
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
                   
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"> @lang('fees.payment_ID_Details')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <x-table>
                                <table id="table_id" class="table data-table table-type" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('fees.payment_id')</th>
                                            <th>@lang('common.date')</th>
                                            <th>@lang('common.name')</th>
                                            <th>@lang('common.extra_class')</th>
                                            <th>@lang('common.class')</th>
                                            <th>@lang('fees.mode')</th>
                                            <th>@lang('fees.amount') ({{generalSetting()->currency_symbol}}) </th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
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
@endsection

@include('backEnd.partials.date_picker_css_js')

@include('backEnd.partials.data_table_js')
@include('backEnd.partials.server_side_datatable')

{{-- delete payment modal  --}}
<div class="modal fade admin-query" id="deleteFeesPayment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fees.delete_fees_payment')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('common.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                    {{ Form::open(['route' => array('fees-payment-delete'), 'method' => 'POST']) }}
                    <input type="hidden" name="id" value="">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('common.delete')</button>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade admin-query" id="rejectPaymentModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fees.bank_payment_reject') </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                        <h4>@lang('fees.are_you_sure_to_reject')</h4>
                    </div>
              {{ Form::open(['route' => 'extra-reject-fees-payment', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <input type="hidden" name="id" id="showId">
                <input type="hidden" name="record_id" id="recordId">
                <input type="hidden" name="reject_amount" id="reject_amount">
                <input type="hidden" name="student_id" id="student_id">
                <div class="form-group">
                    
                    <label><strong>@lang('fees.reject_note')</strong></label>
                    <textarea name="payment_reject_reason" class="form-control" rows="6"></textarea>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.close')</button>
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('common.submit')</button>
                </div>
                {{ Form::close() }}

            </div>

        </div>
    </div>
</div>

@push('script')  

<script>
   $(document).ready(function() {
       $('.data-table').DataTable({
                     processing: true,
                     serverSide: true,
                     "ajax": $.fn.dataTable.pipeline( {
                           url: "{{route('ajaxExtraFeesPayment')}}",
                           data: { 
                                class: $('#class').val(),
                                extra_class: $('#extra_class').val(),
                                date_from: $('#date_from').val(),
                                date_to: $('#date_to').val(),
                                keyword: $('#keyword').val(),
                                pay_mode: $('#pay_mode').val(),
                            },
                           pages: "{{generalSetting()->ss_page_load}}" // number of pages to cache
                           
                       } ),
                       columns: [
                           {data: 'invoice', name: 'invoice'},
                           {data: 'date', name: 'date'},
                           {data: 'record_detail.student_detail.full_name', name: 'full_name'},
                           {data: 'extracurricular_class', name: 'extracurricular_class'},
                           {data: 'class_sec', name: 'class_sec'},
                           {data: 'payment_mode', name: 'payment_mode'},
                           {data: 'fees_amount', name: 'amount'},
                           {data: 'action', name: 'action', orderable: false, searchable: true},
                        ],
                        bLengthChange: false,
                bDestroy: true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: window.jsLang('quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>",
                    },
                },
                dom: "Bfrtip",
                buttons: [{
                    extend: "copyHtml5",
                    text: '<i class="fa fa-files-o"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: window.jsLang('copy_table'),
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                    {
                        extend: "excelHtml5",
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: window.jsLang('export_to_excel'),
                        title: $("#logo_title").val(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "csvHtml5",
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: window.jsLang('export_to_csv'),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "pdfHtml5",
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#logo_title").val(),
                        titleAttr: window.jsLang('export_to_pdf'),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                        orientation: "landscape",
                        pageSize: "A4",
                        margin: [0, 0, 0, 12],
                        alignment: "center",
                        header: true,
                        customize: function(doc) {
                            doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
                            doc.content.splice(1, 0, {
                                margin: [0, 0, 0, 12],
                                alignment: "center",
                                image: "data:image/png;base64," + $("#logo_img").val(),
                            });
                            doc.defaultStyle = {
                                font: 'DejaVuSans'
                            }
                        },
                    },
                    {
                        extend: "print",
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: window.jsLang('print'),
                        title: $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "colvis",
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ["colvisRestore"],
                    },
                ],
                columnDefs: [{
                    visible: false,
                }, ],
                responsive: true,
                });
            } );

    function deleteFeesPayment(id){
        var modal = $('#deleteFeesPayment');
        modal.find('input[name=id]').val(id)
        modal.modal('show');
    }

    function rejectExtraFeesPayment(id,record_id,amount,student_id){
            var amount=parseFloat(amount);
            var modal = $('#rejectPaymentModal');
            modal.find('#showId').val(id);
            modal.find('#recordId').val(record_id);
            modal.find('#reject_amount').val(amount);
            modal.find('#student_id').val(student_id);
            modal.modal('show');

    }
</script>

@endpush