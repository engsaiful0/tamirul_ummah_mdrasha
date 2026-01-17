<?php

namespace App\Http\Controllers\Admin\Academics;

use App\SmExtraCurricularClass;
use App\tableList;
use App\YearCheck;
use App\ApiBaseMethod;
use App\SmClass;
use App\SmExtraCurricularFeesSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Academics\ExtraCurricularClassRequest;

class SmExtraClassController extends Controller
{
    public $date;

    public function __construct()
	{
        $this->middleware('PM');

	}


    public function index(Request $request)
    {
        try {
            $classes = SmExtraCurricularClass::withCount('records')->get();
            return view('backEnd.academics.extra_curricular_class', compact('classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(ExtraCurricularClassRequest $request)
    {
       // DB::beginTransaction();
        try {
            $class = new SmExtraCurricularClass();
            $class->class_name = $request->name;
            $class->created_at = YearCheck::getYear() . '-' . date('m-d h:i:s');
            $class->created_by=auth()->user()->id;
            $class->school_id = Auth::user()->school_id;
            $class->academic_id = getAcademicId();
            $class->save();
            $class->toArray();    
            $extra_class_id=$class->id;

            $classes = SmClass::get();
            foreach($classes as $class){
                $extra_curricular_fees_assigns = SmExtraCurricularFeesSettings::where('class_id', $class->id)
                ->where('extra_class_id', $extra_class_id)
                ->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->first();
                if(!$extra_curricular_fees_assigns){
                    $extra_curricular_fees_assigns = new SmExtraCurricularFeesSettings();
                    
                    $extra_curricular_fees_assigns->class_id = $class->id;
                    $extra_curricular_fees_assigns->extra_class_id = $extra_class_id;
                    $extra_curricular_fees_assigns->school_id = Auth::user()->school_id;
                    $extra_curricular_fees_assigns->academic_id = getAcademicId();
                    $extra_curricular_fees_assigns->save();                  
                }

            }
            // DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
       
        } catch (\Exception $e) {
           // DB::rollBack();                
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $classById = SmExtraCurricularClass::find($id);
            $classes = SmExtraCurricularClass::where('active_status', '=', 1)->orderBy('id', 'desc')
            ->where('academic_id', getAcademicId())
            ->where('school_id', Auth::user()->school_id)
            ->get();
            return view('backEnd.academics.extra_curricular_class', compact('classById', 'classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(ExtraCurricularClassRequest $request)
    {
        DB::beginTransaction();

        try {
            $class = SmExtraCurricularClass::find($request->id);
            $class->class_name = $request->name;
            $class->save();
            $class->toArray();
            try {
                DB::commit();
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Class has been updated successfully');
                }
                Toastr::success('Operation successful', 'Success');
                return redirect('extra-curricular');
            } catch (\Exception $e) {
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        try {
            $tables = tableList::getTableList('extra_class_id', $id);
            if($tables == null || $tables == "Class sections, ") {
                DB::beginTransaction();
                $extraClass = SmExtraCurricularClass::destroy($id);
                DB::commit();
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($extraClass) {
                        return ApiBaseMethod::sendResponse(null, 'Class has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                }  
                
                Toastr::success('Operation successful', 'Success');
                return redirect('extra-curricular');

            } else{
                DB::rollback();
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}