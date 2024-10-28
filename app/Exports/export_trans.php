<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use DB;
use Carbon\CarbonPeriod;

class export_trans implements FromCollection , WithHeadings
{

    protected $_from,$_to,$_data;

    function __construct($_from, $_to, $_data) {
            $this->from = $_from;
            $this->to = $_to;
            $this->data = $_data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $_datas = $this->data;
        $_trans_data = array(); 
       
        for ($i=0; $i < count($_datas); $i++) { 
            $_is_uploaded = $_datas[$i]->lto_uploaded;
            if ($_is_uploaded == "1") {
                $_is_uploaded = "Uploaded";
            } else {
                $_is_uploaded = "Not Uploaded";
            }

            $_assessment = $_datas[$i]->assessment;
            if ($_assessment == "1") {
                $_assessment = "Passed";
            } else {
                $_assessment = "Failed";
            }

            $_overall_rating = $_datas[$i]->overall_rating;
            if ($_overall_rating == "1") {
                $_overall_rating = "Passed";
            } else {
                $_overall_rating = "Failed";
            }

            $_remarks = $_datas[$i]->remarks;
            if ($_remarks == null) {
                $_remarks = "-";
            } else {
                $_remarks = $_datas[$i]->remarks;
            }
            
            $_transaction = [
                "trans_no" => $_datas[$i]->trans_no,
                "lto_client_id" => $_datas[$i]->lto_client_id,
                "license_no" => $_datas[$i]->license_no,
                "last_name" =>$_datas[$i]->last_name,
                "first_name" => $_datas[$i]->first_name,
                "middle_name" => $_datas[$i]->middle_name,
                "student_id" => $_datas[$i]->student_id,
                "owner_address" => $_datas[$i]->owner_address,
                "learning_modality" => $_datas[$i]->learning_modality,
                "birthdate" => $_datas[$i]->birthdate,
                "age" => $_datas[$i]->age,
                "gender" => $_datas[$i]->gender,
                "marital_status" => $_datas[$i]->marital_status,
                "training_purpose" => $_datas[$i]->training_purpose,
                "program_description" => $_datas[$i]->program_description,
                "nationality" => $_datas[$i]->nationality,
                "date_started" => $_datas[$i]->date_started,
                "date_completed" => $_datas[$i]->date_completed,
                "total_hours" => $_datas[$i]->total_hours,
                "assessment" => $_assessment,
                "overall_rating" => $_overall_rating,
                "remarks" => $_remarks,
                "lto_uploaded" => $_is_uploaded
            ];
            array_push($_trans_data, $_transaction);
        }

        return collect($_trans_data);
    }
    public function headings(): array
    {
        return [
            'Transaction No.',
            'Client ID',
            'License No.',
            'First Name',
            'Middle Namne',
            'Last Name',
            'Student ID',
            'Address',
            'Learning Modality',
            'Birth Date',
            'Age',
            'Gender',
            'Marital Status',
            'Training Purpose',
            'Program Description',
            'Nationality',
            'Date Started',
            'Date Completed',
            'Total Hours',
            'Assessment',
            'Overall Rating',
            'Remarks',
            'Uploaded to LTO',
        ];
    }
    // public function columnFormats(): array
    // {
    //     return [
    //         'B' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    //         'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
    //     ];
    // }
}
