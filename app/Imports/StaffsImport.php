<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\StaffImportBulkTemporary;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffsImport implements ToModel, WithStartRow, WithHeadingRow
{

    public function model(array $row)
    {

        $dob = Carbon::parse($row['date_of_birth'])->format('Y-m-d');
        $date_of_joining = Carbon::parse($row['date_of_joining'])->format('Y-m-d');

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

        // if($row['religion']=='Hindu' || $row['religion']=='Hinduism'){
        //     $religion=5;
        // }
        // if($row['religion']=='Islam' || $row['religion']=='Muslim'){
        //     $religion=4;
        // }
        // if($row['religion']=='Protestantism' || $row['religion']=='Christian'){
        //     $religion=8;
        // }
        // if($row['religion']=='Sikhism' || $row['religion']=='Sikh'){
        //     $religion=6;
        // }
        // if($row['religion']=='Buddhism' || $row['religion']=='nirvana'){
        //     $religion=7;
        // }

        //9=A+, 10=O+, 11=B+, 12=AB+, 13=A-, 14=O-, 15=B-, 16=AB-,
        //A positive
        // if($row['blood_group']=='A+' || $row['blood_group']=='A positive'){
        //     $blood_group=9;
        // }
        // if($row['blood_group']=='O+' || $row['blood_group']=='O positive'){
        //     $blood_group=10;
        // }
        // if($row['blood_group']=='B+' || $row['blood_group']=='B positive'){
        //     $blood_group=11;
        // }
        // if($row['blood_group']=='AB+' || $row['blood_group']=='AB positive'){
        //     $blood_group=12;
        // }
        // if($row['blood_group']=='A-' || $row['blood_group']=='A negative'){
        //     $blood_group=13;
        // }if($row['blood_group']=='O-' || $row['blood_group']=='O negative'){
        //     $blood_group=14;
        // }
        // if($row['blood_group']=='B-' || $row['blood_group']=='B negative'){
        //     $blood_group=15;
        // }
        // if($row['blood_group']=='AB-' || $row['blood_group']=='AB negative'){
        //     $blood_group=16;
        // }
      
        return new StaffImportBulkTemporary([
          "staff_no" => @$row['staff_no'],
          "role" => @$row['role'],
          "department" => @$row['department'],
          "designation" => @$row['designation'],
          "first_name" =>  @$row['first_name'],
          "last_name" => @$row['last_name'],
          "fathers_name" => @$row['fathers_name'],
          "mothers_name" => @$row['mothers_name'],
          "date_of_birth" => $dob,
          "date_of_joining" => $date_of_joining,
          "email" => @$row['email'],
          "gender_id" => @$gender,
          "mobile" => @$row['mobile'],
          "emergency_mobile" => @$row['emergency_mobile'],
          "marital_status" => @$row['marital_status'],
          "current_address" => @$row['current_address'],
          "permanent_address" => @$row['permanent_address'],
          "qualification" => @$row['qualification'],
          "experience" => @$row['experience'],
          "epf_no" =>  @$row['national_identification_number'],
          "basic_salary" => @$row['basic_salary'],
          "contract_type" => @$row['contract_type'],
          "location" =>  @$row['location'],
          "bank_account_name" => @$row['bank_account_name'],
          "bank_account_no" =>  @$row['bank_account_no'],
          "bank_name" => @$row['bank_name'],
          "bank_brach" => @$row['bank_brach'],
          "facebook_url" => @$row['facebook_url'],
          "twitter_url" => @$row['twitter_url'],
          "instagram_url" =>  @$row['instagram_url'],
          "driving_license" =>  @$row['driving_license'],
          "user_id"=>auth()->user()->id,
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
