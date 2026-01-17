@extends('backEnd.master')
@section('title')
    {{ @Auth::user()->roles->name }} @lang('common.dashboard')
@endsection
@push('css')

@endpush
@section('mainContent')
<!-- Breadcrumb -->
<section class="sms-breadcrumb white-box up_breadcrumb">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                    @if (auth()->user()->role_id != 3)
                        @isset($parent_menu)
                                <h1>{{ $parent_menu }}</h1>
                                <div class="bc-pages">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                    @if($parent_route=='payroll')
                                    <a href="#">@lang('hr.human_resource')</a>
                                    @endif
                                    <a href="#">{{ $parent_menu }}</a>
                                </div>
                        @endisset
                    @endif
                </div>    
            </div>    
        </div>
    </div>
</section>
<!-- Breadcrumb -->
<!-- Dynamic Menu List -->
<section class="menu-section">
    <div class="container-fluid">
        <div class="row">
            @if (auth()->user()->role_id != 3)
                @isset($sidebar_menus)
                    @foreach ($sidebar_menus as $index => $sidebar_menu)
                        @php
                            $disable_menu_ids=array(69,70,71,75,85,92,87,191,201,220,228,464);
                        @endphp
                        @if(!in_array($sidebar_menu->permissionInfo->id,$disable_menu_ids))
                            @if(sidebarPermission($sidebar_menu->permissionInfo)==true)
                                @if ($sidebar_menu->permissionInfo->name)
                                
                                     @if (isset($sidebar_menu->permissionInfo->name) && $sidebar_menu->permissionInfo->route=='payroll' && request('sub_menu') !='payroll')
                                     <div class="col-sm-6 col-md-4 col-lg-3 mt-20">
                                     <a class="menu-list-info menu-list-purple white-box text-center mx-auto d-block" href="{{ route('submenu-list',['sub_menu' => $sidebar_menu->permissionInfo->route]) }}">
                                    <p>{{ $sidebar_menu->permissionInfo->name }} 
                                    </p><i class="fas fa-arrow-right"></i></a> 
                                    </div>
                                    @else
                                    <div class="col-sm-6 col-md-4 col-lg-3 mt-20">
                                    <a class="menu-list-info menu-list-purple white-box text-center mx-auto d-block" href="{{ validRouteUrl($sidebar_menu->permissionInfo->route) }}" class=""><p>{{ $sidebar_menu->permissionInfo->name }}</p><i class="fas fa-arrow-right"></i></a> 
                                    </div> 
                                    @endif                                 
                                 @endif
                            @endif
                        @endif
                    @endforeach
                @endisset
            @endif
        </div>   
    </div>     
</section>
<!-- Dynamic Menu List  -->
@endsection