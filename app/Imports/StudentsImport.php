<?php

namespace App\Imports;

use App\StudentBulkTemporary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        if (is_numeric($row['date_of_birth'])) {
            $dob = Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
        } else {
            $dob = Carbon::parse($row['date_of_birth'])->format('Y-m-d');
        }

        if (is_numeric($row['date_of_joining'])) {
            $admission_date = Date::excelToDateTimeObject($row['date_of_joining'])->format('Y-m-d');
        } else {
            $admission_date = Carbon::parse($row['date_of_joining'])->format('Y-m-d');
        }
       //$dob = Carbon::parse($row['date_of_birth'])->format('Y-m-d');
       //$admission_date = Carbon::parse($row['date_of_joining'])->format('Y-m-d');

        $dob = isset($dob) ? $dob : null;
        $admission_date = isset($admission_date) ? $admission_date : null;

        $gender=19;
        $religion=18;
        $blood_group=17;
        if($row['gender']=='Male' || $row['gender']=='MALE' || $row['gender']=='male'){
            $gender=1;
        }elseif($row['gender']=='Female' || $row['gender']=='FEMALE' || $row['gender']=='female'){
            $gender=2;
        }else{
            $gender=3;
        }
        // if($row['gender']=='Male' ){
        //     $gender=1;
        // }elseif($row['gender']=='Female'){
        //     $gender=2;
        // }else{
        //     $gender=3;
        // }

        if($row['religion']=='Hindu' || $row['religion']=='Hinduism'){
            $religion=5;
        }
        if($row['religion']=='Islam' || $row['religion']=='Muslim'){
            $religion=4;
        }
        if($row['religion']=='Protestantism' || $row['religion']=='Christian'){
            $religion=8;
        }
        if($row['religion']=='Sikhism' || $row['religion']=='Sikh'){
            $religion=6;
        }
        if($row['religion']=='Buddhism' || $row['religion']=='nirvana'){
            $religion=7;
        }

        //9=A+, 10=O+, 11=B+, 12=AB+, 13=A-, 14=O-, 15=B-, 16=AB-,
        //A positive
        if($row['blood_group']=='A+' || $row['blood_group']=='A positive'){
            $blood_group=9;
        }
        if($row['blood_group']=='O+' || $row['blood_group']=='O positive'){
            $blood_group=10;
        }
        if($row['blood_group']=='B+' || $row['blood_group']=='B positive'){
            $blood_group=11;
        }
        if($row['blood_group']=='AB+' || $row['blood_group']=='AB positive'){
            $blood_group=12;
        }
        if($row['blood_group']=='A-' || $row['blood_group']=='A negative'){
            $blood_group=13;
        }if($row['blood_group']=='O-' || $row['blood_group']=='O negative'){
            $blood_group=14;
        }
        if($row['blood_group']=='B-' || $row['blood_group']=='B negative'){
            $blood_group=15;
        }
        if($row['blood_group']=='AB-' || $row['blood_group']=='AB negative'){
            $blood_group=16;
        }

        return new StudentBulkTemporary([
          "emis_id" =>(string) @$row['emis_id'],
          "first_name" => @$row['name'],
          "name_in_tamil" => @$row['name_in_tamil'] ?? null,
          "father_name" => @$row['father_name'],
          "class_name" => @$row['class'],
          "section_name" => @$row['section'],

          // "father_phone" => (string) @$row['father_phone'],
           "father_occupation" => @$row['father_occupation'],
           "father_education" => @$row['father_education'],
           "mother_name" => @$row['mother_name'],
          // "mother_phone" => (string) @$row['mother_phone'],
           "mother_occupation" => @$row['mother_occupation'],
           "mother_education" => @$row['mother_education'],
           "guardian_name" => @$row['guardian_name'],
           "guardian_occupation" => @$row['guardian_occupation'],
           "national_identification_no" => @$row['national_identification_number'],
           "mobile" => @$row['phone_number'],
           "admission_number" =>(string) @$row['admission_number'],

           "date_of_birth" => @isset($dob) ? $dob : null,
           "gender" => @$gender,
           "admission_date" => @isset($admission_date) ? $admission_date : null,
           "email" => @$row['email'],
          "current_address" => @$row['address'],
          "permanent_address" => @$row['address'],
          "pin_code" => @$row['pin_code'],
          "blood_group" => @$blood_group,
          "religion" => @$religion,
          "medium_of_instruction" => @$row['medium_of_instruction'],
          
          "caste" =>(string) @$row['community'],
          "disability_group_name" =>(string) @$row['disability_group_name'],
          "group_code" =>(string) @$row['group_code'],
          "mother_tounge" =>(string) @$row['mother_tounge'],
          "medium" =>(string) @$row['medium'],
           "user_id" => Auth::user()->id
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}