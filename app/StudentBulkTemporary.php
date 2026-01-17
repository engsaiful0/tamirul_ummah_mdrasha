<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentBulkTemporary extends Model
{
    protected $fillable  = ['admission_number', 'roll_no', 'first_name', 'last_name', 'date_of_birth', 'religion', 'gender', 'caste', 'mobile', 'email', 'admission_date', 'blood_group', 'height', 'weight', 'father_name', 'father_phone', 'father_occupation', 'mother_name', 'mother_phone', 'mother_occupation', 'guardian_name', 'guardian_relation', 'guardian_email', 'guardian_phone', 'guardian_occupation', 'guardian_address', 'current_address', 'permanent_address', 'bank_account_no', 'bank_name', 'national_identification_no', 'local_identification_no', 'previous_school_details', 'note', 'user_id','bmi_date','bmi_height','bmi_weight','vision_date','vision_left','vision_right','medical_date','medical_name','medical_comment','clinical_date','clinical_name','clinical_comment','chest_date','chest_size','dental_date','dental_hygiene','allergies_date','allergies_name','allergies_comment','health_issue_date','health_issue_type','health_issue_comment','health_issue_doctor','immunization_date','immunization_name','immunization_type','immunization_comment','name_in_tamil','emis_id','pin_code','medium_of_instruction','disability_group_name','group_code','medium','mother_tounge','section_name','class_name'];
}
