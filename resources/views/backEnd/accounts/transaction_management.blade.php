@extends('backEnd.master')
@section('title')
    @lang('accounts.transaction')
@endsection
@section('mainContent')
    @push('css')
        <style>
            #table_id_wrapper {
                margin-top: 50px;
            }
            
            /*table.dataTable{
                padding: 15px 30px !important;
            }

            table.dataTable thead .sorting_asc::after {
                top: 10px !important;
                left: 3px !important;
            }

            table.dataTable thead .sorting::after {
                top: 10px !important;
                left: 3px !important;
            }

            table.dataTable tbody th,
            table.dataTable tbody td {
                padding: 20px 30px 20px 30px !important;
            }

            table.dataTable tfoot th,
            table.dataTable tfoot td {
                padding: 10px 30px 6px 30px;
            }*/
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            td, th {
              border: 1px solid #ffffff;
              text-align: left;
              padding: 8px;
            }

            tr:nth-child(even) {
              background-color: #ffffff;
            }
        </style>
    @endpush
    @php
        @$setting = generalSetting();
        if (!empty(@$setting->currency_symbol)) {
            @$currency = @$setting->currency_symbol;
        } else {
            @$currency = '$';
        }
    @endphp
    <section class="sms-breadcrumb mb-20 white-box">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1>@lang('accounts.transaction')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('submenu-list',['sub_menu' =>'accounts']) }}">@lang('accounts.accounts')</a>
                    <a href="#">@lang('reports.reports')</a>
                    <a href="#">@lang('accounts.transaction')</a>
                </div>
    </div>
    </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-20">@lang('common.select_criteria') </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'account_transaction', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
                            <div class="col-lg-6 mt-30-md">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">
                                                {{ __('common.date_range') }}
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <input placeholder=""
                                                class="primary_input_field primary_input_field form-control" type="text"
                                                name="date_range" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">
                                        {{ __('accounts.payment_method') }}
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <select class="primary_select  form-control" name="payment_method" id="payment_method">
                                        <option value="">Select</option>
                                        <option data-display="@lang('common.all')" value="all">@lang('common.all')</option>
                                        @foreach ($payment_methods as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ isset($search_info) ? ($search_info['method_id'] == $value->id ? 'selected' : '') : '' }}>
                                                {{ $value->method }}</option>
                                        @endforeach
                                    </select>
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
                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('accounts.income_expense_transaction')</h3>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>@lang('common.id')</th>
                                            <th style="left: 10px;">@lang('common.date')</th>
                                            <th>@lang('common.name')</th>
                                            <th>@lang('common.type')</th>
                                            <th>@lang('accounts.income_expense_type')</th>
                                            <th>@lang('accounts.payment_method')</th>
                                            <th style="right: 10px;">@lang('accounts.amount')</th>
                                        </tr>
                                    </thead>
                                    @if (isset($incomeExpenseResults) && count($incomeExpenseResults)>0)
                                    <tbody>
                                        @php
                                            $total_income = 0;
                                            $total_expense = 0;
                                            $balance_amount = 0;
                                        @endphp
                                        @foreach ($incomeExpenseResults as $result)
                                            @php
                                                if($result->type=='Income'){
                                                    @$total_income = @$total_income + @$result->amount;
                                                }elseif($result->type=='Expense'){
                                                    @$total_expense = @$total_expense + @$result->amount;
                                                }
                                                if($total_income==''||$total_income==0){
                                                    $total_income='0.00';
                                                }
                                                if($total_expense==''||$total_expense==0){
                                                    $total_expense='0.00';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ @$result->id }}</td>
                                                <td style="left: 10px;">{{ dateConvert(@$result->date) }}</td>
                                                <td>{{ @$result->name }}</td>
                                                <td>{{ @$result->type }}</td>
                                                <td>{{ @$result->ACHead->head }}</td>
                                                <td>
                                                    {{ @$result->paymentMethod->method }}
                                                    @if (@$result->payment_method_id == 3)
                                                        ({{ @$result->account->bank_name }})
                                                    @endif
                                                </td>
                                                <td style="right: 10px;">{{ @$result->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">@lang('accounts.total_income'):</th>
                                            <th class="text-right">{{ currency_format($total_income) }}</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">@lang('accounts.total_expense'):</th>
                                            <th class="text-right">{{ currency_format($total_expense) }}</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">@lang('accounts.total_balance'):</th>
                                            @php
                                            $balance_amount = $total_income - $total_expense;
                                            //$formattedNumber = number_format((float)$balance_amount, 2, '.', '');
                                            @endphp
                                            <th class="text-right">{{ currency_format($balance_amount) }}</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">@lang('accounts.opening_balance'):</th>
                                            <th class="text-right">{{ currency_format($opening_balance) }}</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">@lang('accounts.current_balance'):</th>
                                            @php
                                            $current_balance='0.00';
                                            if ($balance_amount > 0) {
                                                $current_balance = $opening_balance + $balance_amount;
                                            }elseif($balance_amount < 0){
                                                $current_balance = $opening_balance + $balance_amount;
                                            }
                                            @endphp
                                            <th class="text-right">{{ currency_format($current_balance) }}</th>
                                        </tr>
                                    </tfoot>
                                    @else
                                    <tr>
                                        <td>
                                            @lang('common.no_data_available_in_table')
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@include('backEnd.partials.data_table_js')
@include('backEnd.partials.date_range_picker_css_js')
