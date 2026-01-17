@extends('backEnd.master')
@section('title')
    @lang('student.import_book')
@endsection
@push('css')
    <style>
        .input-right-icon button.primary-btn-small-input {
            top: 8px !important;
            right: 11px !important;
        }
    </style>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('library.import_book')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                    <a href="#">@lang('library.library')</a>
                    <a href="#">@lang('library.book_list')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-lg-6">
                    <div class="main-title">
                        <h3>@lang('common.select_criteria')</h3>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-3 text-right mb-20">
                    <a href="{{ url('/public/backEnd/bulksample/book.xlsx') }}">
                        <button class="primary-btn tr-bg text-uppercase bord-rad">
                            @lang('student.download_sample_file')
                            <span class="pl ti-download"></span>
                        </button>
                    </a>
                </div>
            </div>

            {{ Form::open([
                'class' => 'form-horizontal',
                'files' => true,
                'route' => 'book_bulk_store',
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => '',
            ]) }}
            <div class="row">
                <div class="col-lg-12">


                    <div class="white-box">
                        <div class="">
                            <div class="row" hidden="">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <div class="box-body">
                                            <br>
                                            1. @lang('student.point1')<br>
                                            2. @lang('student.point2')<br>
                                            3. @lang('student.point3')<br>
                                            4. @lang('student.point4')<br>

                                            
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
                            <div class="row mb-40 mt-30">

                                @if (moduleStatusCheck('University'))
                                    @includeIf(
                                        'university::common.session_faculty_depart_academic_semester_level',
                                        [
                                            'hide' => ['USUB'],
                                            'required' => ['US', 'UD', 'USN', 'USL', 'UA', 'USEC'],
                                        ]
                                    )
                                    <div class="col-lg-3 mt-25">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="primary_input">
                                                    <input
                                                        class="primary_input_field form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                        type="text" id="placeholderPhoto" placeholder="Excel file"
                                                        readonly>

                                                    @if ($errors->has('file'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('file') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="photo">@lang('common.browse')</label>
                                                    <input type="file" class="d-none" name="file" id="photo">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    

                                   
                                    <div class="col-lg-5">
                                       
                                        <div class="primary_input">                                           
                                            <div class="primary_file_uploader">
                                                <input
                                                        class="primary_input_field form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                        type="text" id="placeholderPhoto" placeholder="Excel file"
                                                        readonly>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="upload_content_file"><span
                                                            class="ripple rippleEffect"
                                                            style="width: 56.8125px; height: 56.8125px; top: -16.4062px; left: 10.4219px;"></span>@lang('common.browse')</label>
                                                    <input type="file" class="d-none" name="file"
                                                        id="upload_content_file">
                                                </button>
                                            </div>
                                          
                                            @if ($errors->has('file'))
                                            <span class="text-danger d-block">
                                                {{ $errors->first('file') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif


                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12 text-right">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti ti-check"></span>
                                        @lang('library.save_bulk_books')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </section>
@endsection
