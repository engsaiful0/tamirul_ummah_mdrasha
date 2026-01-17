<?php

namespace App\Http\Controllers\Admin\Transport;

use App\SmRoute;
use App\SmAcademicYear;
use App\RouteBulkTemporary;
use App\Imports\RouteImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Transport\SmRouteRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class SmRouteController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
	}

    public function index(Request $request)
    {
        try {
            $routes = SmRoute::get();
            return view('backEnd.transport.route', compact('routes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(SmRouteRequest $request)
    {
        try {
            $route = new SmRoute();
            $route->title = $request->title;
            $route->far = $request->far;
            $route->school_id = Auth::user()->school_id;
            if(moduleStatusCheck('University')){
                $route->un_academic_id = getAcademicId();
            }else{
                $route->academic_id = getAcademicId();
            }
            $route->save();

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $route = SmRoute::find($id);
            $routes = SmRoute::where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.transport.route', compact('route', 'routes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(SmRouteRequest $request, $id)
    {
        try {
            $route = SmRoute::find($request->id);            
            $route->title = $request->title;
            $route->far = $request->far;
            if(moduleStatusCheck('University')){
                $route->un_academic_id = getAcademicId();
            }
            $route->save();

            Toastr::success('Operation successful', 'Success');
            return redirect('transport-route');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $tables = \App\tableList::getTableList('route_id', $id);
            try {
                if ($tables == null) {
                    SmRoute::destroy($id);

                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            } catch (\Illuminate\Database\QueryException $e) {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            } catch (\Exception $e) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function importRoute()
    {
        try {
            return view('backEnd.transport.import_route');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function routeBulkStore(Request $request)
    {

        $request->validate(
            [
                'file' => 'required'
            ],
        );

        $file_type = strtolower($request->file->getClientOriginalExtension());
        if ($file_type <> 'csv' && $file_type <> 'xlsx' && $file_type <> 'xls') {
            Toastr::warning('The file must be a file of type: xlsx, csv or xls', 'Warning');
            return redirect()->back();
        } else {
            try {

                DB::beginTransaction();
                $path = $request->file('file');
                Excel::import(new RouteImport, $request->file('file'), 's3', \Maatwebsite\Excel\Excel::XLSX);
                            

                $data = RouteBulkTemporary::all();
                
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $existingRoute = SmRoute::where('title', $value->route_name)->where('school_id', auth()->user()->school_id)->where(function ($query) {
                                if (moduleStatusCheck('University')) {
                                    $query->where('un_academic_id', getAcademicId());
                                } else {
                                    $query->where('academic_id', getAcademicId());
                                }
                            })->first();

                        if (!$existingRoute) {
                            $routes = new SmRoute();
                            $routes->title = $value->route_name;
                            $routes->far = $value->fare;
                            $routes->created_by = auth()->user()->id;
                            $routes->school_id = auth()->user()->school_id;
                            if (moduleStatusCheck('University')) {
                                $routes->un_academic_id = getAcademicId();
                            } else {
                                $routes->academic_id = getAcademicId();
                            }
                            $routes->save();
                        }
                    }

                    //RouteBulkTemporary::truncate();

                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                Toastr::error($e->getMessage());
                //Toastr::error('Operation Failed TEST2', 'Failed');
                return redirect()->back();
            }
        }
    }

}