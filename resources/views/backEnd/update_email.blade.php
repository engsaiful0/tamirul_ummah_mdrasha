@extends('backEnd.master')
@section('title')
    @lang('auth.profile_settings')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('auth.profile_settings') </h1>
                <div class="bc-pages">
                    <a href="#">@lang('common.dashboard')</a>
                    <a href="#">@lang('auth.profile_settings') </a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <section class="admin-visitor-area mb-40">
       <!-- Email Change -->
        <div class="row">
            <div class="col-lg-12">

                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'updateEmailStore', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <div class="row mb-25">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 mt-20 text-center">
                                    <label class="primary_input_label" for="">
                                        @lang('auth.change_email')
                                        <span class="text-danger">*</span>
                                    </label> 
                                    
                                </div>
                             </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 mt-20 text-center">
                                    <div class="primary_input">
                                        
                                        <input required class="primary_input_field form-control{{ $errors->has('new_email') ? ' is-invalid' : '' }}"
                                            type="email" value="{{ Auth::user()->email }}" name="new_email">
                                        @if ($errors->has('new_email'))
                                            <span class="text-danger" >
                                                {{ $errors->first('new_email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 mt-20 text-center">
                                        <button type="submit" class="primary-btn fix-gr-bg">
                                            <span class="ti ti-check"></span>
                                            @lang('auth.update_email')
                                        </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- End Email Change -->
    </section>
     <section class="admin-visitor-area mb-40">
        <div class="row">
        <!-- Profile Change - Start -->
            <div class="col-lg-12">

                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'updateProfilePicture', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <div class="row">
                         <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 mt-20 text-center">
                                    <label class="primary_input_label" for="">
                                         Profile Picture
                                        <span class="text-danger">*</span>
                                    </label> 
                                    
                                </div>
                             </div>
                        </div>
                        <div class="col-lg-6 text-center">
                             <img id="blahImg"
                                src="{{ @profile() && file_exists(@profile()) ? asset(profile()) : asset('public/backEnd/assets/img/avatar.png') }}"
                                alt="" style="width: 20%; height: auto;">
                            <div class="row mt-15">
                                <div class="col-lg-12">
                                    <div class="primary_input">
                                        <div class="primary_file_uploader">
                                            <input class="primary_input_field" type="text" id="profilePicture" placeholder="Upload Profile picture" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="imgInpBac">{{ __('common.browse') }}</label>
                                                <input type="file" requried class="d-none" name="image" id="imgInpBac">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('image'))
                                    <strong class="error text-danger">{{ $errors->first('image') }}
                                @endif
                            </div>
                            <div class="row mt-15">
                                <div class="col-lg-3">&nbsp;</div>
                                <div class="col-lg-6 mt-15">
                                    <button type="submit" class="primary-btn fix-gr-bg">
                                        <span class="ti ti-check"></span>
                                        Update Picture
                                    </button>
                                </div>
                                <div class="col-lg-3">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-lg-2">&nbsp;</div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- Profile Change - End -->
    </section>
@endsection
@push('script')
    <script>
        $(document).on('change', '#imgInpBac', function(event){
            getFileName($(this).val(),'#profilePicture');
            imageChangeWithFile($(this)[0],'#blahImg');
        });
    </script>
@endpush