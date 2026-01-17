<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmExamMarksRegister extends Model
{
    use HasFactory;

    public static function maxMarks($subject_id,$class_id,$exam_type_id)
    {
        try {
            $max_marks = SmResultStore::where('exam_type_id', $exam_type_id)
                ->where('subject_id', $subject_id)
                ->where('class_id', $class_id)
                ->max('total_marks');
            return $max_marks;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function getTopStudent($marks=0.00,$subject_id,$class_id,$exam_type_id){
    	try {

            $records = SmResultStore::where('exam_type_id', $exam_type_id)
                ->where('sm_result_stores.subject_id', $subject_id)
                ->where('sm_result_stores.class_id', $class_id)
                ->where('total_marks',$marks)
                ->join('sm_students', 'sm_students.id', '=', 'sm_result_stores.student_id')
                ->get();
            return $records;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public function studentDetail()
	{
	    return $this->belongsTo('App\SmStudent', 'student_id', 'id');
	}

	public static function getTotalMarks($subject_id,$class_id,$exam_type_id)
    {
        try {
            $total_marks = SmExam::where('exam_type_id', $exam_type_id)
                ->where('subject_id', $subject_id)
                ->where('class_id', $class_id)
                ->max('exam_mark');
            return $total_marks;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }
}
