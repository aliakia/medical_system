<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use DB;
use Carbon\CarbonPeriod;

class detailed_sales implements FromCollection , WithHeadings
{

    protected $_from;

    function __construct($_data) {
            $this->data = $_data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $_data = $this->data;
        $_all_report=array();

        $_total_gross_total = 0;
        $_total_lto_uploaded_total = 0;
        $_total_adl_code_total = 0;
        $_total_nl_code_total = 0;
        $_total_sp_code_total = 0;
        $_total_rl_code_total = 0;
        $_total_is_printed_total = 0;
        $_total_passed_total = 0;
        $_total_failed_total = 0;
        $_total_tdc_total = 0;
        $_total_pdc_total = 0;
        $_total_dep_cde_total = 0;
        $_total_dep_drc_total = 0;
        for ($i=0; $i < count($_data); $i++) {
          $_datas = [
            'trans_date' => (string)$_data[$i]->trans_date,
            'gross_total' => (string)$_data[$i]->gross_total,
            'lto_uploaded_total' => (string)$_data[$i]->lto_uploaded_total,
            'adl_code_total' => (string)$_data[$i]->adl_code_total,
            'nl_code_total' => (string)$_data[$i]->nl_code_total,
            'sp_code_total' => (string)$_data[$i]->sp_code_total,
            'rl_code_total' => (string)$_data[$i]->rl_code_total,
            'passed_total' => (string)$_data[$i]->passed_total,
            'failed_total' => (string)$_data[$i]->failed_total,
            'tdc_total' => (string)$_data[$i]->tdc_total,
            'pdc_total' => (string)$_data[$i]->pdc_total,
            'dep_cde_total' => (string)$_data[$i]->dep_cde_total,
            'dep_drc_total' => (string)$_data[$i]->dep_drc_total,
            'is_printed_total' => (string)$_data[$i]->is_printed_total
          ];
          array_push($_all_report,$_datas);
         $_total_gross_total += $_data[$i]->gross_total;
         $_total_lto_uploaded_total += $_data[$i]->lto_uploaded_total;
         $_total_adl_code_total += $_data[$i]->adl_code_total;
         $_total_nl_code_total += $_data[$i]->nl_code_total;
         $_total_sp_code_total += $_data[$i]->sp_code_total;
         $_total_rl_code_total += $_data[$i]->rl_code_total;
         $_total_is_printed_total += $_data[$i]->is_printed_total;
         $_total_passed_total += $_data[$i]->passed_total;
         $_total_failed_total += $_data[$i]->failed_total;
         $_total_tdc_total += $_data[$i]->tdc_total;
         $_total_pdc_total += $_data[$i]->pdc_total;
         $_total_dep_cde_total += $_data[$i]->dep_cde_total;
         $_total_dep_drc_total += $_data[$i]->dep_drc_total;
        }
        $_total = [
            'trans_date' => 'TOTAL',
            'total_gross_total' => (string)$_total_gross_total,
            'total_lto_uploaded_total' => (string)$_total_lto_uploaded_total,
            'total_adl_code_total' => (string)$_total_adl_code_total,
            'total_nl_code_total' => (string)$_total_nl_code_total,
            'total_sp_code_total' => (string)$_total_sp_code_total,
            'total_rl_code_total' => (string)$_total_rl_code_total,
            'total_passed_total' => (string)$_total_passed_total,
            'total_failed_total' => (string)$_total_failed_total,
            'total_tdc_total' => (string)$_total_tdc_total,
            'total_pdc_total' => (string)$_total_pdc_total,
            'total_dep_cde_total' => (string)$_total_dep_cde_total,
            'total_dep_drc_total' => (string)$_total_dep_drc_total,
            'total_is_printed_total' => (string)$_total_is_printed_total
        ];
        array_push($_all_report,$_total);

        return collect($_all_report);
    }
    public function headings(): array
    {
        return [
            'TRANS DATE',
            'GROSS TOTAL',
            'LTO UPLOADED',
            'ADL',
            'NEW LICENSE',
            'STUDENT PERMIT',
            'RENEWAL',
            'PASSED',
            'FAILED',
            'TDC',
            'PDC',
            'DEP CDE',
            'DEP DRC',
            'PRINTED'
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
