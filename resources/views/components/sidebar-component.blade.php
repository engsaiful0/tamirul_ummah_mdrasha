@php
    $school_config = schoolConfig();
    $isSchoolAdmin = Session::get('isSchoolAdmin');
    $generalSetting = generalSetting();
    $languages = systemLanguage();    
@endphp
<style>
    .sidebar #sidebar_menu li ul li a {
        color: #000;
    }
    .sidebar #sidebar_menu li ul li a:hover, .sidebar #sidebar_menu li ul li a.active {
        color: #741692;
    }
    </style>
<!-- sidebar part here -->
<nav id="sidebar" class="sidebar">

    <div class="sidebar-header update_sidebar">
        
        @if (Auth::user()->role_id != 2 && Auth::user()->role_id != 3)
            @if (userPermission('dashboard'))
                @if (moduleStatusCheck('Saas') == true &&
                    Auth::user()->is_administrator == 'yes' &&
                    Session::get('isSchoolAdmin') == false &&
                    Auth::user()->role_id == 1)
                    <a href="#" id="superadmin-dashboard">
                @elseif (moduleStatusCheck('Saas') == true &&
                    moduleStatusCheck('SaasHr') == true &&
                    Auth::user()->is_administrator == 'yes' &&
                    Session::get('isSchoolAdmin') == false)
                    <a href="#" id="superadmin-dashboard">
                @else
                    <a href="#" id="admin-dashboard">
                @endif
            @else
                <a href="{{url('/')}}" id="admin-dashboard">
            @endif
        @else
            <a href="{{ url('/') }}" id="admin-dashboard">
        @endif
        @if (!is_null($school_config->logo))
            <img src="{{ asset($school_config->logo) }}" alt="logo">
        @else
            <img src="{{ asset('public/uploads/settings/logo.png') }}" alt="logo">
        @endif
        <!-- @if (!is_null($generalSetting->logo))
            <img src="{{ asset($generalSetting->logo) }}" alt="logo123">
        @else -->
            <img src="{{ asset('public/uploads/settings/logo_old.png') }}" alt="logo345">
        <!-- @endif -->
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>

    </div>
    @if (Auth::user()->is_saas == 0)
        <ul class="sidebar_menu list-unstyled" id="sidebar_menu">
        @if (auth()->user()->is_administrator == 'yes')
            <li class="{{ request()->is('school_list') ? 'mm-active' : ''}}">
                <a href="{{ validRouteUrl('school_list') }}">
                <div class="nav_icon_small">
                    <span class="{{ $item->permissionInfo->icon ?? 'fas fa-list' }}"></span>
                </div>
                <div class="nav_title">
                    <span>School List </span>
                    
                </div>
                </a>
            </li>

            <li class="{{ request()->is('school-register') ? 'mm-active' : ''}}">
                <a href="{{ validRouteUrl('school-register') }}">
                <div class="nav_icon_small">
                    <span class="{{ $item->permissionInfo->icon ?? 'fas fa-school' }}"></span>
                </div>
                <div class="nav_title">
                    <span>New Schools </span>
                </div>
                </a>
            </li>

        @else
            
            @if (moduleStatusCheck('Saas') == true &&
                Auth::user()->is_administrator == 'yes' &&
                Session::get('isSchoolAdmin') == false &&
                Auth::user()->role_id == 1)
                @include('saas::menu.Saas')

            @elseif(moduleStatusCheck('Saas') == true &&
                Auth::user()->is_administrator == 'yes' &&
                Session::get('isSchoolAdmin') == false &&
                moduleStatusCheck('SaasHr') == true)
                @include('saas::menu.Saas')
            @else

                @if (auth()->user()->role_id != 3)

                @isset($sidebar_menus)
                        @foreach ($sidebar_menus as $sidebar_menu)
                            @if($sidebar_menu->subModule->count() > 0)
                            
                            @if ($sidebar_menu->permissionInfo->name)
                                    <span class="menu_seperator" id="seperator_{{ $sidebar_menu->permissionInfo->route }}" data-section="{{ $sidebar_menu->permissionInfo->route }}">{{ $sidebar_menu->permissionInfo->name }} </span>
                                @endif

                                @foreach($sidebar_menu->subModule as $item)

                                    @if(sidebarPermission($item->permissionInfo)==true)
                                        <li class="{{ spn_active_link(subModuleRoute($item), 'mm-active') }} {{ $sidebar_menu->permissionInfo->route }}">
                                            @if ($item->subModule->count() > 0 && $item->permissionInfo->route != 'dashboard')
                                                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                                @else
                                                    <a href="{{ validRouteUrl($item->permissionInfo->route) }}">
                                            @endif
                                            <div class="nav_icon_small">
                                                @php
                                                    $icon = $item->permissionInfo->icon ?? 'fas fa-th';
                                                @endphp
                                                <span class="{{ str_starts_with($icon, 'ti-') ? 'fas fa-th' : $icon }}"></span>

                                            </div>
                                            <div class="nav_title">
                                                <span>{{ __($item->permissionInfo->lang_name ?? $item->permissionInfo->name) }}
                                                </span>
                                                @if (config('app.app_sync') && $item->permissionInfo->module && in_array($item->permissionInfo->module, $paid_modules))
                                                    <span class="demo_addons">Addon</span>
                                                @endif
                                            </div>
                                            </a>
                                            <ul class="mm-collapse">
                                                @if (@$item->subModule)
                                                    @foreach (@$item->subModule as $key => $sub)
                                                        @if(sidebarPermission($sub->permissionInfo)==true)
                                                            @if($sub->permissionInfo->lang_name !='' && $sub->permissionInfo->lang_name != "student.delete_student_record")
                                                        <li>
                                                            <a href="{{ validRouteUrl($sub->permissionInfo->route) }}"
                                                                        class="{{ spn_active_link(subModuleRoute($sub), 'active') }}">
                                                            {{ __($sub->permissionInfo->lang_name ?? $sub->permissionInfo->name) }} </a>

                                                        </li>
                                                        @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endisset
                @endif
                @if(auth()->user()->role_id == 3)
                    @isset($sidebar_menus)
                        @foreach ($sidebar_menus as $sidebar_menu)

                            @if(sidebarPermission($sidebar_menu->permissionInfo)==true)
                                    @if($sidebar_menu->permissionInfo->lang_name)
                                    <span class="menu_seperator">{{ __($sidebar_menu->permissionInfo->lang_name) }}</span>
                                    @endif
                                    @foreach ($sidebar_menu->subModule as $item)
                                        @if(sidebarPermission($item->permissionInfo)==true)
                                            <li class="{{ spn_active_link(subModuleRoute($item), 'mm-active') }}">

                                                @if (
                                                    ($item->subModule->count() > 0 && $item->permissionInfo->route != 'dashboard') ||
                                                        $item->permissionInfo->relate_to_child == 1)
                                                    <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">

                                                    @else
                                                        <a href="{{ validRouteUrl($item->permissionInfo->route) }}">
                                                @endif
                                                <div class="nav_icon_small">
                                                    <span class="{{ $item->permissionInfo->icon ?? 'fas fa-th' }}"></span>
                                                </div>
                                                <div class="nav_title">
                                                        <span>{{ __($item->permissionInfo->lang_name ?? $item->permissionInfo->name) }}</span>
                                                        @if (config('app.app_sync') && $item->permissionInfo->module && in_array($item->permissionInfo->module, $paid_modules))
                                                        @if (config('app.app_sync'))
                                                            <span class="demo_addons">Addon</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                </a>
                                                <ul class="mm-collapse">
                                                    @if (@$item->subModule)
                                                        @foreach (@$item->subModule as $key => $sub)
                                                            @if ($sub->permissionInfo->relate_to_child == 1 && $item->permissionInfo->is_parent == 1 && sidebarPermission($sub->permissionInfo))
                                                                @foreach ($childrens as $children)

                                                                @if(! in_array($item->permissionInfo->module , ["fees_collection", "Fees"]) && (hasDueFees($children->id) )) @continue  @endif

                                                                        <li>
                                                                            <a href="{{ validRouteUrl($sub->permissionInfo->route, $children->id) }}"
                                                                                class="{{ spn_active_link(subModuleRoute($sub), 'active') }}">

                                                                                {{ __($sub->permissionInfo->lang_name) }} - {{ $children->full_name }}
                                                                            </a>
                                                                        </li>




                                                                @endforeach
                                                            @else
                                                            @if(sidebarPermission($sub->permissionInfo))

                                                                <li>
                                                                    <a href="{{ validRouteUrl($sub->permissionInfo->route) }}"
                                                                        class="{{ spn_active_link(subModuleRoute($sub), 'active') }}">
                                                                        {{ __($sub->permissionInfo->lang_name ?? $sub->permissionInfo->name) }}
                                                                    </a>

                                                                </li>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (
                                                        $item->permissionInfo->relate_to_child == 1 &&
                                                            $item->permissionInfo->is_parent == 1 &&
                                                            count($item->subModule) == 0 && sidebarPermission($item->permissionInfo))
                                                        @foreach ($childrens as $children)

                                                            @if(! in_array($item->permissionInfo->module , ["fees_collection", "Fees"]) && (hasDueFees($children->id) )) @continue  @endif
                                                                @if($item->permissionInfo->module == 'fees_collection')
                                                                    <li>
                                                                        <a href="{{ validRouteUrl($item->permissionInfo->route, $children->id) }}"
                                                                            class="{{ spn_active_link(subModuleRoute($item), 'active') }}">

                                                                            {{ 'Fees' }} -
                                                                            {{ $children->full_name }}</a>

                                                                    </li>
                                                                @elseif($item->permissionInfo->module == 'Fees')
                                                                    <li>
                                                                        <a href="{{ validRouteUrl($item->permissionInfo->route, $children->id) }}"
                                                                            class="{{ spn_active_link(subModuleRoute($item), 'active') }}">

                                                                            {{ 'Fees Invoice' }} -
                                                                            {{ $children->full_name }}</a>

                                                                    </li>
                                                                    @else
                                                                    <li>
                                                                        <a href="{{ validRouteUrl($item->permissionInfo->route, $children->id) }}"
                                                                            class="{{ spn_active_link(subModuleRoute($item), 'active') }}">

                                                                            {{ __($item->permissionInfo->lang_name) }} -
                                                                            {{ $children->full_name }}</a>

                                                                    </li>
                                                                    @endif
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                            @endif
                        @endforeach
                    @endisset
                @endif

               {{-- @if (moduleStatusCheck('CustomMenu'))
                    @if(auth()->user()->role_id  != 1)
                        @include('custom_menu::menu')
                    @endif
                @endif--}}
            @endif
        @endif
        </ul>
    @endif
</nav>
<!-- sidebar part end -->
@push('script')
    <script>
        $(document).ready(function(){
            var sections=[];
            $('.menu_seperator').each(function() { sections.push($(this).data('section')); });

            jQuery.each(sections, function(index, section) {
                if($('.'+section).length == 0) {
                    $('#seperator_'+section).addClass('d-none');
                }else{
                    $('#seperator_'+section).removeClass('d-none');
                }
            });
        })

    </script>
@endpush