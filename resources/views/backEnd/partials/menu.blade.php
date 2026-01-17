@php
    $generalSetting = generalSetting();
    $languages = systemLanguage();
    $styles = userColorThemes(auth()->user()->id);
    
@endphp

@php
    $coltroller_role = 1;
@endphp

<div class="container-fluid no-gutters" id="main-nav-for-chat">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="small_logo_crm d-lg-none">
                    <a href="#">
                    @if (!is_null($generalSetting->logo))
                        <img src="{{ asset($generalSetting->logo) }}" alt="logo">
                    @else
                        <img src="{{ asset('public/uploads/settings/logo.png') }}" alt="logo">
                    @endif
                  </a>
                </div>
                <div id="sidebarCollapse" class="sidebar_icon  d-lg-none">
                    <i class="ti ti-menu-deep"></i>
                </div>
                <div class="collaspe_icon open_miniSide">
                    <i class="ti ti-menu-deep"></i>
                </div>

                <div class="serach_field-area ml-20">
                    @if (Auth::user()->role_id != 0 && auth()->user()->is_administrator != 'yes')
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" class="form-control primary_input_field input-left-icon"
                                    placeholder="Search" id="search" onkeyup="showResult(this.value)">
                                <button type="submit" ><i class="ti ti-command"></i>
                                </button>
                            </div>
                            
                        </form>
                    </div>
                    @endif
                    <div id="livesearch" style="display: none;"></div>
                </div>
                <div class="header_middle d-none">
                    <div class="select_style d-flex">
                        @if (generalSetting()->website_btn == 1)
                            <a target="_blank" class="primary-btn white mr-10 tab_hide"
                                href="{{ url('/') }}/home">@lang('common.website')</a>
                        @endif
                        @if (generalSetting()->dashboard_btn == 1)
                            @if (Auth::user()->role_id == $coltroller_role)
                                <a class="primary-btn white mr-10 tab_hide"
                                    href="{{ route('admin-dashboard') }}">@lang('common.dashboard')</a>
                            @endif
                        @endif
                        @if (generalSetting()->report_btn == 1)
                            @if (Auth::user()->role_id == $coltroller_role)
                                <a class="primary-btn white mr-10 tab_hide"
                                    href="{{ route('student_report') }}">@lang('reports.reports')</a>
                            @endif
                        @endif
                        {{-- <div class="border_1px tab_hide"></div> --}}




                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    @if (Auth::user()->role_id != 0 && auth()->user()->is_administrator != 'yes')
                    <select name="#" class="nice_Select bgLess mb-0 infix_session" id="infix_session">
                        @foreach (academicYears() as $academic_year)
                            @if (moduleStatusCheck('University'))
                                <option value="{{ @$academic_year->id }}"
                                    {{ getAcademicId() == @$academic_year->id ? 'selected' : '' }}>
                                    {{ @$academic_year->name }} </option>
                            @else
                                <option value="{{ @$academic_year->id }}"
                                    {{ getAcademicId() == @$academic_year->id ? 'selected' : '' }}>
                                    {{ @$academic_year->year }} [{{ @$academic_year->title }}] </option>
                            @endif
                        @endforeach
                    </select>
                    @endif

                    <!-- @if (@$styles && Auth::user()->role_id == 1)
                        @if (generalSetting()->style_btn == 1)
                            <select class="nice_Select bgLess mb-0 infix_theme_style" id="infix_theme_style">
                                <option data-display="@lang('common.select_style')" value="0">@lang('common.select_style')
                                </option>
                                @foreach ($styles as $style)
                                    <option value="{{ $style->id }}"
                                        {{ color_theme()->id == $style->id ? 'selected' : '' }}>
                                        {{ $style->title }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    @endif -->
                    @if (generalSetting()->lang_btn == 1 && Auth::user()->role_id != 0 && auth()->user()->is_administrator != 'yes')
                        <select class="nice_Select bgLess mb-0 languageChange" id="languageChange">
                            <option data-display="@lang('common.select_language')" value="0">@lang('common.select_language')
                            </option>
                            @foreach ($languages as $lang)
                                <option data-display="{{ $lang->native }}" value="{{ $lang->language_universal }}"
                                    {{ $lang->language_universal == userLanguage() ? 'selected' : '' }}>
                                    {{ $lang->native }}</option>
                            @endforeach
                        </select>
                    @endif
                    <!-- <div class="header-box-menu-grid d-lg-flex">
                        <a href="https://t.me/Edsere_software" target="_blank" class="mr-0 header-box-menu"><i class="ti ti-brand-telegram"></i></a>
                    </div> -->
                    @if (Auth::user()->role_id != 0 && auth()->user()->is_administrator != 'yes')
                        <!-- <a href="/chat/open" class="mr-0 header-box-menu"><i class="ti ti-brand-hipchat"></i><span class="chat-status-dot"></span></a> -->
                    <ul class="header-box-menu-grid">
                        @if (app('general_settings')->get('chatting_method') == null || app('general_settings')->get('chatting_method') == 'log')
                            <jquery-notification-component
                                :unreads="{{ json_encode($notifications_for_chat) }}"
                                :user_id="{{ json_encode(auth()->id()) }}"
                                :redirect_url="{{ json_encode(route('chat.index')) }}"
                                :check_new_notification_url="{{ json_encode(route('chat.notification.check')) }}"
                                :asset_type="{{ json_encode(asset('/public')) }}"
                                :mark_all_as_read_url="{{ json_encode(route('chat.notification.allRead')) }}">
                            </jquery-notification-component>
                        @else
                            <notification-component
                                :unreads="{{ json_encode($notifications_for_chat) }}"
                                :user_id="{{ json_encode(auth()->id()) }}"
                                :redirect_url="{{ json_encode(route('chat.index')) }}"
                                :asset_type="{{ json_encode(asset('/public')) }}"
                                :mark_all_as_read_url="{{ json_encode(route('chat.notification.allRead')) }}">
                            </notification-component>
                        @endif
                    </ul>
                    <ul class="header_notification_warp align-items-center d-none d-lg-flex">

                        
                        {{-- Start Notification --}}
                        <li class="scroll_notification_list">
                            <a class="pulse theme_color header-box-menu show_notifications bell_notification_clicker" href="#"> 
                                <!-- bell   -->
                                <i class="ti ti-bell"></i>

                                <!--/ bell   -->
                                <!-- <span class="notificationCount notification_count">{{ count($notifications ?? []) }}</span> -->
                                <span class="notification-status-dot"></span>
                            </a>
                            <!-- Menu_NOtification_Wrap  -->
                            <div class="Menu_NOtification_Wrap notifications_wrap">
                                <div class="notification_Header">
                                    <h4>{{ __('common.no_unread_notification') }}</h4>
                                </div>
                                <div class="Notification_body">
                                    <!-- single_notify  -->
                                    @forelse ($notifications as $notification)
                                        <div class="single_notify d-flex align-items-center"
                                            id="menu_notification_show_{{ $notification->id }}">
                                            <div class="notify_thumb">
                                                <i class="fa fa-bell"></i>
                                            </div>
                                            <a href="#" class="unread_notification" title="Mark As Read"
                                                data-notification_id="{{ $notification->id }}">
                                                <div class="notify_content">
                                                    <h5>{{ date('h.i a', strtotime($notification->created_at)) }}</h5>
                                                    <p>{!! strip_tags(\Illuminate\Support\Str::limit(@$notification->message, 70, $end = '...')) !!}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <span class="text-center">{{ __('common.no_unread_notification') }}</span>
                                    @endforelse

                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        {{-- <a href=""
                                           class="primary-btn radius_30px text_white  fix-gr-bg">{{__('common.See More')}}</a>
                                        --}}
                                        <a href="{{ route('view/all/notification', Auth()->user()->id) }}"
                                            class="primary-btn radius_30px text_white  fix-gr-bg mark-all-as-read">{{ __('common.mark_all_as_read') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!--/ Menu_NOtification_Wrap  -->
                        </li>
                        {{-- End Notification --}}


                    </ul>
                    @endif                    
                    <div class="header-box-menu-grid d-lg-flex">
                        <a href="javascript:void(0);" class="mr-0 header-box-menu" id="btnFullscreen"><i class="ti ti-maximize"></i></a>
                    </div>
                    <div class="profile_info">

                        <div class="user_avatar_div">
                            <img id="profile_pic"
                                src="{{ @profile() && file_exists(@profile()) ? asset(profile()) : asset('public/backEnd/assets/img/avatar.png') }}"
                                alt="">
                        </div>

                        <div class="profile_info_iner">
                            <p> {{ Auth::user()->email }}</p>
                            <h5>{{ Auth::user()->full_name }} 
                                <!-- @if (isset(Auth::user()->wallet_balance))
                                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                        <p class="message">
                                            <strong>
                                                @lang('common.balance'):
                                                {{ Auth::user()->wallet_balance != null ? currency_format(Auth::user()->wallet_balance) : currency_format(0.0) }}
                                            </strong>
                                        </p>
                                    @endif
                                @endif -->
                            </h5>
                            <div class="profile_info_details">
                                @if (Auth::user()->is_saas == 1)
                                    <a href="{{ route('saasStaffDashboard') }}">
                                        <i class="ti ti-home"></i>

                                        @lang('common.saas_dashboard')
                                        
                                    </a>
                                @endif
                                @if (Auth::user()->role_id == '2' && Auth::user()->is_saas == 0 && auth()->user()->is_administrator != 'yes')
                                    <a href="{{ route('student-profile') }}">
                                        <i class="ti ti-user"></i>
                                        @lang('common.view_profile')
                                    </a>
                                @elseif(Auth::user()->role_id != '3' && Auth::user()->is_saas == 0 && Auth::user()->staff && auth()->user()->is_administrator != 'yes')
                                    <a href="{{ route('viewStaff', Auth::user()->staff->id) }}">
                                        <i class="ti ti-user"></i>
                                        @lang('common.view_profile')
                                    </a>
                                @endif
                                <!-- @if (auth()->user()->staff && auth()->user()->staff->parent_id && auth()->user()->role_id == 3)
                                    <a href="{{ route('viewAsRole') }}">
                                        <i class="ti ti-user"></i>
                                        @lang('common.VIEW_AS_' . strtoupper(auth()->user()->staff->previousRole->name))
                                    </a>
                                @elseif(auth()->user()->staff && auth()->user()->staff->parent_id)
                                    <a href="{{ route('viewAsParent') }}">
                                        <i class="ti ti-user"></i>
                                        @lang('common.VIEW_AS_PARENT')
                                    </a>
                                @endif -->
                                @if (moduleStatusCheck('Saas') == true &&
                                        Auth::user()->is_administrator == 'yes' &&
                                        Auth::user()->role_id == 1 &&
                                        Auth::user()->is_saas == 0)

                                    <a href="{{ route('viewAsSuperadmin') }}">
                                        <i class="ti ti-key"></i>
                                        @if (Session::get('isSchoolAdmin') == true)
                                            @lang('common.view_as_saas_admin')
                                        @else
                                            @lang('common.view_as_school_admin')
                                        @endif
                                    </a>
                                @endif
                                @if(isSignUpAllowed())
                                <a href="{{ route('updateEmail') }}">
                                    <i class="ti ti-settings"></i>
                                    @lang('auth.profile_settings')
                                </a>
                                @endif
                                <a href="{{ route('updatePassowrd') }}">
                                    <i class="ti ti-key"></i>
                                    @lang('common.password')
                                </a>
                                <a href="{{ Auth::user()->role_id == 2 ? route('student-logout') : route('logout') }}"
                                    onclick="event.preventDefault();

                                              document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout"></i>
                                    @lang('common.logout')
                                </a>

                                <form id="logout-form"
                                    action="{{ Auth::user()->role_id == 2 ? route('student-logout') : route('logout') }}"
                                    method="POST" class="d-none">

                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('script')
<script>
    function toggleFullscreen(elem) {
	elem = elem || document.documentElement;
	if (!document.fullscreenElement && !document.mozFullScreenElement &&
	  !document.webkitFullscreenElement && !document.msFullscreenElement) {
	  if (elem.requestFullscreen) {
		elem.requestFullscreen();
	  } else if (elem.msRequestFullscreen) {
		elem.msRequestFullscreen();
	  } else if (elem.mozRequestFullScreen) {
		elem.mozRequestFullScreen();
	  } else if (elem.webkitRequestFullscreen) {
		elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
	  }
	} else {
	  if (document.exitFullscreen) {
		document.exitFullscreen();
	  } else if (document.msExitFullscreen) {
		document.msExitFullscreen();
	  } else if (document.mozCancelFullScreen) {
		document.mozCancelFullScreen();
	  } else if (document.webkitExitFullscreen) {
		document.webkitExitFullscreen();
	  }
	}
  }
  
  document.getElementById('btnFullscreen').addEventListener('click', function(event) {
    event.preventDefault();
	toggleFullscreen();
  });

</script>
@endsection
