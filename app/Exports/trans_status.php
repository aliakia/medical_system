<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use DB;
use Carbon\CarbonPeriod;

class trans_status implements FromCollection , WithHeadings
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

            $_ins_approved = $_datas[$i]->instructor_approved;
            if ($_ins_approved == "1") {
                $_ins_approved = "Approved";
            } else {
                $_ins_approved = "Not yet Approved";
            }

            $_admin_approved = $_datas[$i]->admin_approved;
            if ($_admin_approved == "1") {
                $_admin_approved = "Approved";
            } else {
                $_admin_approved = "Not yet Approved";
            }
            
            $_transaction = [
                "trans_no" => $_datas[$i]->trans_no,
                "last_name" =>$_datas[$i]->last_name,
                "first_name" => $_datas[$i]->first_name,
                "middle_name" => $_datas[$i]->middle_name,
                "student_id" => $_datas[$i]->student_id,
                "instructor_approved" => $_ins_approved,
                "admin_approved" => $_admin_approved,
                "trans_date" =>  $_datas[$i]->trans_date,
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
            'First Name',
            'Middle Namne',
            'Last Name',
            'Student ID',
            'Instructor Approved',
            'Administrator Approved',
            'Transaction Date',
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
