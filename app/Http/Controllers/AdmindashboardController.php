<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DecryptException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Exception;
// use PDF;
use Excel;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmindashboardController extends Controller
{

    public function select_active_year($_clinicId, Request $_request)
    {
      $year = $_request->select_year;
      $_request->session()->put('active_year', $year);
      return response()->json([
        'status' => 1
      ]);
    }
    public function select_date(Request $_request)
    {
        $_date = DB::select("SELECT now();");
        $date_now = date('Y-m-d', strtotime($_date[0]->now));

      $select_date =  $_request->select_date;
      $_request->session()->put('select_date', $select_date);
     //dd($select_date);
      return response()->json([
        'status' => 1
      ]);
    }
    public function getYearlyTransactions($_clinicId, Request $_request){
        //$year =  $_request->select_year;

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $year = Session('active_year');

        $select_date = explode(' to ', Session('select_date'));
        $_date = DB::select("SELECT now();");
        $date_now = date('Y-m-d', strtotime($_date[0]->now));

        $_newDateTime = date_format(date_create($_date[0]->now), "Y");
        $years = range(date('Y', strtotime($_newDateTime)), 1998);

            if($year == null || $year == ''){
                $_date_from = date('Y-m-d', strtotime($_newDateTime.'-01-01'));
                $_date_to = date('Y-m-d', strtotime($_newDateTime.'-12-31'));
            }else{
                $_date_from = date('Y-m-d', strtotime($year.'-01-01'));
                $_date_to = date('Y-m-d', strtotime($year.'-12-31'));
            }


            if($select_date[0] == null || $select_date[0] == ""){
                $_transaction_date_from = $date_now;
                $_transaction_date_to = $date_now;
            }
            else{
                $_transaction_date_from = $select_date[0];
                $_transaction_date_to = $select_date[1];
            }

            $jan = 0; $feb = 0; $mar = 0; $apr = 0; $may = 0; $jun = 0; $jul = 0; $aug = 0; $sep = 0; $oct = 0; $nov = 0; $dec = 0;
            $_dataSet = ([$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec]);

                $client_total_uploaded_transaction_data = DB::table('tb_clinic_tests')
                ->select('trans_no',
                        'date_exam',
                        'date_uploaded')
                ->where('clinic_id', $_clinic_id)
                ->where('clinic_name', $_clinic_name)
                ->whereDate('application_date', '>=', date("Y-m-d", strtotime($_transaction_date_from)))
                ->whereDate('application_date', '<=', date("Y-m-d", strtotime($_transaction_date_to)));

                $client_total_uploaded = $client_total_uploaded_transaction_data->count();

                $client_total_pending_transaction_data = DB::table('tb_clinic_tests_scratch')
                ->select('trans_no',
                        'date_exam',
                        'date_uploaded')
                ->where('clinic_id', '=', $_clinic_id)
                ->where('clinic_name','=', $_clinic_name)
                ->where('is_lto_sent','=', 0)
                ->whereDate('application_date', '>=', date("Y-m-d", strtotime($_transaction_date_from)))
                ->whereDate('application_date', '<=', date("Y-m-d", strtotime($_transaction_date_to)))
                ->get();
                $client_total_pending = $client_total_pending_transaction_data->count();

                $client_transaction_data = DB::table('tb_clinic_tests_scratch')
                            ->select('trans_no',
                                    'date_exam',
                                    'date_uploaded')
                            ->where('clinic_id', $_clinic_id)
                            ->where('clinic_name', $_clinic_name)
                            ->whereDate('date_exam', '>=', date("Y-m-d", strtotime($_date_from)))
                            ->whereDate('date_exam', '<=', date("Y-m-d", strtotime($_date_to)));

                $clients_data = $client_transaction_data->get();

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                $tb_clinic_balance = DB::table('tb_clinic_balance')
                ->where('clinic_id', $_clinic_id)
                ->select(
                  'transmission_fee',
                  'balance',
                  'account_type',
                  'max_credit')
                ->get();

                if($_selectLoginCredential->count() > 0){

                    try {
                        $_selectClinicDetails = DB::table('tb_clinics')
                                ->select('clinic_id',
                                        'clinic_name',
                                        'address_full'
                                         )
                                ->where('clinic_id',  $_clinicId)
                                ->where('is_active', 1)
                                ->get();

                        $pageConfigs = [
                            'bodyClass' => "bg-full-screen-image",
                            'blankPage' => true
                        ];

                        if($_selectClinicDetails->count() > 0){

                            if($clients_data->count() > 0){
                                for ($i=0; $i < count($clients_data); $i++) {
                                    $date[] = date('F', strtotime($clients_data[$i]->date_exam));
                                }
                                foreach ($date as $key => $value) {
                                    if ($value == "January") {
                                        $jan += 1;
                                    }
                                    if ($value == "February") {
                                        $feb += 1;
                                    }
                                    if ($value == "March") {
                                        $mar += 1;
                                    }
                                    if ($value == "April") {
                                        $apr += 1;
                                    }
                                    if ($value == "May") {
                                        $may += 1;
                                    }
                                    if ($value == "June") {
                                        $jun += 1;
                                    }
                                    if ($value == "July") {
                                        $jul += 1;
                                    }
                                    if ($value == "August") {
                                        $aug += 1;
                                    }
                                    if ($value == "September") {
                                        $sep += 1;
                                    }
                                    if ($value == "October") {
                                        $oct += 1;
                                    }
                                    if ($value == "November") {
                                        $nov += 1;
                                    }
                                    if ($value == "December") {
                                        $dec += 1;
                                    }
                                }
                                $_dataSet = ([$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec]);

                                // $_saveLogs = Func::saveUserLogs($_request->user_id, "YEARLY TRANSACTIONS", "GET YEARLY TRANSACTIONS", "-", "-", $_newDateTime, $_request->ds_code);
                                    $pageConfigs = ['pageHeader' => true];
                                    return view('admin_page', [
                                        'status' => "1",
                                        'pageConfigs' => $pageConfigs,
                                        'message' => "Transactions record found",
                                        'yearly_trans' => json_encode($_dataSet),
                                        'yearly_total' => array_sum($_dataSet),
                                        'uploaded_transaction_total' =>$client_total_uploaded,
                                        'pending_transaction_total' => $client_total_pending,
                                        'years' => $years,
                                        'current_year' => $_newDateTime,
                                        'balance' =>  $tb_clinic_balance
                                    ]);
                            }
                            else
                            {
                                $pageConfigs = ['pageHeader' => true];
                                return view('admin_page', [
                                    'status' => "0",
                                    'pageConfigs' => $pageConfigs,
                                    'message' => "No transactions record found",
                                    'yearly_trans' => json_encode($_dataSet),
                                    'yearly_total' => array_sum($_dataSet),
                                    'uploaded_transaction_total' =>$client_total_uploaded,
                                    'pending_transaction_total' => $client_total_pending,
                                    'years' => $years,
                                    'transaction_date_from' => $_transaction_date_from,
                                    'transaction_date_to' => $_transaction_date_to,
                                    'balance' =>  $tb_clinic_balance,
                                    ]);
                            }
                        }else {
                            return view('content/miscellaneous/error', [
                                'pageConfigs' => $pageConfigs
                            ])->with('fail',"Clinic Id not found");
                        }

                    } catch (\Exception $e) {
                        return view('content/miscellaneous/error', [
                            'pageConfigs' => $pageConfigs
                        ])->with('fail', $e->getMessage());
                    }

                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }




        // }
    }
    public function fetch_admin_user_data($_clinicId, Request $_request){
        $_clinic_id = Session('data_clinic')->clinic_id;
        $users_data = DB::table('tb_users')
                        ->select('user_id',
                                'user_type',
                                'full_name',
                                'is_active')
                        ->where('clinic_id', '=', $_clinic_id)
                        ->where('is_active', '=', 1)
                        ->get();
        return response()->json([
            'data' => $users_data
            ]);
    }

    public function admin_users_management($_clinicId, Request $_request){
        $_clinic_id = Session('data_clinic')->clinic_id;
        $getUsers = "";
        $getUsers = DB::table('tb_users')
                        ->select('user_id',
                                'user_type',
                                'full_name',
                                'is_active')
                        ->where('clinic_id', '=', $_clinic_id)
                        ->where('is_active', '=', 1)
                        ->get();

        $pageHeader = ['pageHeader' => true];

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){

                    if($getUsers->count() > 0){
                        return view('add_user', [
                            'status' => "1",
                            'pageConfigs' => $pageHeader,
                            'data' => $getUsers
                          ]);
                    }
                    else{
                        return view('admin_page', [
                            'status' => "0",
                            'message' => "no record found",
                        ]);
                    }

                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }


    }
    public function admin_add_user($_clinicId, Request $_request){

        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $_admin_name = Session('UserLoggedInfo')->full_name;

        $_user_id = $_request->user_id;
        $_password = $_request->password;
        $_repeat_password = $_request->confirm_password;
        $_user_type = $_request->user_type;

        $_request->validate([
            'base_64' => 'required',
            // 'fp_idr1' => 'required',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'user_type' => 'required|string',
            'user_expiration' => 'required',
            'user_id' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|string'
          ]);

                //validate password & repeat password string
                if($_password != $_repeat_password){
                    return response()->json([
                        'status' => "0",
                        'message' =>  "Password and Repeat password didn't matched. Please type again."
                      ]);
                }
                else{
                    //validate if primary key already exist
                    $getUserId = DB::table('tb_users')
                    ->select('user_id')
                    ->where('user_id', '=', $_user_id)
                    ->where('clinic_id', '=', $_clinic_id);

                    $data = $getUserId->get();

                    if($data->count() > 0)
                    {
                        //return failed, account code already exist
                        return response()->json([
                            'status' => "0",
                            'message' =>  "User ID already exist in ".$_clinic_id
                          ]);
                    }
                    else{
                        $param = [
                            'user_id' => $_request->user_id,
                            'password' => hash("sha512", $_password),
                            'first_name' => $_request->first_name,
                            'middle_name' => $_request->middle_name,
                            'last_name' => $_request->last_name,
                            'full_name' => $_request->first_name ." ". $_request->middle_name ." ". $_request->last_name,
                            'gender' => $_request->gender,
                            'clinic_id' => $_clinic_id,
                            'is_active' => 1,
                            'user_type' => $_request->user_type,
                            'expiration' => $_request->user_expiration,
                            'pic1' => $_request->base_64
                        ];

                        $param2 = [
                            'physician_id' => $_request->physician_id,
                            'clinic_id' => $_clinic_id,
                            'full_name' => $_request->first_name ." ". $_request->middle_name ." ". $_request->last_name,
                            'first_name' => $_request->first_name,
                            'middle_name' => $_request->middle_name,
                            'last_name' => $_request->last_name,
                            'birthday' => $_request->bday,
                            'gender' => $_request->gender,
                            'civil_status' => $_request->civil_status,
                            'prc_no' => $_request->prc_no,
                            'ptr_no' => $_request->ptr_no,
                            'email_address' => $_request->email_address,
                            'contact_no' => $_request->contact_no,
                            'pic1' => $_request->base_64,
                            'date_created' => $_newDateTime,
                            'date_created_by' => $_admin_name,
                            'is_active' => 1,
                            'prc_expiration' => $_request->prc_expiration,
                            'user_id' => $_request->user_id,
                            'password' => hash("sha512", $_password)
                        ];

                        try {
                            DB::beginTransaction();
                            $_insertToUsers = DB::table('tb_users')
                                            ->insert($param);

                            if($_insertToUsers == '' || $_insertToUsers == null){
                                DB::rollBack();
                                return response()->json([
                                    'status' => "0",
                                    'message' => "There was a problem in saving new user."
                                  ]);
                            }
                            else{
                                DB::commit();
                                if($_user_type == "Encoder"){
                                    DB::beginTransaction();
                                    $_insertToPhysician = DB::table('tb_physicians')
                                                         ->insert($param2);

                                    if($_insertToPhysician == '' || $_insertToPhysician == null){
                                        DB::rollBack();
                                        return response()->json([
                                            'status' => "0",
                                            'message' => "There was a problem in saving new user."
                                            ]);
                                    }
                                    else{
                                        DB::commit();
                                        return response()->json([
                                            'status' => "1",
                                            'message' => "New Encoder saving successful",
                                          ]);
                                    }

                                }
                                else{
                                    return response()->json([
                                        'status' => "1",
                                        'message' => "New User saving successful",
                                      ]);
                                }
                            }
                        } catch (\Throwable $th) {
                            return response()->json([
                                'status' => "0",
                                'message' => $th->getMessage()
                              ]);
                        }
                    }
                }

    }
    public function admin_select_user($_clinicId, Request $_request){
        $_clinic_id = Session('data_clinic')->clinic_id;
        $_request->validate([
            'user_id' => 'required',
          ]);
        $_target_user_id = $_request->user_id;

        $get_user_data = DB::table('tb_users')
                    ->select(
                    'user_id',
                    'password',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'full_name',
                    'gender',
                    'clinic_id',
                    'is_active',
                    'user_type',
                    'expiration',
                    DB::raw("encode(pic1, 'escape') as pic1"))
                    ->where('clinic_id', '=', $_clinic_id)
                    ->where('user_id', '=', $_target_user_id)
                    ->get();

        if($get_user_data->count() > 0){
          if($get_user_data[0]->user_type == 'Encoder'){
                $get_physician_data = DB::table('tb_physicians')
                ->select(
                    'user_id',
                    'physician_id',
                    'clinic_id',
                    'full_name',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'civil_status',
                    'birthday',
                    'prc_no',
                    'ptr_no',
                    'contact_no',
                    'email_address',
                    'digital_signature',
                    'is_active',
                    'fp_id_r1',
                    'fp_id_r2',
                    'fp_id_r3',
                    'fp_id_r4',
                    'fp_id_r5',
                    'fp_id_l1',
                    'fp_id_l2',
                    'fp_id_l3',
                    'fp_id_l4',
                    'fp_id_l5',
                    'prc_expiration',
                    'password',
                    DB::raw("encode(pic1, 'escape') as pic1"))
                ->where('clinic_id', '=', $_clinic_id)
                ->where('user_id', '=', $_target_user_id)
                ->get();
                if($get_physician_data == '' || $get_physician_data == null){
                    return response()->json([
                        'status' => "0",
                        'message' =>  "Retrieve Physician Data Failed",
                      ]);
                }
                else{
                    return response()->json([
                        'status' => "1",
                        'message' =>  "Retrieve Data Success",
                        'data' => $get_user_data,
                        'data2' => $get_physician_data
                      ]);
                }
          }
          else{
            return response()->json([
                'status' => "1",
                'message' =>  "Retrieve User Data Success",
                'data' => $get_user_data
              ]);
          }
        }
        else{
            return response()->json([
                'status' => "0",
                'message' =>  "Retrieve User Data Failed",
              ]);
        }
    }
    public function admin_edit_user($_clinicId, Request $_request){
        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $_admin_name = Session('UserLoggedInfo')->full_name;

        $_user_id = $_request->user_id_edit;
        $_user_type = $_request->user_type_edit;

        $_request->validate([
            'base_64_edit' => 'required',
            // 'fp_idr1' => 'required',
            'first_name_edit' => 'required|string',
            'middle_name_edit' => 'required|string',
            'last_name_edit' => 'required|string',
            'gender_edit' => 'required|string',
            'user_type_edit' => 'required|string',
            'user_expiration_edit' => 'required',
            'user_id_edit' => 'required|string'
          ]);

             $param = [
                 'user_id' => $_request->user_id_edit,
                 'first_name' => $_request->first_name_edit,
                 'middle_name' => $_request->middle_name_edit,
                 'last_name' => $_request->last_name_edit,
                 'full_name' => $_request->first_name_edit ." ". $_request->middle_name_edit ." ". $_request->last_name_edit,
                 'gender' => $_request->gender_edit,
                 'clinic_id' => $_clinic_id,
                 'user_type' => $_request->user_type_edit,
                 'expiration' => $_request->user_expiration_edit,
                 'pic1' => $_request->base_64_edit
             ];

             $param2 = [
                 'physician_id' => $_request->physician_id_edit,
                 'clinic_id' => $_clinic_id,
                 'full_name' => $_request->first_name_edit ." ". $_request->middle_name_edit ." ". $_request->last_name_edit,
                 'first_name' => $_request->first_name_edit,
                 'middle_name' => $_request->middle_name_edit,
                 'last_name' => $_request->last_name_edit,
                 'birthday' => $_request->bday_edit,
                 'gender' => $_request->gender_edit,
                 'civil_status' => $_request->civil_status_edit,
                 'prc_no' => $_request->prc_no_edit,
                 'ptr_no' => $_request->ptr_no_edit,
                 'email_address' => $_request->email_address_edit,
                 'contact_no' => $_request->contact_no_edit,
                 'pic1' => $_request->base_64_edit,
                 'date_created' => $_newDateTime,
                 'date_created_by' => $_admin_name,
                 'prc_expiration' => $_request->prc_expiration_edit,
                 'user_id' => $_request->user_id_edit,
             ];

             try {
                 DB::beginTransaction();
                 $_updatetToUsers = DB::table('tb_users')
                                    ->where('clinic_id', $_clinic_id)
                                    ->where('user_id', $_user_id)
                                    ->update($param);

                 if($_updatetToUsers == '' || $_updatetToUsers == null){
                     DB::rollBack();
                     return response()->json([
                         'status' => "0",
                         'message' => "There was a problem in updating user."
                       ]);
                 }
                 else{
                     DB::commit();
                     if($_user_type == "Encoder"){
                         DB::beginTransaction();
                         $_updateToPhysician = DB::table('tb_physicians')
                                                ->where('clinic_id', $_clinic_id)
                                                ->where('user_id', $_user_id)
                                                ->update($param2);

                         if($_updateToPhysician == '' || $_updateToPhysician == null){
                             DB::rollBack();
                             return response()->json([
                                 'status' => "0",
                                 'message' => "There was a problem in updating user."
                                 ]);
                         }
                         else{
                             DB::commit();
                             return response()->json([
                                 'status' => "1",
                                 'message' => "Updating User info successful",
                               ]);
                         }

                     }
                     else{
                         return response()->json([
                             'status' => "1",
                             'message' => "Updating User info successful",
                           ]);
                     }
                 }
             } catch (\Throwable $th) {
                 return response()->json([
                     'status' => "0",
                     'message' => $th->getMessage()
                   ]);
             }


    }
    public function admin_preview_upload_user($_clinicId, $trans_no,Request $_request){
        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;
        $_transaction_number = $_request->trans_no;
        try {
            $_get_tb_Scratch = DB::table('tb_clinic_tests_scratch')
                            ->where('trans_no', $_transaction_number)
                            ->where('clinic_id', $_clinic_id)
                            ->where('clinic_name', $_clinic_name)
                            ->select(
                              'trans_no',
                              'first_name',
                              'middle_name',
                              'last_name',
                              'address_full',
                              'birthday',
                              'gender',
                              'nationality',
                              'occupation',
                              'civil_status',
                              'license_type',
                              'new_renew',
                              'license_no',
                              'purpose',
                              'pt_height',
                              'pt_weight',
                              'pt_pulse_rate',
                              'pt_body_temperature',
                              'pt_respiratory_rate',
                              'pt_blood_pressure',
                              'blood_type',
                              'pt_general_physique',
                              'pt_contagious_disease',
                              'pt_ue_normal_left',
                              'pt_ue_normal_right',
                              'pt_le_normal_left',
                              'pt_le_normal_right',
                              'pt_eye_color',
                              'vt_snellen_bailey_lovie_left',
                              'vt_snellen_bailey_lovie_right',
                              'vt_snellen_with_correct_right',
                              'vt_snellen_with_correct_left',
                              'vt_color_blind_left',
                              'vt_color_blind_right',
                              'vt_glare_contrast_sensitivity_function_without_lenses_right',
                              'vt_glare_contrast_sensitivity_function_without_lenses_left',
                              'vt_glare_contrast_sensitivity_function_with_corretive_lenses_le',
                              'vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri',
                              'vt_color_blind_test',
                              'vt_any_eye_injury_disease',
                              'vt_further_examination' ,
                              'at_hearing_left',
                              'at_hearing_right',
                              'mn_epilepsy',
                              'mn_last_seizure',
                              'mn_epilepsy_treatment',
                              'mn_diabetes',
                              'mn_diabetes_treatment',
                              'mn_sleep_apnea',
                              'mn_sleepapnea_treatment',
                              "mn_aggressive_manic",
                              'mn_mental_treatment',
                              'mn_others',
                              'mn_other_treatment',
                              'mn_other_medical_condition',
                              'exam_assessment',
                              'exam_assessment_remarks',
                              'exam_conditions',
                              'pt_remarks',
                              'exam_duration_remarks'

                            ,DB::raw("encode(id_picture, 'escape') as id_picture"))
                            ->get();

            // $_get_tb_Scratch2 = DB::table('tb_clinic_tests2')
            //                 ->where('trans_no', $_transaction_number)
            //                 ->get();

            if(count($_get_tb_Scratch) > 0 ){
                return response()->json([
                  'status' => "1",
                  'message' => "Connection Success",
                  'tb_scratch' => $_get_tb_Scratch,
                ]);
              }
            else {
              return response()->json([
                'status' => "0",
                'message' => "There was a problem in Connection."
              ]);
            }
          }
          catch (\Throwable $e) {
            return response()->json([
              'status' => "0",
              'message' => $e->getMessage()
            ]);
          }
    }

    //reports
    public function fetch_admin_summary_reports($_clinicId, Request $_request){
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];
        //$test_date = '2023-03-10';

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $data = DB::table('tb_clinic_tests_scratch')
        ->select( 'trans_no',
        'first_name',
        'middle_name',
        'last_name',
        DB::raw("CONCAT(tb_clinic_tests_scratch.first_name, ' ', tb_clinic_tests_scratch.middle_name, ' ', tb_clinic_tests_scratch.last_name) as full_name"),
        'is_printed',
        'date_printed',
        'is_lto_sent',
        'date_uploaded',
        'physician_name',
        'purpose'
         )
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        // ->whereDate('application_date', '>=', $current_date_time)
        // ->whereDate('application_date', '<=', $current_date_time)
        ->get();

        $transaction_pending = DB::table('tb_clinic_tests_scratch')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->where('is_lto_sent', '=', 0)
        // ->whereDate('application_date', '>=', $current_date_time)
        // ->whereDate('application_date', '<=', $current_date_time)
        ->count();

        $transaction_upload= DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        // ->whereDate('application_date', '>=', $current_date_time)
        // ->whereDate('application_date', '<=', $current_date_time)
        ->count();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

              if($transaction_pending < 0 && $transaction_upload < 0){
                    return view('summary_reports', [
                      'pageConfigs' => $pageHeader,
                      'transaction_pending' => 'DATA RETRIEVE FAILED!!!!!'
                    ]);
              }
              else{

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){

                  // return view('summary_reports', [
                  //   'pageConfigs' => $pageHeader,
                  //   'transaction_pending' => $transaction_pending,
                  //   'data' => $data,
                  //   'status' => 2,
                  //   'transaction_upload' => $transaction_upload,
                  //   'current_date_from' => $current_date_time,
                  //   'current_date_to' => $current_date_time
                  // ]);

                  return response()->json([
                    'pageConfigs' => $pageHeader,
                    'transaction_pending' => $transaction_pending,
                    'data' => $data,
                    'status' => 2,
                    'transaction_upload' => $transaction_upload,
                    'current_date_from' => $current_date_time,
                    'current_date_to' => $current_date_time
                  ]);

                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

              }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function admin_summary_reports($_clinicId, Request $_request){
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];
        //$test_date = '2023-03-10';

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $data = DB::table('tb_clinic_tests_scratch')
        ->select( 'trans_no',
        'first_name',
        'middle_name',
        'last_name',
        'is_printed',
        'date_printed',
        'is_lto_sent',
        'date_uploaded',
        'physician_name',
        'purpose'
         )
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('application_date', '>=', $current_date_time)
        ->whereDate('application_date', '<=', $current_date_time)
        ->get();

        $transaction_pending = DB::table('tb_clinic_tests_scratch')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->where('is_lto_sent', '=', 0)
        ->whereDate('application_date', '>=', $current_date_time)
        ->whereDate('application_date', '<=', $current_date_time)
        ->count();

        $transaction_upload= DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('application_date', '>=', $current_date_time)
        ->whereDate('application_date', '<=', $current_date_time)
        ->count();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

              if($transaction_pending < 0 && $transaction_upload < 0){
                    return view('summary_reports', [
                      'pageConfigs' => $pageHeader,
                      'transaction_pending' => 'DATA RETRIEVE FAILED!!!!!'
                    ]);
              }
              else{

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){

                  return view('summary_reports', [
                    'pageConfigs' => $pageHeader,
                    'transaction_pending' => $transaction_pending,
                    'data' => $data,
                    'status' => 2,
                    'transaction_upload' => $transaction_upload,
                    'current_date_from' => $current_date_time,
                    'current_date_to' => $current_date_time
                  ]);

                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

              }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }

    public function fetch_admin_summary_reportsby_date($_clinicId, $_date_from, $_date_to, $status, Request $_request){
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        //$test_date = '2023-03-10';
        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        if($status == 2){
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            DB::raw("CONCAT(tb_clinic_tests_scratch.first_name, ' ', tb_clinic_tests_scratch.middle_name, ' ', tb_clinic_tests_scratch.last_name) as full_name"),
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->whereDate('application_date', '>=', $_date_from)
            ->whereDate('application_date', '<=', $_date_to)
            ->get();
        }
        else{
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            DB::raw("CONCAT(tb_clinic_tests_scratch.first_name, ' ', tb_clinic_tests_scratch.middle_name, ' ', tb_clinic_tests_scratch.last_name) as full_name"),
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->where('is_lto_sent', '=', $status)
            ->whereDate('application_date', '>=', $_date_from)
            ->whereDate('application_date', '<=', $_date_to)
            ->get();
        }

        $transaction_pending = DB::table('tb_clinic_tests_scratch')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->where('is_lto_sent', '=', 0)
        ->whereDate('application_date', '>=', $_date_from)
        ->whereDate('application_date', '<=', $_date_to)
        ->count();

        $transaction_upload= DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('application_date', '>=', $_date_from)
        ->whereDate('application_date', '<=', $_date_to)
        ->count();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

              if($transaction_pending < 0 && $transaction_upload < 0){
                    return view('summary_reports', [
                      'pageConfigs' => $pageHeader,
                      'transaction_pending' => 'DATA RETRIEVE FAILED!!!!!'
                    ]);
              }
              else{

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){
                    // return view('summary_reports', [
                    //     'pageConfigs' => $pageHeader,
                    //     'data' => $data,
                    //     'status' => $status,
                    //     'transaction_pending' => $transaction_pending,
                    //     'transaction_upload' => $transaction_upload,
                    //     'current_date_from' => $_date_from,
                    //     'current_date_to' => $_date_to
                    //   ]);

                    return response()->json([
                      'pageConfigs' => $pageHeader,
                      'data' => $data,
                      'status' => $status,
                      'transaction_pending' => $transaction_pending,
                      'transaction_upload' => $transaction_upload,
                      'current_date_from' => $_date_from,
                      'current_date_to' => $_date_to
                    ]);
                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

              }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function admin_summary_reportsby_date($_clinicId, $_date_from, $_date_to, $status, Request $_request){
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        //$test_date = '2023-03-10';
        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        if($status == 2){
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->whereDate('application_date', '>=', $_date_from)
            ->whereDate('application_date', '<=', $_date_to)
            ->get();
        }
        else{
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->where('is_lto_sent', '=', $status)
            ->whereDate('application_date', '>=', $_date_from)
            ->whereDate('application_date', '<=', $_date_to)
            ->get();
        }

        $transaction_pending = DB::table('tb_clinic_tests_scratch')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->where('is_lto_sent', '=', 0)
        ->whereDate('application_date', '>=', $_date_from)
        ->whereDate('application_date', '<=', $_date_to)
        ->count();

        $transaction_upload= DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('application_date', '>=', $_date_from)
        ->whereDate('application_date', '<=', $_date_to)
        ->count();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

              if($transaction_pending < 0 && $transaction_upload < 0){
                    return view('summary_reports', [
                      'pageConfigs' => $pageHeader,
                      'transaction_pending' => 'DATA RETRIEVE FAILED!!!!!'
                    ]);
              }
              else{

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){
                    return view('summary_reports', [
                        'pageConfigs' => $pageHeader,
                        'data' => $data,
                        'status' => $status,
                        'transaction_pending' => $transaction_pending,
                        'transaction_upload' => $transaction_upload,
                        'current_date_from' => $_date_from,
                        'current_date_to' => $_date_to
                      ]);
                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

              }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function export_admin_summary_reports($_clinicId, $date_from, $date_to, $status,  Request $_request)  {

        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageConfigs = ['pageHeader' => true];
        //$test_date = '2023-03-10';

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $transaction_pending_count = DB::table('tb_clinic_tests_scratch')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('date_exam', '>=', $date_from)
        ->whereDate('date_exam', '<=', $date_to)
        ->count();

        $transaction_upload_count= DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('date_exam', '>=', $date_from)
        ->whereDate('date_exam', '<=', $date_to)
        ->count();

        if($status == 2){
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->whereDate('application_date', '>=', $date_from)
            ->whereDate('application_date', '<=', $date_to)
            ->get();
        }
        else{
            $data = DB::table('tb_clinic_tests_scratch')
            ->select( 'trans_no',
            'first_name',
            'middle_name',
            'last_name',
            'is_printed',
            'date_printed',
            'is_lto_sent',
            'date_uploaded',
            'physician_name',
            'purpose'
             )
            ->where('clinic_name', '=',  $_clinic_name)
            ->where('clinic_id', '=', $_clinic_id)
            ->where('is_lto_sent', '=', $status)
            ->whereDate('application_date', '>=', $date_from)
            ->whereDate('application_date', '<=', $date_to)
            ->get();
        }

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                if($transaction_pending_count < 0 && $transaction_upload_count < 0){
                    return back()->with('fail');
                }
                else{
                    $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true
                      ])->loadView('transaction_summary_pdf', [
                        'transaction_upload_count'=> $transaction_upload_count,
                        'transaction_pending_count'=> $transaction_pending_count,
                        'date_from' => str_replace('-', '/', $date_from),
                        'date_to' => str_replace('-', '/', $date_to),
                        'data' => $data,
                        'status' => $status
                      ]);
                      $pdf->setPaper('letter', 'landscape');

                      return $pdf->stream();
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }
    }
    public function admin_certificate_list($_clinicId, Request $_request)  {
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
        'blankPage' => true
    ];
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $getTransactionUpload = DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('date_uploaded', '>=', '2018/01/01')
        ->whereDate('date_uploaded', '<=', $current_date_time)
        ->get();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);


            if($_selectClinicDetails->count() > 0){

                return view('getCertificatelist', [
                    'pageConfigs' => $pageHeader,
                    'data' => $getTransactionUpload,
                    'date_from' => '2018/01/01',
                    'date_to' => $current_date_time
                  ]);

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function admin_certificate_list_by_date($_clinicId, $date_from, $date_to,  Request $_request)  {
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
        'blankPage' => true
    ];
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $getTransactionUpload = DB::table('tb_clinic_tests')
        ->where('clinic_name', '=',  $_clinic_name)
        ->where('clinic_id', '=', $_clinic_id)
        ->whereDate('date_uploaded', '>=', date("Y-m-d", strtotime($date_from)))
        ->whereDate('date_uploaded', '<=', date("Y-m-d", strtotime($date_to)))
        ->get();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);


            if($_selectClinicDetails->count() > 0){

                // if($getTransactionUpload->count() > 0){
                    return view('getCertificatelist', [
                        'pageConfigs' => $pageHeader,
                        'data' => $getTransactionUpload,
                        'date_from' => $date_from,
                        'date_to' => $date_to
                      ]);
                // }
                // else{
                //     return back()->with('fail');
                // }
            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }
    }
    public function admin_generate_cert($_clinicId, $trans_no,Request $_request){
        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;
        $_date_now = DB::select("SELECT now();");
        $_date_issue = date('m/d/Y H:i A', strtotime($_date_now[0]->now));
        $_medical_certificate_validity_ = date('m/d/Y H:i A', strtotime($_date_now[0]->now. ' + 60 days'));
        // $_transaction_number = $_request->trans_no;
        $_transaction_number = $trans_no;

            $_clinic_name = Session('data_clinic')->clinic_name;
            $med_cert_ref_no = $_transaction_number;
            $users_data = DB::table('tb_clinic_tests')
            ->select(
                    'trans_no',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'address_full',
                    'birthday',
                    'gender',
                    'nationality',
                    'age',
                    'occupation',
                    'civil_status',
                    'license_type',
                    'new_renew',
                    'license_no',
                    'purpose',
                    'pt_height',
                    'pt_weight',
                    'pt_pulse_rate',
                    'pt_body_temperature',
                    'pt_respiratory_rate',
                    'pt_blood_pressure',
                    'blood_type',
                    'pt_general_physique',
                    'pt_contagious_disease',
                    'pt_ue_normal_left',
                    'pt_ue_normal_right',
                    'pt_le_normal_left',
                    'pt_le_normal_right',
                    'pt_eye_color',
                    'vt_snellen_bailey_lovie_left',
                    'vt_snellen_bailey_lovie_right',
                    'vt_snellen_with_correct_right',
                    'vt_snellen_with_correct_left',
                    'vt_color_blind_left',
                    'vt_color_blind_right',
                    'vt_glare_contrast_sensitivity_function_without_lenses_right',
                    'vt_glare_contrast_sensitivity_function_without_lenses_left',
                    'vt_glare_contrast_sensitivity_function_with_corretive_lenses_le',
                    'vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri',
                    'vt_color_blind_test',
                    'vt_any_eye_injury_disease',
                    'vt_further_examination' ,
                    'at_hearing_left',
                    'at_hearing_right',
                    'mn_epilepsy',
                    'mn_last_seizure',
                    'mn_epilepsy_treatment',
                    'mn_diabetes',
                    'mn_diabetes_treatment',
                    'mn_sleep_apnea',
                    'mn_sleepapnea_treatment',
                    'mn_aggressive_manic',
                    'mn_mental_treatment',
                    'mn_others',
                    'mn_other_treatment',
                    'mn_other_medical_condition',
                    'exam_assessment',
                    'exam_assessment_remarks',
                    'exam_conditions',
                    'pt_remarks',
                    'physician_name',
                    'physician_prc_no',
                    'physician_ptr_no',
                    'exam_duration_remarks',
                    DB::raw("encode(id_picture, 'escape') as id_picture"))
            ->where('tb_clinic_tests.trans_no', '=', $_transaction_number)
            ->where('clinic_id', $_clinic_id)
            ->where('clinic_name', $_clinic_name)
            ->get();
        $pageConfigs = ['pageHeader' => true];

        $pdf = PDF::setOptions([
          'isHtml5ParserEnabled' => true,
          'isRemoteEnabled' => true,
          'defaultFont' => 'sans-serif',
        ])->loadView('certificate', [
          'pageConfigs' => $pageConfigs,
          'data' => $users_data,
          'clinic_name' => $_clinic_name,
          'prc_number' => $users_data[0]->physician_prc_no,
          'ptr_number' => $users_data[0]->physician_ptr_no,
          'physician_name' => $users_data[0]->physician_name,
          'med_cert_ref_no' =>$med_cert_ref_no,
          'date_issue' => $_date_issue,
          'medical_certificate_validity_' => $_medical_certificate_validity_
        ])->setpaper('letter', 'portrait');
        return $pdf->stream();
    }

    //Generate logs
    public function fetch_admin_generate_logs($_clinicId, Request $_request)  {
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;

        $getUserlogs = DB::table('tb_user_logs')
        ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
        // ->whereDate('period', '>=', $current_date_time)
        // ->whereDate('period', '<=', $current_date_time)
        ->get();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                if($getUserlogs->count() > 0){

                    $_selectLoginCredential = DB::table('tb_users')
                    ->select('user_id')
                    ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();

                    if($_selectLoginCredential->count() > 0){

                        return response()->json([
                          'pageConfigs' => $pageHeader,
                          'data' => $getUserlogs,
                          'date_from' => $current_date_time,
                          'date_to' => $current_date_time,
                          'module' => '*'
                        ]);
                    }
                    else{
                        return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                    }

                }
                else{
                    return back()->with('fail');
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }

    public function admin_generate_logs($_clinicId, Request $_request)  {
        $system_date = DB::select("SELECT now();");
        $current_date_time = date_format(date_create($system_date[0]->now), "Y/m/d");
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;

        $getUserlogs = DB::table('tb_user_logs')
        ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
        // ->whereDate('period', '>=', $current_date_time)
        // ->whereDate('period', '<=', $current_date_time)
        ->get();

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                if($getUserlogs->count() > 0){

                    $_selectLoginCredential = DB::table('tb_users')
                    ->select('user_id')
                    ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();

                    if($_selectLoginCredential->count() > 0){

                        return view('user_logs', [
                            'pageConfigs' => $pageHeader,
                            'data' => $getUserlogs,
                            'date_from' => $current_date_time,
                            'date_to' => $current_date_time,
                            'module' => '*'
                          ]);
                    }
                    else{
                        return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                    }

                }
                else{
                    return back()->with('fail');
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }

    public function fetch_admin_generate_logs_by_date($_clinicId, $date_from, $date_to, $module, Request $_request)  {
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        if($module == '*'){
            $getUserlogs = DB::table('tb_user_logs')
            ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
            ->whereDate('period', '>=', $date_from)
            ->whereDate('period', '<=', $date_to)
            ->get();
        }
        else{
            $getUserlogs = DB::table('tb_user_logs')
            ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
            ->where('module', '=', $module)
            ->whereDate('period', '>=', $date_from)
            ->whereDate('period', '<=', $date_to)
            ->get();
        }

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                if($getUserlogs->count() > 0){

                    $_selectLoginCredential = DB::table('tb_users')
                    ->select('user_id')
                    ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();

                    if($_selectLoginCredential->count() > 0){
                          return response()->json([
                            'pageConfigs' => $pageHeader,
                            'data' => $getUserlogs,
                            'date_from' => $date_from,
                            'date_to' => $date_to,
                            'module' => $module
                          ]);

                    }
                    else{
                        return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                    }

                }
                else{
                  return response()->json([
                    'pageConfigs' => $pageHeader,
                    'data' => [],
                    'date_from' => $date_from,
                    'date_to' => $date_to,
                    'module' => $module
                  ]);
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }

    public function admin_generate_logs_by_date($_clinicId, $date_from, $date_to, $module, Request $_request)  {
        $pageHeader = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        if($module == '*'){
            $getUserlogs = DB::table('tb_user_logs')
            ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
            ->whereDate('period', '>=', $date_from)
            ->whereDate('period', '<=', $date_to)
            ->get();
        }
        else{
            $getUserlogs = DB::table('tb_user_logs')
            ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
            ->where('module', '=', $module)
            ->whereDate('period', '>=', $date_from)
            ->whereDate('period', '<=', $date_to)
            ->get();
        }

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                if($getUserlogs->count() > 0){

                    $_selectLoginCredential = DB::table('tb_users')
                    ->select('user_id')
                    ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();

                    if($_selectLoginCredential->count() > 0){

                        return view('user_logs', [
                            'pageConfigs' => $pageHeader,
                            'data' => $getUserlogs,
                            'date_from' => $date_from,
                            'date_to' => $date_to,
                            'module' => $module
                          ]);

                    }
                    else{
                        return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                    }

                }
                else{
                    return back()->with('fail');
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function export_admin_generate_logs_by_date($_clinicId, $date_from, $date_to, $module, Request $_request)  {
        $pageConfigs = ['pageHeader' => true];

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $getUserlogs = DB::table('tb_user_logs')
        ->where('processed_by', 'like', '%'.$_clinic_id.'-'.'%')
        ->where('module', '=', $module)
        ->whereDate('period', '>=', $date_from)
        ->whereDate('period', '<=', $date_to)
        ->get();

        if($getUserlogs < 0){
            return back()->with('fail');
        }
        else{
            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
              ])->loadView('transaction_summary_pdf', [
                'data' => $getUserlogs,
                'date_from' => $date_from,
                'date_to' => $date_to,
                'module' => $module
              ]);
              $pdf->setPaper('letter', 'landscape');

              return $pdf->stream();
        }
    }

    //account setting
    public function admin_account_setting($_clinicId, Request $_request){
        $user_id = Session('UserLoggedInfo')->user_id;
        $user_password = Session('UserLoggedInfo')->password;
        $user_type = Session('UserLoggedInfo')->user_type;
        $user_expiration = Session('UserLoggedInfo')->expiration;
        $user_gender = Session('UserLoggedInfo')->gender;
        $first_name = Session('UserLoggedInfo')->first_name;
        $middle_name = Session('UserLoggedInfo')->middle_name;
        $last_name = Session('UserLoggedInfo')->last_name;
        $is_active = Session('UserLoggedInfo')->is_active;
        $photo = Session('UserLoggedInfo')->pic1;

        $pageHeader = ['pageHeader' => true];

        try {
            $_dateNow = DB::select("SELECT now();");
            $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

            $_selectClinicDetails = DB::table('tb_clinics')
                    ->select('clinic_id',
                            'clinic_name',
                            'address_full',
                            'lto_authorization_no',
                            'date_medical_started',
                            'date_medical_accredited',
                            'date_medical_authorized',
                             )
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('is_active', '=', 1)
                    ->get();
            //dd($_apiUrl, $_selectClinicDetails);
            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];

            if($_selectClinicDetails->count() > 0){

                $_selectLoginCredential = DB::table('tb_users')
                ->select('user_id')
                ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                if($_selectLoginCredential->count() > 0){

                    return view('/account_settings', [
                        'pageConfigs' => $pageHeader,
                        'user_id' => $user_id,
                        'user_type' => $user_type,
                        'user_expiration' => $user_expiration,
                        'user_gender' => $user_gender,
                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'last_name' => $last_name,
                        'is_active' => $is_active,
                        'photo' => $photo
                      ]);

                }
                else{
                    return redirect(route('logout_admin',$_clinicId))->with('info','User Id and Clinic Id does not match');
                }

            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }

    }
    public function admin_account_setting_edit($_clinicId, Request $_request){
        $user_id = Session('UserLoggedInfo')->user_id;

        $_request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
          ]);

        try {

            DB::beginTransaction();

            $lockUser = DB::table('tb_users')
            ->where('user_id', '=', $user_id)
            ->where('clinic_id', '=', $_clinicId)
            ->lockForUpdate()
            ->first();

            if($lockUser == true && $lockUser  == true){

                $data_query = DB::table('tb_users')
                ->where('user_id', '=', $user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->update($param =  ['first_name' => $_request->first_name,
                                    'middle_name' => $_request->middle_name,
                                    'last_name' => $_request->last_name,
                                    'full_name' => $_request->first_name." ".$_request->middle_name." ".$_request->last_name]);

                DB::commit();

                return response()->json([
                    'status' => "1",
                    'message' =>  "User ID : '" .$user_id . "' for ClinicId: ".$_clinicId." has been updated. Please Relogin"
                ]);

            }
            else{

                return response()->json([
                    'status' => "0",
                    'message' => "There was a problem in retrieving User Id"
                ]);
            }

        } catch (\Throwable $e) {

            DB::rollback();

            return response()->json([
                'status' => "0",
                'message' =>  "User ID : '" .$user_id . "' for ClinicId: ".$_clinicId. " ".$e->getMessage()
              ]);

        }
    }
    public function admin_password_edit($_clinicId, Request $_request){
        $user_id = Session('UserLoggedInfo')->user_id;

        $_request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string'
          ]);

        $_new_password = $_request->new_password;
        $_old_password = $_request->old_password;
        $_enc_new_password = hash("sha512", $_new_password);
        $_enc_old_password = hash("sha512", $_old_password);
        // $_selectaccount = '';

        // if ($_selectaccount[0]->password == $_enc_old_password) { ---
          if ($_old_password == $_enc_old_password) {
            try {

                DB::beginTransaction();

                $lockUser = DB::table('tb_users')
                ->select('password')
                ->where('user_id', '=', $user_id)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->lockForUpdate()
                ->first();

                if($lockUser == true && $lockUser  == true){

                    DB::beginTransaction();

                    $data_query = DB::table('tb_users')
                    ->where('user_id', '=', $user_id)
                    ->where('clinic_id', '=', $_clinicId)
                    ->update([
                        'password' => $_enc_new_password
                    ]);

                    DB::commit();

                    return response()->json([
                        'status' => "1",
                        'message' =>  "User ID : '" .$user_id . "' for ClinicId: ".$_clinicId." password has been change. Please Relogin"
                    ]);

                }
                else{

                    return response()->json([
                        'status' => "0",
                        'message' => "There was a problem in retrieving User Id"
                    ]);
                }

            } catch (\Throwable $e) {

                DB::rollback();

                return response()->json([
                    'status' => "0",
                    'message' =>  "User ID : '" .$user_id . "' for ClinicId: ".$_clinicId. " ".$e->getMessage()
                  ]);

            }

        }
        else{
            return response()->json([
            'status' => "0",
            'message' =>  "Incorrect old password"
            ]);
        }

    }
}
