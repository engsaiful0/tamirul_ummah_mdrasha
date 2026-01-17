@extends('backEnd.master')
@section('title')
    @lang('common.resource_library')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-20 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h1>@lang('common.resource_library')</h1>
                        <div class="bc-pages">
                            <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                            <a href="#">@lang('library.library')</a>
                            <a href="{{ route('library-resource') }}">@lang('common.resource_library')</a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid">
           

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                    <x-table>
                        <table class="table data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Resource Link</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
            <td>1</td>
            <td><a href="https://eduresource.com.ng/puzzle-2/" target="_blank">Puzzles</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td><a href="https://eduresource.com.ng/downloadable-worksheet/" target="_blank">Worksheets</a></td>
        </tr>
        <tr>
            <td>3</td>
            <td><a href="https://eduresource.com.ng/jigsaw-puzzle/" target="_blank">Jigsaw Puzzle</a></td>
        </tr>
        <tr>
            <td>4</td>
            <td><a href="https://eduresource.com.ng/e-lesson-note/" target="_blank">E-Lesson Notes</a></td>
        </tr>
        <tr>
            <td>5</td>
            <td><a href="https://eduresource.com.ng/educational-game/" target="_blank">Educational Games</a></td>
        </tr>
        <tr>
            <td>6</td>
            <td><a href="https://eduresource.com.ng/multimedia-textbook/" target="_blank">Multimedia Textbook</a></td>
        </tr>
                            </tbody>
                        </table>
                    </x-table>
</div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid text-center mt-20 mb-20">
        <p class="text-muted">Powered by <img src="{{ asset('public/eduresource.png') }}" alt="eduresource"></p>
    </div>
@endsection
@include('backEnd.partials.data_table_js')
