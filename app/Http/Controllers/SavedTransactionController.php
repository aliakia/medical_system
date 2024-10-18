<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use Carbon\Carbon;
use DateTime;
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
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class SavedTransactionController extends Controller
{
  public function fetch_user_data ($_clinicId) {
    $users_data = DB::table('tb_clinic_tests_scratch')
    ->join('tb_clinic_tests_progress', 'tb_clinic_tests_scratch.trans_no', '=', 'tb_clinic_tests_progress.trans_no')
    ->select('tb_clinic_tests_progress.*',

            'tb_clinic_tests_scratch.trans_no',
            DB::raw("CONCAT(tb_clinic_tests_scratch.first_name, ' ', tb_clinic_tests_scratch.middle_name, ' ', tb_clinic_tests_scratch.last_name) as full_name"),
            'tb_clinic_tests_scratch.first_name',
            'tb_clinic_tests_scratch.middle_name',
            'tb_clinic_tests_scratch.last_name',
            'tb_clinic_tests_scratch.is_printed',
            'tb_clinic_tests_scratch.date_printed',
            'tb_clinic_tests_scratch.date_uploaded')
    // ->whereDate('application_date', '>=',  date_format(date_create($_dateNow[0]->now), "Y-m-d"))
    // ->whereDate('application_date', '<=',  date_format(date_create($_dateNow[0]->now), "Y-m-d"))
    ->where('clinic_id', '=', $_clinicId)
    ->get();

    return response()->json([
      'data' => $users_data
  ]);
  }

  public function get_save_client_data($_clinicId)
  {
      $_date_from = date('Y-m-d');
      $_date_to = date('Y-m-d');

      $_dateNow = DB::select("SELECT now();");
      $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

      $users_data = DB::table('tb_clinic_tests_scratch')
              ->join('tb_clinic_tests_progress', 'tb_clinic_tests_scratch.trans_no', '=', 'tb_clinic_tests_progress.trans_no')
              ->select('tb_clinic_tests_progress.*',

                      'tb_clinic_tests_scratch.trans_no',
                      'tb_clinic_tests_scratch.first_name',
                      'tb_clinic_tests_scratch.middle_name',
                      'tb_clinic_tests_scratch.last_name',
                      'tb_clinic_tests_scratch.is_printed',
                      'tb_clinic_tests_scratch.date_printed',
                      'tb_clinic_tests_scratch.date_uploaded')
              // ->whereDate('application_date', '>=',  date_format(date_create($_dateNow[0]->now), "Y-m-d"))
              // ->whereDate('application_date', '<=',  date_format(date_create($_dateNow[0]->now), "Y-m-d"))
              ->where('clinic_id', '=', $_clinicId)
              ->get();

        $pageHeader = ['pageHeader' => true];
        $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

        try {

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

          $tb_clinic_balance = DB::table('tb_clinic_balance')
          ->where('clinic_id', $_clinicId)
          ->select(
            'transmission_fee',
            'balance',
            'account_type',
            'max_credit')
          ->get();

          if($_selectClinicDetails->count() > 0){

            $_verifyLoginCredential = DB::table('tb_users')
              ->select('user_id')
              ->where('user_id', '=', Session('LoggedUser')->user_id)
              ->where('clinic_id', '=', $_clinicId)
              ->where('is_active', '=', 1)
              ->get();

              if($_verifyLoginCredential->count() > 0){

                return view('encoder/saved_trans', [
                  'pageConfigs' => $pageHeader,
                  'date_from' => $_date_from,
                  'date_to' => $_date_to,
                  'data' => $users_data,
                  'balance' => $tb_clinic_balance
                  //'progress' => $tb_progress
                ]);

              }
              else{
                  return redirect(route('logout_user',$_clinicId))->with('info','User Id and Clinic Id does not match');
              }

          }else {
              return view('content/miscellaneous/error', [
                  'pageConfigs' => $pageConfigs
              ])->with('fail',"Clinic Id not found");
          }
        }
        catch (\Exception $e) {

          dd($e);
          return view('content/miscellaneous/error', [
              'pageConfigs' => $pageConfigs
          ])->with('fail', $e->getMessage());
        }

  }
  public function get_save_client_data_bydate($_clinicId, $date_from, $date_to)
  {
    $_date_from = $date_from;
    $_date_to = $date_to;

    $users_data = DB::table('tb_clinic_tests_scratch')
    ->join('tb_clinic_tests_progress', 'tb_clinic_tests_scratch.trans_no', '=', 'tb_clinic_tests_progress.trans_no')
    ->select('tb_clinic_tests_progress.*',

            'tb_clinic_tests_scratch.trans_no',
            'tb_clinic_tests_scratch.first_name',
            'tb_clinic_tests_scratch.middle_name',
            'tb_clinic_tests_scratch.last_name',
            'tb_clinic_tests_scratch.is_printed',
            'tb_clinic_tests_scratch.date_printed',
            'tb_clinic_tests_scratch.date_uploaded')
    ->where('clinic_id', '=', $_clinicId)
    ->whereDate('application_date', '>=', date("Y-m-d", strtotime($_date_from)))
    ->whereDate('application_date', '<=', date("Y-m-d", strtotime($_date_to)))
    ->get();

      $pageHeader = ['pageHeader' => true];
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
        'blankPage' => true
    ];
      try {
        // $_dateNow = DB::select("SELECT now();");
        // $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

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


        $tb_clinic_balance = DB::table('tb_clinic_balance')
        ->where('clinic_id', $_clinicId)
        ->select(
          'transmission_fee',
          'balance',
          'account_type',
          'max_credit')
        ->get();

        if($_selectClinicDetails->count() > 0){

          $_verifyLoginCredential = DB::table('tb_users')
        ->select('user_id')
        ->where('user_id', '=', Session('LoggedUser')->user_id)
        ->where('clinic_id', '=', $_clinicId)
        ->where('is_active', '=', 1)
        ->get();

        if($_verifyLoginCredential->count() > 0){

          return view('encoder/saved_trans', [
            'pageConfigs' => $pageHeader,
            // 'breadcrumbs' => $breadcrumbs,
            'date_from' => $_date_from,
            'date_to' => $_date_to,
            'data' => $users_data,
            'balance' => $tb_clinic_balance
          ]);

        }
        else{
            return redirect(route('logout_user',$_clinicId))->with('info','User Id and Clinic Id does not match');
        }


        }else {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail',"Clinic Id not found");
        }
    } catch (\Exception $e) {
      dd($e);
        return view('content/miscellaneous/error', [
            'pageConfigs' => $pageConfigs
        ])->with('fail', $e->getMessage());
    }

  }
  // public function continue_saved_data($_clinicId, $data,Request $request)
  // {
  //   $_data = explode('=', $data);

  //   $_date_now = DB::select("SELECT now();");
  //   $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
  //   $_clinic_id = Session('data_clinic')->clinic_id;
  //   $user_id = Session('LoggedUser')->user_id;

    // Log::LoginActionLogs('CONTINUE TRANSACTION',$user_id.' - Continue transaction number: '.$_data[0],'-',$_clinic_id.'-'.$user_id,$date_created);
    // dd( Log::LoginActionLogs('CONTINUE TRANSACTION',$user_id.' - Continue transaction number: '.$_data[0],'-',$_clinic_id.'-'.$user_id,$date_created));
  //   $pageConfigs = [
  //     'bodyClass' => "bg-full-screen-image",
  //     'blankPage' => true
  //   ];

  //   try {
  //     $_dateNow = DB::select("SELECT now();");
  //     $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

  //     $_selectClinicDetails = DB::table('tb_clinics')
  //             ->select('clinic_id',
  //                     'clinic_name',
  //                     'address_full',
  //                     'lto_authorization_no',
  //                     'date_medical_started',
  //                     'date_medical_accredited',
  //                     'date_medical_authorized',
  //                      )
  //             ->where('clinic_id', '=', $_clinicId)
  //             ->where('is_active', '=', 1)
  //             ->get();
  //     //dd($_apiUrl, $_selectClinicDetails);
  //     $pageConfigs = [
  //         'bodyClass' => "bg-full-screen-image",
  //         'blankPage' => true
  //     ];

  //     if($_selectClinicDetails->count() > 0){
  //       $_purpose = DB::table('tb_license_purpose')
  //       ->where('is_active', '=', 1)
  //       ->get();

  //       $_bloodtype = DB::table('tb_blood_types')
  //       ->where('is_active', '=', 1)
  //       ->get();

  //       $count = DB::table('tb_clinic_tests')->max('recno');

  //       if($count != null || $count != ''){
  //         $last_data = DB::table('tb_clinic_tests')
  //         ->select('date_uploaded')
  //         ->where('clinic_id', '=', $_clinicId)
  //         ->where('recno', '=', $count)
  //         ->get();
  //         $start = Carbon::parse($last_data[0]->date_uploaded);
  //         //$start = Carbon::parse('2023-04-12 16:00:00+08');
  //         $end = Carbon::parse($_newDateTime);

  //         $diff_in_minutes = $end->diffInMinutes($start);
  //         $total_diff = 8-$diff_in_minutes.":00";

  //         return view('encoder/continue_trans', [
  //           'count' => $total_diff,
  //           'trans_no' => $_data[0],
  //           'test_physical_completed' => $_data[1],
  //           'test_visual_actuity_completed' => $_data[2],
  //           'test_hearing_auditory_completed' => $_data[3],
  //           'test_metabolic_neurological_completed' => $_data[4],
  //           'test_health_history_completed' => $_data[5],
  //           'is_final' => $_data[6],
  //           'is_ltms_uploaded' => $_data[7],
  //           'purpose' => $_purpose,
  //           'blood_type' => $_bloodtype
  //         ]);
  //       }
  //       else{
  //         return view('encoder/continue_trans', [
  //           'count' => "09:00",
  //           'trans_no' => $_data[0],
  //           'test_physical_completed' => $_data[1],
  //           'test_visual_actuity_completed' => $_data[2],
  //           'test_hearing_auditory_completed' => $_data[3],
  //           'test_metabolic_neurological_completed' => $_data[4],
  //           'test_health_history_completed' => $_data[5],
  //           'is_final' => $_data[6],
  //           'is_ltms_uploaded' => $_data[7],
  //           'purpose' => $_purpose,
  //           'blood_type' => $_bloodtype
  //         ]);
  //       }


  //     }else {
  //       return view('login', [
  //         'pageConfigs' => $pageConfigs
  //     ]);
  //     }
  //   } catch (\Exception $e) {
  //     dd($e);
  //       return view('content/miscellaneous/error', [
  //           'pageConfigs' => $pageConfigs
  //       ])->with('fail', $e->getMessage());
  //   }

  // }
  public function continue_saved_data($_clinicId, $data, Request $request)
{
    $_data = explode('=', $data);

    // Check if the exploded array has at least 8 elements
    if (count($_data) < 8) {
        // Handle the error: return an error view or log the issue
        return view('content/miscellaneous/error', [
            'pageConfigs' => [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ]
        ])->with('fail', 'Invalid data format');
    }

    $_date_now = DB::select("SELECT now();");
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $_clinic_id = Session('data_clinic')->clinic_id;
    $user_id = Session('LoggedUser')->user_id;

    try {
        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

        $_selectClinicDetails = DB::table('tb_clinics')
            ->select(
                'clinic_id',
                'clinic_name',
                'address_full',
                'lto_authorization_no',
                'date_medical_started',
                'date_medical_accredited',
                'date_medical_authorized'
            )
            ->where('clinic_id', '=', $_clinicId)
            ->where('is_active', '=', 1)
            ->get();

        if ($_selectClinicDetails->count() > 0) {
            $_purpose = DB::table('tb_license_purpose')
                ->where('is_active', '=', 1)
                ->get();

            $_bloodtype = DB::table('tb_blood_types')
                ->where('is_active', '=', 1)
                ->get();

            $count = DB::table('tb_clinic_tests')->max('recno');

            if ($count != null || $count != '') {
                $last_data = DB::table('tb_clinic_tests')
                    ->select('date_uploaded')
                    ->where('clinic_id', '=', $_clinicId)
                    ->where('recno', '=', $count)
                    ->get();
                $start = Carbon::parse($last_data[0]->date_uploaded);
                $end = Carbon::parse($_newDateTime);

                $diff_in_minutes = $end->diffInMinutes($start);
                $total_diff = 8 - $diff_in_minutes . ":00";

                return view('encoder/continue_trans', [
                    'count' => $total_diff,
                    'trans_no' => $_data[0],
                    'test_physical_completed' => $_data[1],
                    'test_visual_actuity_completed' => $_data[2],
                    'test_hearing_auditory_completed' => $_data[3],
                    'test_metabolic_neurological_completed' => $_data[4],
                    'test_health_history_completed' => $_data[5],
                    'is_final' => $_data[6],
                    'is_ltms_uploaded' => $_data[7],
                    'purpose' => $_purpose,
                    'blood_type' => $_bloodtype
                ]);
            } else {
                return view('encoder/continue_trans', [
                    'count' => "09:00",
                    'trans_no' => $_data[0],
                    'test_physical_completed' => $_data[1],
                    'test_visual_actuity_completed' => $_data[2],
                    'test_hearing_auditory_completed' => $_data[3],
                    'test_metabolic_neurological_completed' => $_data[4],
                    'test_health_history_completed' => $_data[5],
                    'is_final' => $_data[6],
                    'is_ltms_uploaded' => $_data[7],
                    'purpose' => $_purpose,
                    'blood_type' => $_bloodtype
                ]);
            }
        } else {
            return view('login', [
                'pageConfigs' => [
                    'bodyClass' => "bg-full-screen-image",
                    'blankPage' => true
                ]
            ]);
        }
    } catch (\Exception $e) {
        return view('content/miscellaneous/error', [
            'pageConfigs' => [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ]
        ])->with('fail', $e->getMessage());
    }
}

  public function get_client_data($_clinicId, Request $request){

    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $data_ = $request->trans_no;
      try {

        if($_clinic_id == null || $_clinic_name == null || $_clinic_id == '' || $_clinic_name == ''){
          return response()->json([
            'status' => "0",
            'message' => 'Empty Clinic Name & Clinic ID'
          ]);
        }
        else{
          $_get_tb_Scratch = DB::table('tb_clinic_tests_scratch')
          ->where('trans_no', $data_)
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
            // 'license_type',
            // 'new_renew',
            'license_no',
            'purpose',
            'pt_height',
            'pt_weight',
            'pt_pulse_rate',
            'pt_bmi',
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
            'mn_diabetes_remarks',
            'mn_epilepsy_remarks',
            'mn_sleep_apnea_remarks',
            'mn_aggresive_manic_remarks',
            'mn_other_medical_condition_remarks',
            'exam_assessment',
            'exam_assessment_remarks',
            'exam_conditions',
            'pt_remarks',
            'exam_duration_remarks',
            DB::raw("encode(id_picture, 'escape') as id_picture"))
          ->get();

          $_get_tb_Scratch2 = DB::table('tb_clinic_tests_scratch2')
          ->where('trans_no', $data_)
          ->get();

          $readprogress = DB::table('tb_clinic_tests_progress')
          ->where('trans_no','=', $data_)
          ->get();

          if($_get_tb_Scratch->count() > 0 && $_get_tb_Scratch2->count() > 0){
            return response()->json([
              'status' => '1',
              'progress' => $readprogress,
              'data_scratch' => $_get_tb_Scratch,
              'data_scratch2' => $_get_tb_Scratch2
            ]);
          }
          else{
            return response()->json([
              'status' => "0",
              'message' => 'Retrieve Failed'
            ]);
          }
        }
      }
      catch (\Throwable $e) {
      return response()->json([
        'status' => "0",
        'message' => $e->getMessage()
      ]);
      }
  }

  public function save_trans_next($_clinicId, Request $_request)
  {
    $user_id = Session('LoggedUser')->user_id;
    $encoder = Session('LoggedUser')->full_name;
    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $_date_now = DB::select("SELECT now();");
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));

    $_prc_number = Session('LoggedUser')->prc_no;
    $_ptr_number = Session('LoggedUser')->ptr_no;
    $_physician_name = Session('LoggedUser')->full_name;
    $_physician_id= Session('LoggedUser')->physician_id;

    $trans_no =  $_request->trans_no;

    $_request->validate([
      'base_64' => 'required',
      // 'mode' => 'required|string',
      'firstname' => 'required',
      'middlename' => 'required',
      'lastname' => 'required',
      'address' => 'required',
      'birthday' => 'required',
      'age' => 'required',
      'nationality' => 'required',
      'gender' => 'required',
      'civilstatus' => 'required',
      'occupation' => 'required',
      // 'licenseType' => 'required',
      // 'newRenewal' => 'required',
      // 'license_no' => 'required',
      'purpose' => 'required',
    ]);


    try {

      DB::beginTransaction();

      $lockScratch = DB::table('tb_clinic_tests_scratch')
      ->where('trans_no', $trans_no)
      ->lockForUpdate()
      ->first();

      $lockProgress = DB::table('tb_clinic_tests_progress')
      ->where('trans_no', $trans_no)
      ->lockForUpdate()
      ->first();

      if($lockScratch == true && $lockProgress  == true){

        $_updateToScratch = DB::table('tb_clinic_tests_scratch')
        ->where('trans_no', $trans_no)
        ->where('clinic_id', $_clinic_id)
        ->where('clinic_name', $_clinic_name)
        ->update([
          // "user_id"=> Session('LoggedUser')->user_id,
          // "license_type"=> $_request->licenseType,
          // "new_renew"=> $_request->newRenewal,
          "trans_no"                                       => $trans_no,
          "full_name"                                      => $_request->firstname ." ".$_request->middlename." ". $_request->lastname,
          "first_name"                                     => $_request->firstname,
          "middle_name"                                    => $_request->middlename,
          "last_name"                                      => $_request->lastname,
          "address_full"                                   => $_request->address,
          "birthday"                                       => $_request->birthday,
          "age"                                            => $_request->age,
          "nationality"                                    => $_request->nationality,
          "gender"                                         => $_request->gender,
          "civil_status"                                   => $_request->civilstatus,
          "occupation"                                     => $_request->occupation,
          "license_type"                                   => $_request->licenseType,
          "new_renew"                                      => $_request->newRenewal,
          "license_no"                                     => $_request->license_no,
          "purpose"                                        => $_request->purpose,
          "id_picture"                                     => $_request->base_64,
          "nationality"                                    => $_request->nationality,
          "lto_client_id"                                  => $_request->lto_client_id,
          "clinic_id"                                      => $_clinic_id,
          "clinic_name"                                    => $_clinic_name,
          "encoded_by"                                     => $encoder,
          "application_date"                               => $date_created,
          'physician_name'                                 => $_physician_name,
          'physician_prc_no'                               => $_prc_number,
          'physician_ptr_no'                               => $_ptr_number,
          'physician_id'                                   => $_physician_id
        ]);

        DB::commit();

        // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Client Information: '.$trans_no,'Save Client Information Success',$_clinic_id.'-'.$user_id,$date_created);

        $readprogress = DB::table('tb_clinic_tests_progress')
        ->where('trans_no','=', $trans_no)
        ->get();

        if($readprogress->count() > 0){

          return response()->json([
            'status' => "1",
            'progress' => $readprogress,
            'message' => "Application Information saving successful",
            'trans_no' => $trans_no
          ]);

        }
        else{

          // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Client Information','There was a problem in saving applicant progress. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

          return response()->json([
            'status' => "0",
            'message' => "There was a problem in saving client progress. Please Contact Administrator"
          ]);

        }
      }
      else{

        // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Client Information','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

        return response()->json([
            'status' => "0",
            'message' => "There was a problem in retrieving client transaction No."
        ]);

      }

    }
    catch (\Throwable $e) {

      DB::rollback();

      // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Client Information',$e->getMessage(). ' Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

      return response()->json([
        'status' => "0",
        'message' => $e->getMessage()
      ]);

    }

  }
  public function save_physical_trans($_clinicId, Request $_request)
  {
    $user_id = Session('LoggedUser')->user_id;
    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $_date_now = DB::select("SELECT now();");
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $date_exam = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $trans_no =  $_request->trans_no;

    $_request->validate([
      'height' => 'required',
      'weight' => 'required',
      'bmi' => 'required',
      'mm' => 'required',
      'hg' => 'required',
      // 'scale_temp' => 'required',
      'body_temperature' => 'required',
      'pulse_rate' => 'required',
      'blood_type' => 'required',
      'respiratory_rate' => 'required',
      'disability' => 'required',
      'upper_extremities_left' => 'required',
      'upper_extremities_right' => 'required',
      'lower_extremities_left' => 'required',
      'lower_extremities_right' => 'required',
      'disease' => 'required'
    ]);

    if ($_request->disease == "none") {
      $_disease_value = "none";
    }else {
      $_disease_value = $_request->txtdisease;
    }

    if ($_request->disability == "normal") {
      $_disability_value = "normal";
    }else {
      $_disability_value = $_request->txtdisability;
    }

    try {

      DB::beginTransaction();

      $lockScratch = DB::table('tb_clinic_tests_scratch')
      ->where('trans_no', $trans_no)
      ->lockForUpdate()
      ->first();

      $lockProgress = DB::table('tb_clinic_tests_progress')
      ->where('trans_no', $trans_no)
      ->lockForUpdate()
      ->first();

      if($lockScratch == true && $lockProgress  == true){

        $_updateToScratch = DB::table('tb_clinic_tests_scratch')
        ->where('trans_no', $trans_no)
        ->where('clinic_id', $_clinic_id)
        ->where('clinic_name', $_clinic_name)
        ->update([
                  "date_exam" => $date_exam,
                  "pt_height"=>  $_request->height,
                  "pt_weight"=> $_request->weight,
                  "pt_bmi"=> $_request->bmi,
                  "pt_blood_pressure"=> $_request->mm."/".$_request->hg,
                  "pt_body_temperature"=> $_request->body_temperature."°C",
                  "pt_pulse_rate"=> $_request->pulse_rate,
                  "pt_respiratory_rate"=> $_request->respiratory_rate,
                  "blood_type"=> $_request->blood_type,
                  "pt_general_physique"=> $_disability_value,
                  "pt_ue_normal_left"=> $_request->upper_extremities_left,
                  "pt_ue_normal_right"=> $_request->upper_extremities_right,
                  "pt_le_normal_left"=> $_request->lower_extremities_left,
                  "pt_le_normal_right"=> $_request->lower_extremities_right,
                  "pt_contagious_disease"=> $_disease_value
        ]);

        $_updateToProgress = DB::table('tb_clinic_tests_progress')
        ->where('trans_no', $trans_no)
        ->update(['test_physical_started' => $date_created,
                  'test_physical_completed' => 1
        ]);

        DB::commit();

        // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Physical Exam: '.$trans_no,'Save Physical Exam Result Success',$_clinic_id.'-'.$user_id,$date_created);

        $readprogress = DB::table('tb_clinic_tests_progress')
        ->where('trans_no','=', $trans_no)
        ->where('test_physical_completed','=', 1)
        ->get();

        if($readprogress->count() > 0){

          return response()->json([
            'status' => "1",
            'progress' => $readprogress,
            'message' => "Physical Exam Result saving successful",
            'trans_no' => $trans_no
          ]);

        }
        else{

          // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Physical Exam','There was a problem in saving applicant progress. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

          return response()->json([
            'status' => "0",
            'message' => "There was a problem in saving client progress. Please Contact Administrator"
          ]);

        }
      }
      else{

        // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Physical Exam','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

        return response()->json([
            'status' => "0",
            'message' => "There was a problem in retrieving client transaction No."
        ]);

      }
    }catch (\Throwable $e) {

      DB::rollback();

      // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Physical Exam',$e->getMessage(). ' Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

      return response()->json([
        'status' => "0",
        'message' => $e->getMessage()
      ]);

    }

  }
  public function save_visual_hearing_trans($_clinicId, Request $_request)
  {
        $user_id = Session('LoggedUser')->user_id;
        $_date_now = DB::select("SELECT now();");
        $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
        $trans_no =  $_request->trans_no;

        $_request->validate([
          'eye_color' => 'required',
          'snellen_bailey_lovie_left' => 'required',
          'snellen_bailey_lovie_right' => 'required',
          'corrective_lens_left' => 'required',
          'corrective_lens_right' => 'required',
          'color_blind_left' => 'required',
          'color_blind_right' => 'required',
          'glare_contrast_sensitivity_without_lense_right' => 'required',
          'glare_contrast_sensitivity_without_lense_left' => 'required',
          'glare_contrast_sensitivity_with_corrective_right' => 'required',
          'glare_contrast_sensitivity_with_corrective_left' => 'required',
          'color_blind_test' => 'required',
          'examination_suggested' => 'required',
          'eye_injury' => 'required',
          'hearing_left' => 'required',
          'hearing_right' => 'required'
        ]);


        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        try {

            DB::beginTransaction();

            $lockScratch = DB::table('tb_clinic_tests_scratch')
                        ->where('trans_no', $trans_no)
                        ->lockForUpdate()
                        ->first();

            $lockProgress = DB::table('tb_clinic_tests_progress')
                        ->where('trans_no', $trans_no)
                        ->lockForUpdate()
                        ->first();

            if($lockScratch == true && $lockProgress  == true){

                $_updateToScratch = DB::table('tb_clinic_tests_scratch')
                                ->where('trans_no', $trans_no)
                                ->where('clinic_id', $_clinic_id)
                                ->where('clinic_name', $_clinic_name)
                                ->update([
                                          "pt_eye_color"=>  $_request->eye_color,
                                          "vt_snellen_bailey_lovie_left"=> $_request->snellen_bailey_lovie_left,
                                          "vt_snellen_bailey_lovie_right"=> $_request->snellen_bailey_lovie_right,
                                          "vt_snellen_with_correct_left"=> $_request->corrective_lens_left,
                                          "vt_snellen_with_correct_right"=> $_request->corrective_lens_right,
                                          "vt_color_blind_left"=> $_request->color_blind_left,
                                          "vt_color_blind_right"=> $_request->color_blind_right,
                                          "vt_glare_contrast_sensitivity_function_without_lenses_right"=> $_request->glare_contrast_sensitivity_without_lense_right,
                                          "vt_glare_contrast_sensitivity_function_without_lenses_left"=> $_request->glare_contrast_sensitivity_without_lense_left,
                                          "vt_glare_contrast_sensitivity_function_with_corretive_lenses_le"=> $_request->glare_contrast_sensitivity_with_corrective_right,
                                          "vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri"=> $_request->glare_contrast_sensitivity_with_corrective_left,
                                          "vt_color_blind_test"=> $_request->color_blind_test,
                                          "vt_any_eye_injury_disease"=> $_request->eye_injury,
                                          "vt_further_examination" => $_request->examination_suggested,
                                          "at_hearing_left" => $_request->hearing_left,
                                          "at_hearing_right" => $_request->hearing_right
                                ]);

                $_updateToProgress = DB::table('tb_clinic_tests_progress')
                                ->where('trans_no', $trans_no)
                                ->update(['test_visual_actuity_started' => $date_created,
                                          'test_visual_actuity_completed' => 1,
                                          'test_hearing_auditory_started' => $date_created,
                                          'test_hearing_auditory_completed' => 1
                                ]);

                DB::commit();

                // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Visual and Hearing Exam: '.$trans_no,'-',$_clinic_id.'-'.$user_id,$date_created);

                $readprogress = DB::table('tb_clinic_tests_progress')
                              ->where('trans_no','=', $trans_no)
                              ->where('test_physical_completed','=', 1)
                              ->where('test_visual_actuity_completed','=', 1)
                              ->where('test_hearing_auditory_completed','=', 1)
                              ->get();

                if($readprogress->count() > 0){

                  return response()->json([
                    'status' => "1",
                    'progress' => $readprogress,
                    'message' => "Application Information saving successful",
                    'trans_no' => $trans_no
                  ]);

                }
                else{

                  // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Visual and Hearing Exam','There was a problem in saving applicant progress. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

                  return response()->json([
                    'status' => "0",
                    'message' => "There was a problem in saving client progress. Please Contact Administrator"
                  ]);

                }

            }
            else{

                // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Visual and Hearing Exam','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

                return response()->json([
                    'status' => "0",
                    'message' => "There was a problem in retrieving client transaction No."
                ]);

            }
      }
      catch (\Throwable $e) {

              DB::rollback();

              // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Visual and Hearing Exam',$e->getMessage(). ' Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

              return response()->json([
                'status' => "0",
                'message' => $e->getMessage()
              ]);

      }
  }
  public function save_metabolic_neurological_trans($_clinicId, Request $_request)
  {
        $user_id = Session('LoggedUser')->user_id;
        $_date_now = DB::select("SELECT now();");
        $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
        $trans_no =  $_request->trans_no;


        $_request->validate([
          'epilepsy' => 'required',
          'diabetes' => 'required',
          'sleepapnea' => 'required',
          'mental' => 'required',
          'other' => 'required'
        ]);

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $epilepsy_treatment_value = '';
        $last_seizure_value = '';
        $diabetes_treatment_value = '';
        $sleepapnea_treatment_value = '';
        $mental_treatment_value = '';
        $other_treatment_value = '';
        $other_medical_condition_value = '';

        if($_request->epilepsy == '0'){
          $epilepsy_treatment_value = null;
          $last_seizure_value = null;
        }
        else{
          $epilepsy_treatment_value = $_request->epilepsy_treatment;
          $last_seizure_value = $_request->last_seizure;
        }

        if($_request->diabetes == '0'){
          $diabetes_treatment_value = null;
        }
        else{
          $diabetes_treatment_value = $_request->diabetes_treatment;
        }

        if($_request->sleepapnea == '0'){
          $sleepapnea_treatment_value = null;
        }
        else{
          $sleepapnea_treatment_value = $_request->sleepapnea_treatment;
        }

        if($_request->mental == '0'){
          $mental_treatment_value = null;
        }
        else{
          $mental_treatment_value = $_request->mental_treatment;
        }

        if($_request->other == '0'){
          $other_medical_condition_value = null;
          $other_treatment_value = null;
        }
        else{
          $other_medical_condition_value = $_request->other_medical_condition;
          $other_treatment_value = $_request->other_treatment;
        }

        //----------------------------------------------------------------------
        if($_request->epilepsy_treatment == '0'){
          $txt_epilepsy_treatment_value = null;
        }
        else{
          $txt_epilepsy_treatment_value = $_request->txt_epilepsy_treatment;
        }

        if($_request->diabetes_treatment == '0'){
          $txt_diabetes_treatment_value = null;
        }
        else{
          $txt_diabetes_treatment_value= $_request->txt_diabetes_treatment;
        }

        if($_request->sleepapnea_treatment == '0'){
          $txt_sleepapnea_treatment_value = null;
        }
        else{
          $txt_sleepapnea_treatment_value = $_request->txt_sleepapnea_treatment;
        }

        if($_request->mental_treatment == '0'){
          $txt_mental_treatment_value = null;
        }
        else{
          $txt_mental_treatment_value = $_request->txt_mental_treatment;
        }

        if($_request->other_treatment == '0'){
          $txt_other_treatment_value = null;
        }
        else{
          $txt_other_treatment_value = $_request->txt_other_treatment;
        }

        try{

            DB::beginTransaction();

            $lockScratch = DB::table('tb_clinic_tests_scratch')
            ->where('trans_no', $trans_no)
            ->lockForUpdate()
            ->first();

            $lockProgress = DB::table('tb_clinic_tests_progress')
            ->where('trans_no', $trans_no)
            ->lockForUpdate()
            ->first();

            if($lockScratch == true && $lockProgress  == true){

                $_updateToScratch = DB::table('tb_clinic_tests_scratch')
                            ->where('trans_no', $trans_no)
                            ->where('clinic_id', $_clinic_id)
                            ->where('clinic_name', $_clinic_name)
                            ->update([
                              //"user_id"=> Session('LoggedUser')->user_id,
                              "mn_epilepsy"=>  $_request->epilepsy,
                              "mn_last_seizure"=> $last_seizure_value,
                              "mn_epilepsy_treatment"=> $epilepsy_treatment_value,
                              "mn_diabetes"=> $_request->diabetes,
                              "mn_diabetes_treatment"=> $diabetes_treatment_value,
                              "mn_sleep_apnea"=> $_request->sleepapnea,
                              "mn_sleepapnea_treatment"=> $sleepapnea_treatment_value,
                              "mn_aggressive_manic"=> $_request->mental,
                              "mn_mental_treatment"=> $mental_treatment_value,
                              "mn_others"=> $_request->other,
                              "mn_other_treatment"=> $other_treatment_value,
                              "mn_other_medical_condition"=> $other_medical_condition_value,
                              "mn_diabetes_remarks"=> $txt_diabetes_treatment_value,
                              "mn_epilepsy_remarks"=> $txt_epilepsy_treatment_value,
                              "mn_sleep_apnea_remarks"=> $txt_sleepapnea_treatment_value,
                              "mn_aggresive_manic_remarks"=> $txt_mental_treatment_value,
                              "mn_other_medical_condition_remarks"=> $txt_other_treatment_value
                            ]);

                $_updateToProgress = DB::table('tb_clinic_tests_progress')
                            ->where('trans_no', $trans_no)
                            ->update(['test_metabolic_neurological_started' => $date_created,
                                      'test_metabolic_neurological_completed' => 1
                             ]);

                DB::commit();

                // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Metabolic and Neurological Disorders Exam: '.$trans_no,'-',$_clinic_id.'-'.$user_id,$date_created);

                $readprogress = DB::table('tb_clinic_tests_progress')
                          ->where('test_physical_completed','=', 1)
                          ->where('test_visual_actuity_completed','=', 1)
                          ->where('test_hearing_auditory_completed','=', 1)
                          ->where('test_metabolic_neurological_completed','=', 1)
                          ->where('trans_no','=', $trans_no)
                          ->get();

                if($readprogress->count() > 0){

                    return response()->json([
                      'status' => "1",
                      'progress' => $readprogress,
                      'message' => "Application Information saving successful",
                      'trans_no' => $trans_no
                    ]);

                }
                else{

                    // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Metabolic and Neurological Disorders Exam','There was a problem in saving applicant progress. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

                    return response()->json([
                      'status' => "0",
                      'message' => "There was a problem in saving client progress. Please Contact Administrator"
                    ]);

                }

            }
            else{

              // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Metabolic and Neurological Disorders Exam','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

              return response()->json([
                  'status' => "0",
                  'message' => "There was a problem in retrieving client transaction No."
              ]);

            }

        }
        catch (\Throwable $e) {

            DB::rollback();

            // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Metabolic and Neurological Disorders Exam',$e->getMessage(). ' Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

            return response()->json([
              'status' => "0",
              'message' => $e->getMessage()
            ]);

        }

  }
  public function save_assessment_condition_trans($_clinicId, Request $_request)
  {
        $user_id = Session('LoggedUser')->user_id;
        $_date_now = DB::select("SELECT now();");
        $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
        $trans_no =  $_request->trans_no;

        $_request->validate([
          'assessment' => 'required',
          // 'conditions' => 'required',
          'remarks' => 'required'
        ]);

        $_clinic_id = Session('data_clinic')->clinic_id;
        $_clinic_name = Session('data_clinic')->clinic_name;

        $assessment_status_value = '';

        if($_request->assessment == 'Fit'){
          $assessment_status_value = null;
        }
        else{
          $assessment_status_value = $_request->assessment_status;
        }

        if($_request->assessment_status == 'Temporary'){
          $temporary_duration_value = $_request->assessment_temporary_duration;
        }
        else{
          $temporary_duration_value = null;
        }

        if($_request->ConditionOutput == null || $_request->ConditionOutput == ''){
          $ConditionOutput_ = '0';
        }
        else{
          $ConditionOutput_ = $_request->ConditionOutput;
        }

        try {

            $lockScratch = DB::table('tb_clinic_tests_scratch')
            ->where('trans_no', $trans_no)
            ->lockForUpdate()
            ->first();

            $lockProgress = DB::table('tb_clinic_tests_progress')
            ->where('trans_no', $trans_no)
            ->lockForUpdate()
            ->first();

            if($lockScratch == true && $lockProgress  == true){

                DB::beginTransaction();

                $_updateToScratch = DB::table('tb_clinic_tests_scratch')
                                ->where('trans_no', $trans_no)
                                ->where('clinic_id', $_clinic_id)
                                ->where('clinic_name', $_clinic_name)
                                ->update([
                                        "exam_assessment"=>  $_request->assessment,
                                        "exam_assessment_remarks"=> $assessment_status_value,
                                        "exam_conditions"=>  $ConditionOutput_,
                                        "exam_duration_remarks"=>  $temporary_duration_value,
                                        "pt_remarks"=> $_request->remarks
                                ]);


                  $_updateToProgress = DB::table('tb_clinic_tests_progress')
                                ->where('trans_no', $trans_no)
                                ->update(['is_final' => 1]);

                  DB::commit();

                  // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Assessment and Condition: '.$trans_no,'-',$_clinic_id.'-'.$user_id,$date_created);

                  $readprogress = DB::table('tb_clinic_tests_progress')
                                ->where('test_physical_completed','=', 1)
                                ->where('test_visual_actuity_completed','=', 1)
                                ->where('test_hearing_auditory_completed','=', 1)
                                ->where('test_metabolic_neurological_completed','=', 1)
                                ->where('is_final','=', 1)
                                ->where('trans_no','=', $trans_no)
                                ->get();

                  if ($readprogress->count() > 0) {

                    return response()->json([
                      'status' => "1",
                      'progress' => $readprogress,
                      'message' => "Application Information saving successful",
                      'trans_no' => $trans_no
                    ]);

                  }
                  else{

                    // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Assessment and Condition','There was a problem in saving client progress. Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                    return response()->json([
                      'status' => "0",
                      'message' => "There was a problem in saving client progress. Please Contact Administrator"
                    ]);

                  }

            }
            else{

              Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Assessment and Condition','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

              return response()->json([
                  'status' => "0",
                  'message' => "There was a problem in retrieving client transaction No."
              ]);

            }
      }
      catch (\Throwable $e) {

        DB::rollback();

        Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Save Assessment and Condition',$e->getMessage(). ' Client Transaction Number: '.$trans_no,$_clinicId.'-'.$user_id,$date_created);

        return response()->json([
          'status' => "0",
          'message' => $e->getMessage()
        ]);

      }
  }
  public function view_saved_data($_clinicId, $data,Request $request)
  {
    $_data = $data;

    $_date_now = DB::select("SELECT now();");
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $user_id = Session('LoggedUser')->user_id;
    // $saveLogs = Log::LoginActionLogs('VIEW SAVED DATA',$user_id.' - View transaction number: '.$_data,'-',$_clinic_id.'-'.$user_id,$date_created);
        try {
          $_get_tb_Scratch = DB::table('tb_clinic_tests_scratch')
                ->where('trans_no', $_data)
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
                  // 'license_type',
                  // 'new_renew',
                  'license_no',
                  'purpose',
                  'pt_height',
                  'pt_weight',
                  'pt_bmi',
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
                  'mn_diabetes_remarks',
                  'mn_epilepsy_remarks',
                  'mn_sleep_apnea_remarks',
                  'mn_aggresive_manic_remarks',
                  'mn_other_medical_condition_remarks',
                  'exam_assessment',
                  'exam_assessment_remarks',
                  'exam_conditions',
                  'pt_remarks',
                  'exam_duration_remarks',
                  DB::raw("encode(id_picture, 'escape') as id_picture"))
                ->get();
          $_get_tb_Scratch2 = DB::table('tb_clinic_tests_scratch2')
                ->where('trans_no', $_data)
                ->get();
        if($_get_tb_Scratch->count() > 0 && $_get_tb_Scratch2->count() > 0){
          // $saveLogs;
          return response()->json([
            'status' => '1',
            'message'=>'Retrieve Successful',
            'data_scratch' => $_get_tb_Scratch,
            'data_scratch2' => $_get_tb_Scratch2
          ]);

        }
        else{
          return response()->json([
            'status' => "0",
            'message' => 'Retrieve Failed'
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

  public function save_check_new_cert_printed_date($_clinicId, $_trans_no, Request $_request)
  {

    $users_data = DB::table('tb_clinic_tests')
    ->select('trans_no',
            'date_uploaded',
            DB::raw("encode(id_picture, 'escape') as id_picture"))
    ->where('trans_no','=', $_trans_no)
    ->where('clinic_id','=',$_clinicId)
    ->get();

    $_date_now = DB::select("SELECT now();");
    // $_medical_certificate_date_reprint = date('m/d/Y H:i:s P', strtotime($users_data[0]->date_uploaded. ' + 60 days'));
    $_medical_certificate_date_reprint = date('m/d/Y H:i:s P', strtotime($users_data[0]->date_uploaded));
    $_newDateTime = date_format(date_create($_date_now[0]->now), "m/d/Y H:i:s P");
    $start = Carbon::parse($_medical_certificate_date_reprint);
    $end = Carbon::parse($_newDateTime);
    //$end = Carbon::parse('2023-06-17 15:25:14+08');

    $diff_in_days = $end->diffInDays($start);

    if($users_data != null && $users_data != ''){

      if($diff_in_days <= 60){
        return response()->json([
          'status' => 1,
          '_trans_no' => $_trans_no,
          'message' => "success"
        ]);
      }
      else{
        return response()->json([
          'status' => 0,
          'message' => "error",
          '_medical_certificate_date_reprint' => $diff_in_days,
        ]);
      }

    }
    else{
      return response()->json([
                    'status' => "0",
                    'message' => "There was a problem in Retrieving Data."
      ]);
    }

  }
  public function save_get_new_cert_data($_clinicId, $_trans_no, Request $_request)
  {
    $user_id = Session('LoggedUser')->user_id;
    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $_date_now = DB::select("SELECT now();");
    $_date_issue = date('m/d/Y H:i A', strtotime($_date_now[0]->now));
    $_medical_certificate_validity_ = date('m/d/Y H:i A', strtotime($_date_now[0]->now. ' + 60 days'));
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $saveLogs = Log::LoginActionLogs('GENERATE CERTIFICATE',$user_id.' - Generate client certificate','Client Transaction Number: '.$_trans_no,$_clinicId.'-'.$user_id,$date_created);


        $_clinic_name = Session('data_clinic')->clinic_name;
        $_prc_number = Session('LoggedUser')->prc_no;
        $_ptr_number = Session('LoggedUser')->ptr_no;
        $_physician_name = Session('LoggedUser')->full_name;


        $users_data = DB::table('tb_clinic_tests')
        ->select('trans_no',
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
                // 'license_type',
                // 'new_renew',
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
                'mn_diabetes_remarks',
                'mn_epilepsy_remarks',
                'mn_sleep_apnea_remarks',
                'mn_aggresive_manic_remarks',
                'mn_other_medical_condition_remarks',
                'exam_assessment',
                'exam_assessment_remarks',
                'exam_conditions',
                'pt_remarks',
                'reference_no',
                'exam_duration_remarks',
                DB::raw("encode(id_picture, 'escape') as id_picture"))
        ->where('trans_no','=', $_trans_no)
        ->where('clinic_id','=',$_clinic_id)
        ->where('clinic_name','=', $_clinic_name)
        ->get();

        $pageConfigs = ['pageHeader' => true];

        $_param = [
          'is_printed' => 1,
          'date_printed' => $date_created
        ];

          $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
          ])->loadView('certificate', [
          'data' => $users_data,
          'clinic_name' => $_clinic_name,
          'prc_number' => $_prc_number,
          'ptr_number' => $_ptr_number,
          'physician_name' => $_physician_name,
          'med_cert_ref_no' => $users_data[0]->reference_no,
          'date_issue' => $_date_issue,
          'medical_certificate_validity_' => $_medical_certificate_validity_
        ])->setpaper('legal', 'portrait');

        $saveLogs;
        DB::table('tb_clinic_tests')->where('trans_no', '=', $_trans_no)->update($_param);
        DB::table('tb_clinic_tests_scratch')->where('trans_no', '=', $_trans_no)->update($_param);
        return $pdf->stream();
  }

  public function save_verify_biometrics($_clinicId, Request $_request)
  {

      $user_id = Session('LoggedUser')->user_id;
      $_date_now = DB::select("SELECT now();");
      $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
      $date_now = date('Y-m-d\TH:i:s\Z', strtotime($_date_now[0]->now));
      $date_time = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));

      $medical_certificate_validity_ = date('Y-m-d\TH:i:s\Z', strtotime($_date_now[0]->now. ' + 60 days'));

      $_clinic_id = Session('data_clinic')->clinic_id;
      $_clinic_name = Session('data_clinic')->clinic_name;
      $_clinic_accredation_number = Session('data_clinic')->lto_authorization_no;
      $_transaction_number = $_request->trans_no;

      $biometricsData = ($_request->Biometrics_data);
      $password = 'VoxDeiProtocolSystemsMedicalSystem2014';
      $method = 'aes-256-cbc';

      // Must be exact 32 chars (256 bit)
      $password = substr(hash('sha256', $password, true), 0, 32);
      //echo "Password:" . $password . "\n";

      // IV must be exact 16 chars (128 bit)
      $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

      // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
      //$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, //OPENSSL_RAW_DATA, $iv));

      // decrypted String
      $decrypted = openssl_decrypt(base64_decode($biometricsData), $method, $password, OPENSSL_RAW_DATA, $iv);
      $biometrics_data = json_decode($decrypted)->finger_bmp;

      $_prc_number = Session('LoggedUser')->prc_no;
      $_physician_id= Session('LoggedUser')->physician_id;

      $tb_scratch = DB::table('tb_clinic_tests_scratch')
      ->where('trans_no',$_transaction_number)
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
        'age',
        // 'license_type',
        // 'new_renew',
        'license_no',
        'purpose',
        'pt_height',
        'pt_weight',
        'pt_bmi',
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
        'encoded_by',
        'application_date',
        'date_exam',
        'lto_client_id',
        DB::raw("encode(id_picture, 'escape') as id_picture"))
      ->get();

      $exam_condition_value = '';
      if($tb_scratch[0]->exam_conditions == '0'){
        $exam_condition_value = null;
      }
      else{
        $exam_condition_value = $tb_scratch[0]->exam_conditions;
      }

      if ($tb_scratch->count() > 0) {

        $purpose_ = '';
        if($tb_scratch[0]->purpose == '1'){
            $purpose_ = "New Non-Pro Driver´s License";
        }
        else if($tb_scratch[0]->purpose == '2'){
            $purpose_ ="New Pro Driver´s License";
        }
        else if($tb_scratch[0]->purpose == '3'){
            $purpose_ ="Renewal of Non-Pro Driver´s License";
        }
        else if($tb_scratch[0]->purpose == '4'){
            $purpose_ ="Renewal of Pro Driver´s License";
        }
        else if($tb_scratch[0]->purpose == '5'){
            $purpose_ ="Renewal of Conductor´s License";
        }
        else if($tb_scratch[0]->purpose == '6'){
            $purpose_ ="Conversion from Non-Pro to Pro DL";
        }
        else if($tb_scratch[0]->purpose == '7'){
            $purpose_ ="New Non-Pro Driver´s License (with Foreign License)";
        }
        else if($tb_scratch[0]->purpose == '8'){
            $purpose_ ="New Pro Driver´s License (with Foreign License)";
        }
        else if($tb_scratch[0]->purpose == '9'){
            $purpose_ ="New Conductor´s License";
        }
        else if($tb_scratch[0]->purpose == '10'){
            $purpose_ ="New Student Permit";
        }
        else if($tb_scratch[0]->purpose == '11'){
            $purpose_ ="Conversion from Pro to Non-Pro DL";
        }
        else if($tb_scratch[0]->purpose == '12'){
            $purpose_ ="Add Restriction for Non-Pro Driver´s License";
        }
        else if($tb_scratch[0]->purpose == '13'){
            $purpose_ ="Add Restriction for Pro Driver´s License";
        }

          $payloadParameter = [
            "first_name" => $tb_scratch[0]->first_name,
            "last_name"=> $tb_scratch[0]->last_name,
            "middle_name" => $tb_scratch[0]->middle_name,
            "address" => $tb_scratch[0]->address_full,
            "date_of_birth"=> $tb_scratch[0]->birthday,
            "gender"=> $tb_scratch[0]->gender,
            "nationality"=> $tb_scratch[0]->nationality,
            "civil_status"=> $tb_scratch[0]->civil_status,
            "height"=> $tb_scratch[0]->pt_height,
            "weight"=> $tb_scratch[0]->pt_weight,
            "purpose"=> $tb_scratch[0]->purpose,
            "license_no"=> $tb_scratch[0]->license_no,
            "condition"=> $exam_condition_value,
            "assessment"=> $tb_scratch[0]->exam_assessment,
            "assessment_status" => $tb_scratch[0]->exam_assessment_remarks,
            "medical_exam_date"=> $date_now,
            "client_application_date"=> $date_now,
            "itpcode"=> "VOX DEI PROTOCOL SYSTEMS, INC.",
            "reference_no" => $_transaction_number,
            "physician_prc_license_no" => $_prc_number,
            "occupation" => $tb_scratch[0]->occupation,
            "applicant_photo" => $tb_scratch[0]->id_picture,
            "blood_pressure" => $tb_scratch[0]->pt_blood_pressure,
            "disability" => $tb_scratch[0]->pt_general_physique,
            "disease" => $tb_scratch[0]->pt_contagious_disease,
            "snellen_bailey_lovie_left" => $tb_scratch[0]->vt_snellen_bailey_lovie_left,
            "snellen_bailey_lovie_right" => $tb_scratch[0]->vt_snellen_bailey_lovie_right,
            "corrective_lens_left" => $tb_scratch[0]->vt_snellen_with_correct_left,
            "corrective_lens_right" => $tb_scratch[0]->vt_snellen_with_correct_right,
            "color_blind_left" => $tb_scratch[0]->vt_color_blind_left,
            "color_blind_right" => $tb_scratch[0]->vt_color_blind_right,
            "hearing_left" => $tb_scratch[0]->at_hearing_left,
            "hearing_right" => $tb_scratch[0]->at_hearing_right,
            "upper_extremities_left" => $tb_scratch[0]->pt_ue_normal_left,
            "upper_extremities_right" => $tb_scratch[0]->pt_ue_normal_right,
            "lower_extremities_left"  => $tb_scratch[0]->pt_le_normal_left,
            "lower_extremities_right" => $tb_scratch[0]->pt_le_normal_right,
            "diabetes" => $tb_scratch[0]->mn_diabetes,
            "diabetes_treatment" => $tb_scratch[0]->mn_diabetes_treatment,
            "epilepsy" => $tb_scratch[0]->mn_epilepsy,
            "epilepsy_treatment" => $tb_scratch[0]->mn_epilepsy_treatment,
            "last_seizure" => $tb_scratch[0]->mn_last_seizure,
            "sleepapnea" => $tb_scratch[0]->mn_sleep_apnea,
            "sleepapnea_treatment" => $tb_scratch[0]->mn_sleepapnea_treatment,
            "mental" => $tb_scratch[0]->mn_aggressive_manic,
            "mental_treatment" => $tb_scratch[0]->mn_mental_treatment,
            "other" => $tb_scratch[0]->mn_others,
            "other_treatment" => $tb_scratch[0]->mn_other_treatment,
            "other_medical_condition" => $tb_scratch[0]->mn_other_medical_condition,
            "temporary_duration" => "60 days",
            "remarks" => $tb_scratch[0]->pt_remarks,
            "medical_certificate_validity" => $medical_certificate_validity_,
            "eye_color" => $tb_scratch[0]->pt_eye_color,
            "blood_type" =>  $tb_scratch[0]->blood_type,
            "lto_client_id" => $tb_scratch[0]->lto_client_id
          ];

          try {

              $upload_details = Http::withHeaders(['Content-Type' => 'application/json'])
              ->post('https://clinic.api.qa.lto.direct/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results',[
              "physician_username" => $_physician_id ,
              "physician_biometrics"=> [$biometrics_data],
              "lto_accreditation_no" => $_clinic_accredation_number,
                    "Exam_Datas" => [(
                            $payloadParameter
                      )]
              ]);

              $header_response = $upload_details->headers();
              $processupload_details_return = json_decode($upload_details->getBody()->getContents());
              $error_message = $header_response['error_message'][0];

                if($upload_details->status() == '200'){

                  $error_message = '';

                  try {

                        DB::beginTransaction();

                        $tb_clinic_balance = DB::table('tb_clinic_balance')
                                          ->where('clinic_id', $_clinic_id)
                                          ->select(
                                            'transmission_fee',
                                            'balance')
                                          ->lockForUpdate()
                                          ->get();

                        if($tb_clinic_balance == true){

                            $_updateTobalance = DB::table('tb_clinic_balance')
                            ->where('clinic_id', $_clinic_id)
                            ->update(['balance' => $tb_clinic_balance[0]->balance - $tb_clinic_balance[0]->transmission_fee]);

                            $_insertTotbclinicbalancedetails = DB::table('tb_clinic_balance_details')
                                                            ->insert(['trans_date' => $date_time,
                                                            'clinic_id' => $_clinic_id,
                                                            'ledger_code' => 'I01',
                                                            'ledger_description'=>'ITP TRANSMISSION FEE',
                                                            'debit'=> $tb_clinic_balance[0]->transmission_fee,
                                                            'balance' => $tb_clinic_balance[0]->balance - $tb_clinic_balance[0]->transmission_fee,
                                                            'remarks' => 'Transaction No.: '.$_transaction_number.', '.'Purpose: '.$purpose_.', '.'Physician Name: '.Session('LoggedUser')->full_name.', '.'Clinic Name:'.Session('data_clinic')->clinic_name,
                                                            'old_balance' => $tb_clinic_balance[0]->balance
                            ]);

                            DB::commit();

                            return response()->json([
                              'status' => "1",
                              'message' => "Physician Biometrics verify success",
                              'api_payload' =>serialize(json_decode($upload_details)),
                              'api_response' =>serialize($processupload_details_return),
                              'certificate_number' => $processupload_details_return->internal_reference_no
                            ]);
                            // return response()->json([
                            //   'status' => "1",
                            //   'message' => "Physician Biometrics verify success",
                            //   'api_payload' =>'',
                            //   'api_response' =>'',
                            //   'certificate_number' => '1'
                            // ]);

                        }
                        else{

                          ///Logs::LoginActionLogs('BIOMETRICS VERIFICATION',$user_id.' - physician biometrics verification','There was a problem in retrieving Clinic Id Information',$_clinicId.'-'.$user_id,$date_time);

                          return response()->json([
                              'status' => "0",
                              'message' => "There was a problem in retrieving Clinic Id Information"
                          ]);

                        }
                  }
                  catch (\Throwable $th) {

                    DB::rollBack();

                    //Logs::LoginActionLogs('BIOMETRICS VERIFICATION',$user_id.' - physician biometrics verification',$th->getMessage() .' Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                    return response()->json([
                        'status' => "0",
                        'message' => $th->getMessage()
                    ]);

                  }
                }
                else{

                  Log::LoginActionLogs('BIOMETRICS VERIFICATION',$user_id.' - physician biometrics verification',$error_message .' Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                  return response()->json([
                    'status' => "0",
                    'message' => $error_message
                  ]);

                }
          }
          catch (\Throwable $th) {

            Log::LoginActionLogs('BIOMETRICS VERIFICATION',$user_id.' - physician biometrics verification',$th->getMessage() .' Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

            return response()->json([
                'status' => "0",
                'message' => $th->getMessage()
            ]);

          }
      }
      else{

        Log::LoginActionLogs('BIOMETRICS VERIFICATION',$user_id.' - physician biometrics verification','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_time);

        return response()->json([
          'status' => "0",
          'message' => "Data retrieve error"
        ]);

      }

    }

  public function save_transaction_upload($_clinicId, Request $_request)
  {
    $_date_now = DB::select("SELECT now();");
    $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $date_now = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
    $medical_certificate_validity_ = date('Y-m-d\TH:i:s\Z', strtotime($_date_now[0]->now. ' + 60 days'));

    $_clinic_id = Session('data_clinic')->clinic_id;
    $_clinic_name = Session('data_clinic')->clinic_name;
    $_clinic_accredation_number = Session('data_clinic')->lto_authorization_no;
    $_clinic_address = Session('data_clinic')->address_full;
    $user_id = Session('LoggedUser')->physician_id;
    $_transaction_number = $_request->trans_no;

    //  $biometrics_data = $_request->instructor_bio;

    // $output2 =[];


    // $_fileName = "C:\\Medical_System_Biometrics\\json_data_file\\".$user_id."-".$_transaction_number.".json";

    // $_param2 = [
    //     'biometrics_data' => $biometrics_data,
    //     'user_id' => $user_id
    // ];

    // $_jsonParam2 = json_encode($biometrics_data, JSON_PRETTY_PRINT);


    // if (file_put_contents($_fileName, $_jsonParam2)) {
    //     exec("\"C:\Medical_System_Biometrics\Medical_System_Biometrics.exe\""
    //         . " " . "verify"
    //         . " " . $user_id."-".$_transaction_number.".json"
    //         . " " . "-", $output2);

    // }



    // $jObjBiometrics2 = $output2[0];

    $_prc_number = Session('LoggedUser')->prc_no;
    $_ptr_number = Session('LoggedUser')->ptr_no;
    $_physician_name = Session('LoggedUser')->full_name;
    $_physician_id= Session('LoggedUser')->physician_id;
    $med_cert_ref_no = $_transaction_number;

    $tb_phyisician = DB::table('tb_physicians')
    ->where('physician_id',$user_id)
    ->get();

    if(count($tb_phyisician) > 0){

        $tb_scratch = DB::table('tb_clinic_tests_scratch')
        ->where('trans_no',$_transaction_number)
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
          'age',
          'nationality',
          'occupation',
          'civil_status',
          // 'license_type',
          // 'new_renew',
          'license_no',
          'purpose',
          'pt_height',
          'pt_weight',
          'pt_bmi',
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
          'mn_diabetes_remarks',
          'mn_epilepsy_remarks',
          'mn_sleep_apnea_remarks',
          'mn_aggresive_manic_remarks',
          'mn_other_medical_condition_remarks',
          'exam_assessment',
          'exam_assessment_remarks',
          'exam_conditions',
          'pt_remarks',
          'encoded_by',
          'application_date',
          'date_exam',
          'exam_duration_remarks',
          'lto_client_id',
          DB::raw("encode(id_picture, 'escape') as id_picture"))
        ->get();

        $exam_condition_value = '';
        if($tb_scratch[0]->exam_conditions == '0'){
          $exam_condition_value = null;
        }
        else{
          $exam_condition_value = $tb_scratch[0]->exam_conditions;
        }

          // $tb_scratch2 = DB::table('tb_clinic_tests_scratch2')
          // ->where('trans_no',$_transaction_number)
          // ->get();

        if(count($tb_scratch) > 0){
            try {

                  DB::beginTransaction();

                  $lockScratch = DB::table('tb_clinic_tests_scratch')
                              ->where('trans_no', $_transaction_number)
                              ->where('clinic_id', $_clinic_id)
                              ->where('clinic_name', $_clinic_name)
                              ->lockForUpdate()
                              ->first();

                $lockProgress = DB::table('tb_clinic_tests_progress')
                              ->where('trans_no', $_transaction_number)
                              ->lockForUpdate()
                              ->first();

                if($lockScratch == true && $lockProgress  == true){

                      //---insert final data!!!
                      $_insertToclinicTest = DB::table('tb_clinic_tests')
                      ->insert([
                        "trans_no"                                       =>                          $tb_scratch[0]->trans_no,
                        "full_name"                                      =>                          $tb_scratch[0]->first_name." ".$tb_scratch[0]->middle_name." ".$tb_scratch[0]->last_name,
                        "first_name"                                     =>                          $tb_scratch[0]->first_name,
                        "middle_name"                                    =>                          $tb_scratch[0]->middle_name,
                        "last_name"                                      =>                          $tb_scratch[0]->last_name,
                        "address_full"                                   =>                          $tb_scratch[0]->address_full,
                        "birthday"                                       =>                          $tb_scratch[0]->birthday,
                        "age"                                            =>                          $tb_scratch[0]->age,
                        "nationality"                                    =>                          $tb_scratch[0]->nationality,
                        "gender"                                         =>                          $tb_scratch[0]->gender,
                        "civil_status"                                   =>                          $tb_scratch[0]->civil_status,
                        "occupation"                                     =>                          $tb_scratch[0]->occupation,
                        // "license_type"                                   =>                          $tb_scratch[0]->license_type,
                        // "new_renew"                                      =>                          $tb_scratch[0]->new_renew,
                        "license_no"                                     =>                          $tb_scratch[0]->license_no,
                        "purpose"                                        =>                          $tb_scratch[0]->purpose,
                        "id_picture"                                     =>                          $tb_scratch[0]->id_picture,
                        "pt_height"                                      =>                          $tb_scratch[0]->pt_height,
                        "pt_weight"                                      =>                          $tb_scratch[0]->pt_weight,
                        "pt_bmi"                                         =>                          $tb_scratch[0]->pt_bmi,
                        "pt_blood_pressure"                              =>                          $tb_scratch[0]->pt_blood_pressure,
                        "pt_body_temperature"                            =>                          $tb_scratch[0]->pt_body_temperature,
                        "pt_pulse_rate"                                  =>                          $tb_scratch[0]->pt_pulse_rate,
                        "pt_respiratory_rate"                            =>                          $tb_scratch[0]->pt_respiratory_rate,
                        "blood_type"                                     =>                          $tb_scratch[0]->blood_type,
                        "pt_general_physique"                            =>                          $tb_scratch[0]->pt_general_physique,
                        "pt_ue_normal_left"                              =>                          $tb_scratch[0]->pt_ue_normal_left,
                        "pt_ue_normal_right"                             =>                          $tb_scratch[0]->pt_ue_normal_right,
                        "pt_le_normal_left"                              =>                          $tb_scratch[0]->pt_le_normal_left,
                        "pt_le_normal_right"                             =>                          $tb_scratch[0]->pt_le_normal_right,
                        "pt_contagious_disease"                          =>                          $tb_scratch[0]->pt_contagious_disease,
                        "pt_eye_color"                                   =>                          $tb_scratch[0]->pt_eye_color,
                        "vt_snellen_bailey_lovie_left"                   =>                          $tb_scratch[0]->vt_snellen_bailey_lovie_left,
                        "vt_snellen_bailey_lovie_right"                  =>                          $tb_scratch[0]->vt_snellen_bailey_lovie_right,
                        "vt_snellen_with_correct_left"                   =>                          $tb_scratch[0]->vt_snellen_with_correct_left,
                        "vt_snellen_with_correct_right"                  =>                          $tb_scratch[0]->vt_snellen_with_correct_right,
                        "vt_color_blind_left"                            =>                          $tb_scratch[0]->vt_color_blind_left,
                        "vt_color_blind_right"                           =>                          $tb_scratch[0]->vt_color_blind_right,
                        "vt_glare_contrast_sensitivity_function_without_lenses_right"             => $tb_scratch[0]->vt_glare_contrast_sensitivity_function_without_lenses_right,
                        "vt_glare_contrast_sensitivity_function_without_lenses_left"              => $tb_scratch[0]->vt_glare_contrast_sensitivity_function_without_lenses_left,
                        "vt_glare_contrast_sensitivity_function_with_corretive_lenses_le"         => $tb_scratch[0]->vt_glare_contrast_sensitivity_function_with_corretive_lenses_le,
                        "vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri"         => $tb_scratch[0]->vt_glare_contrast_sensitivity_function_with_corretive_lenses_ri,
                        "vt_color_blind_test"                            =>                          $tb_scratch[0]->vt_color_blind_test,
                        "vt_any_eye_injury_disease"                      =>                          $tb_scratch[0]->vt_any_eye_injury_disease,
                        "vt_further_examination"                         =>                          $tb_scratch[0]->vt_further_examination,
                        "at_hearing_left"                                =>                          $tb_scratch[0]->at_hearing_left,
                        "at_hearing_right"                               =>                          $tb_scratch[0]->at_hearing_right,
                        "mn_epilepsy"                                    =>                          $tb_scratch[0]->mn_epilepsy,
                        "mn_last_seizure"                                =>                          $tb_scratch[0]->mn_last_seizure,
                        "mn_epilepsy_treatment"                          =>                          $tb_scratch[0]->mn_epilepsy_treatment,
                        "mn_diabetes"                                    =>                          $tb_scratch[0]->mn_diabetes,
                        "mn_diabetes_treatment"                          =>                          $tb_scratch[0]->mn_diabetes_treatment,
                        "mn_sleep_apnea"                                 =>                          $tb_scratch[0]->mn_sleep_apnea,
                        "mn_sleepapnea_treatment"                        =>                          $tb_scratch[0]->mn_sleepapnea_treatment,
                        "mn_aggressive_manic"                            =>                          $tb_scratch[0]->mn_aggressive_manic,
                        "mn_mental_treatment"                            =>                          $tb_scratch[0]->mn_mental_treatment,
                        "mn_others"                                      =>                          $tb_scratch[0]->mn_others,
                        "mn_other_treatment"                             =>                          $tb_scratch[0]->mn_other_treatment,
                        "mn_other_medical_condition"                     =>                          $tb_scratch[0]->mn_other_medical_condition,

                        "mn_diabetes_remarks"                            =>                          $tb_scratch[0]->mn_diabetes_remarks,
                        "mn_epilepsy_remarks"                            =>                          $tb_scratch[0]->mn_epilepsy_remarks,
                        "mn_sleep_apnea_remarks"                         =>                          $tb_scratch[0]->mn_sleep_apnea_remarks,
                        "mn_aggresive_manic_remarks"                     =>                          $tb_scratch[0]->mn_aggresive_manic_remarks,
                        "mn_other_medical_condition_remarks"             =>                          $tb_scratch[0]->mn_other_medical_condition_remarks,

                        "exam_assessment"                                =>                          $tb_scratch[0]->exam_assessment,
                        "exam_assessment_remarks"                        =>                          $tb_scratch[0]->exam_assessment_remarks,
                        "exam_duration_remarks"                          =>                          $tb_scratch[0]->exam_duration_remarks,
                        "exam_conditions"                                =>                          $tb_scratch[0]->exam_conditions,
                        "pt_remarks"                                     =>                          $tb_scratch[0]->pt_remarks,
                        'lto_client_id'                                  =>                          $tb_scratch[0]->lto_client_id,
                        'encoded_by'                                     =>                          $tb_scratch[0]->encoded_by,
                        'lto_json_payload'                               =>                          $_request->api_payload,
                        'lto_json_return'                                =>                          $_request->api_response,
                        'date_exam'                                      =>                          $tb_scratch[0]->date_exam,
                        'date_uploaded'                                  =>                          $date_now,
                        'application_date'                               =>                          $tb_scratch[0]->application_date,
                        'validity_days'                                  =>                          '60 days',
                        'validity_date'                                  =>                          $medical_certificate_validity_,
                        'clinic_id'                                      =>                          $_clinic_id,
                        'clinic_name'                                    =>                          $_clinic_name,
                        'clinic_authorization'                           =>                          $_clinic_accredation_number,
                        'physician_name'                                 =>                          $_physician_name,
                        'physician_prc_no'                               =>                          $_prc_number,
                        'physician_ptr_no'                               =>                          $_ptr_number,
                        'physician_id'                                   =>                          $_physician_id,
                        'is_lto_sent'                                    =>                          1,
                        'clinic_address_full'                            =>                          $_clinic_address,
                        'reference_no'                                   =>                          $_request->certificate_number,

                      ]);
                      // $_insertToclinicTest2 = DB::table('tb_clinic_tests2')
                      //                 ->insert($_param2);

                      $_deleteScratch = DB::table('tb_clinic_tests_scratch')
                      ->where('trans_no', $_transaction_number)
                      ->delete();

                      $_updateToProgress = DB::table('tb_clinic_tests_progress')
                      ->where('trans_no', $_transaction_number)
                      ->update(['is_ltms_uploaded' => 1]);

                      $tb_clinic_balance = DB::table('tb_clinic_balance')
                      ->where('clinic_id', $_clinicId)
                      ->select('balance' )
                      ->get();

                      DB::commit();

                      Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - FINAL TRANSACTION UPLOAD','Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                      return response()->json([
                        'status' => "1",
                        'message' => "Success saving Final Data.",
                        'balance' => $tb_clinic_balance[0]->balance
                      ]);

                }
                else{

                    Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - FINAL TRANSACTION UPLOAD','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                    return response()->json([
                        'status' => "0",
                        'message' => "There was a problem in retrieving client transaction No."
                    ]);

                }

            }catch (\Throwable $th){

                DB::rollback();

                // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - FINAL TRANSACTION UPLOAD',$e->getMessage() .' Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

                return response()->json([
                  'status' => "0",
                  // 'message' => $e->getMessage()
                ]);

            }
        }
        else{

          // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - FINAL TRANSACTION UPLOAD','There was a problem in retrieving applicant transaction No. Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

          return response()->json([
              'status' => "0",
              'message' => "There was a problem in retrieving client transaction No."
          ]);

        }
    }
    else{

      // Log::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - FINAL TRANSACTION UPLOAD','Invalid Physician ID. Client Transaction Number: '.$_transaction_number,$_clinicId.'-'.$user_id,$date_created);

      return response()->json([
        'status' => "0",
        'message' => "Invalid Physician ID"
      ]);

    }

  }

}
// public function save_health_history_trans($_clinicId, Request $_request)
  // {
  //       $user_id = Session('LoggedUser')->user_id;
  //       $_date_now = DB::select("SELECT now();");
  //       $date_created = date('m/d/Y H:i:s P', strtotime($_date_now[0]->now));
  //       $trans_no =  $_request->trans_no;

  //       $_request->validate([
  //         'head_neck_spinal_injury_disorders' => 'required',
  //         'seizure_convulsions' => 'required',
  //         'dizziness_fainting' => 'required',
  //         'eye_problem' => 'required',
  //         'hearing' => 'required',
  //         'hypertension' => 'required',
  //         'heart_attack_stroke' => 'required',
  //         'lung_disease' => 'required',
  //         'hyper_acidity_ulcer' => 'required',
  //         'diabetes_' => 'required',
  //         'kidney_disease_stones_blood_in_urine' => 'required',
  //         'muscular_disease' => 'required',
  //         'sleep_disorders_sleep_apnea' => 'required',
  //         'nervous_psychiatric' => 'required',
  //         'anger_management_issues' => 'required',
  //         'involved_mv_accident_while_driving' => 'required',
  //         'any_major_illness_injury_operation' => 'required',
  //         'any_permanent_impairment' => 'required',
  //         'other_disorders' => 'required',
  //         'presently_experiencing_need_medical_attention' => 'required',
  //         'date_last_examination_physician' => 'required',
  //         'often_physician' => 'required'
  //       ]);

  //       $_clinic_id = Session('data_clinic')->clinic_id;
  //       $_clinic_name = Session('data_clinic')->clinic_name;

  //       $head_neck_spinal_injury_disorders_remarks_value;
  //       $seizure_convulsions_remarks_value;
  //       $dizziness_fainting_remarks_value;
  //       $eye_problem_remarks_value;
  //       $hearing_remarks_value;
  //       $hypertension_remarks_value;
  //       $heart_attack_stroke_remarks_value;
  //       $lung_disease_remarks_value;
  //       $hyper_acidity_ulcer_remarks_value;
  //       $diabetes_remarks_value;
  //       $kidney_disease_stones_blood_in_urine_remarks_value;
  //       $muscular_disease_remarks_value;
  //       $sleep_disorders_sleep_apnea_remarks_value;
  //       $nervous_psychiatric_remarks_value;
  //       $anger_management_issues_remarks_value;
  //       $regular_frequent_alcohol_drug_remarks_value;
  //       $involved_mv_accident_while_driving_remarks_value;
  //       $any_major_illness_injury_operation_remarks_value;
  //       $any_permanent_impairment_remarks_value;
  //       $other_disorders_remarks_value;
  //       $presently_experiencing_need_medical_attention_remarks_value;
  //       $hospitalized_last_five_years_remarks_value;

  //       if($_request->head_neck_spinal_injury_disorders == '0'){
  //         $head_neck_spinal_injury_disorders_remarks_value = '';
  //       }
  //       else{
  //         $head_neck_spinal_injury_disorders_remarks_value = $_request->head_neck_spinal_injury_disorders_remarks;
  //       }

  //       if($_request->seizure_convulsions == '0'){
  //         $seizure_convulsions_remarks_value = '';
  //       }
  //       else{
  //         $seizure_convulsions_remarks_value = $_request->seizure_convulsions_remarks;
  //       }

  //       if($_request->dizziness_fainting == '0'){
  //         $dizziness_fainting_remarks_value = '';
  //       }
  //       else{
  //         $dizziness_fainting_remarks_value = $_request->dizziness_fainting_remarks;
  //       }

  //       if($_request->eye_problem == '0'){
  //         $eye_problem_remarks_value = '';
  //       }
  //       else{
  //         $eye_problem_remarks_value = $_request->eye_problem_remarks;
  //       }

  //       if($_request->hearing == '0'){
  //         $hearing_remarks_value = '';
  //       }
  //       else{
  //         $hearing_remarks_value = $_request->hearing_remarks;
  //       }

  //       if($_request->hypertension == '0'){
  //         $hypertension_remarks_value = '';
  //       }
  //       else{
  //         $hypertension_remarks_value = $_request->hypertension_remarks_value;
  //       }

  //       if($_request->heart_attack_stroke == '0'){
  //         $heart_attack_stroke_remarks_value = '';
  //       }
  //       else{
  //         $heart_attack_stroke_remarks_value = $_request->heart_attack_stroke_remarks;
  //       }

  //       if($_request->lung_disease == '0'){
  //         $lung_disease_remarks_value = '';
  //       }
  //       else{
  //         $lung_disease_remarks_value = $_request->lung_disease_remarks;
  //       }

  //       if($_request->hyper_acidity_ulcer == '0'){
  //         $hyper_acidity_ulcer_remarks_value = '';
  //       }
  //       else{
  //         $hyper_acidity_ulcer_remarks_value = $_request->hyper_acidity_ulcer_remarks;
  //       }

  //       if($_request->diabetes_ == '0'){
  //         $diabetes_remarks_value = '';
  //       }
  //       else{
  //         $diabetes_remarks_value = $_request->diabetes_remarks_;
  //       }

  //       if($_request->kidney_disease_stones_blood_in_urine == '0'){
  //         $kidney_disease_stones_blood_in_urine_remarks_value = '';
  //       }
  //       else{
  //         $kidney_disease_stones_blood_in_urine_remarks_value = $_request->kidney_disease_stones_blood_in_urine_remarks;
  //       }

  //       if($_request->muscular_disease == '0'){
  //         $muscular_disease_remarks_value = '';
  //       }
  //       else{
  //         $muscular_disease_remarks_value = $_request->muscular_disease_remarks;
  //       }

  //       if($_request->sleep_disorders_sleep_apnea == '0'){
  //         $sleep_disorders_sleep_apnea_remarks_value = '';
  //       }
  //       else{
  //         $sleep_disorders_sleep_apnea_remarks_value = $_request->sleep_disorders_sleep_apnea_remarks;
  //       }

  //       if($_request->nervous_psychiatric == '0'){
  //         $nervous_psychiatric_remarks_value = '';
  //       }
  //       else{
  //         $nervous_psychiatric_remarks_value = $_request->nervous_psychiatric_remarks;
  //       }

  //       if($_request->anger_management_issues == '0'){
  //         $anger_management_issues_remarks_value = '';
  //       }
  //       else{
  //         $anger_management_issues_remarks_value = $_request->anger_management_issues_remarks;
  //       }

  //       if($_request->regular_frequent_alcohol_drug == '0'){
  //         $regular_frequent_alcohol_drug_remarks_value = '';
  //       }
  //       else{
  //         $regular_frequent_alcohol_drug_remarks_value = $_request->regular_frequent_alcohol_drug_remarks;
  //       }

  //       if($_request->involved_mv_accident_while_driving == '0'){
  //         $involved_mv_accident_while_driving_remarks_value = '';
  //       }
  //       else{
  //         $involved_mv_accident_while_driving_remarks_value = $_request->involved_mv_accident_while_driving_remarks;
  //       }

  //       if($_request->any_major_illness_injury_operation == '0'){
  //         $any_major_illness_injury_operation_remarks_value = '';
  //       }
  //       else{
  //         $any_major_illness_injury_operation_remarks_value = $_request->any_major_illness_injury_operation_remarks;
  //       }

  //       if($_request->any_permanent_impairment == '0'){
  //         $any_permanent_impairment_remarks_value = '';
  //       }
  //       else{
  //         $any_permanent_impairment_remarks_value = $_request->any_permanent_impairment_remarks;
  //       }

  //       if($_request->other_disorders == '0'){
  //         $other_disorders_remarks_value = '';
  //       }
  //       else{
  //         $other_disorders_remarks_value = $_request->other_disorders_remarks;
  //       }

  //       if($_request->presently_experiencing_need_medical_attention == '0'){
  //         $presently_experiencing_need_medical_attention_remarks_value = '';
  //       }
  //       else{
  //         $presently_experiencing_need_medical_attention_remarks_value = $_request->presently_experiencing_need_medical_attention_remarks;
  //       }

  //       if($_request->hospitalized_last_five_years == '0'){
  //         $hospitalized_last_five_years_remarks_value = '';
  //       }
  //       else{
  //         $hospitalized_last_five_years_remarks_value = $_request->hospitalized_last_five_years_remarks;
  //       }

  //       $_param = [
  //         "qu_head_neck_spinal_injury_disorders"=>  $_request->head_neck_spinal_injury_disorders,
  //         "qu_head_neck_spinal_injury_disorders_remarks"=> $head_neck_spinal_injury_disorders_remarks_value,
  //         "qu_seizure_convulsions"=> $_request->seizure_convulsions,
  //         "qu_seizure_convulsions_remarks"=> $seizure_convulsions_remarks_value,
  //         "qu_dizziness_fainting"=>  $_request->dizziness_fainting,
  //         "qu_dizziness_fainting_remarks"=> $dizziness_fainting_remarks_value,
  //         "qu_eye_problem"=>  $_request->eye_problem,
  //         "qu_eye_problem_remarks"=> $eye_problem_remarks_value,
  //         "qu_hearing"=>  $_request->hearing,
  //         "qu_hearing_remarks"=> $hearing_remarks_value,
  //         "qu_hypertension"=>  $_request->hypertension,
  //         "qu_hypertension_remarks"=> $hypertension_remarks_value,
  //         "qu_heart_attack_stroke"=>  $_request->heart_attack_stroke,
  //         "qu_heart_attack_stroke_remarks"=> $heart_attack_stroke_remarks_value,
  //         "qu_lung_disease"=>  $_request->lung_disease,
  //         "qu_lung_disease_remarks"=> $lung_disease_remarks_value,
  //         "qu_hyper_acidity_ulcer"=>  $_request->hyper_acidity_ulcer,
  //         "qu_hyper_acidity_ulcer_remarks"=> $hyper_acidity_ulcer_remarks_value,
  //         "qu_diabetes"=>  $_request->diabetes_,
  //         "qu_diabetes_remarks"=> $diabetes_remarks_value,
  //         "qu_kidney_disease_stones_blood_in_urine"=>  $_request->kidney_disease_stones_blood_in_urine,
  //         "qu_kidney_disease_stones_blood_in_urine_remarks"=> $kidney_disease_stones_blood_in_urine_remarks_value,
  //         "qu_muscular_disease"=>  $_request->muscular_disease,
  //         "qu_muscular_disease_remarks"=> $muscular_disease_remarks_value,
  //         "qu_sleep_disorders_sleep_apnea"=>  $_request->sleep_disorders_sleep_apnea,
  //         "qu_sleep_disorders_sleep_apnea_remarks"=> $sleep_disorders_sleep_apnea_remarks_value,
  //         "qu_nervous_psychiatric"=>  $_request->nervous_psychiatric,
  //         "qu_nervous_psychiatric_remarks"=> $nervous_psychiatric_remarks_value,
  //         "qu_anger_management_issues"=>  $_request->anger_management_issues,
  //         "qu_anger_management_issues_remarks"=> $anger_management_issues_remarks_value,
  //         "qu_regular_frequent_alcohol_drug"=>  $_request->regular_frequent_alcohol_drug,
  //         "qu_regular_frequent_alcohol_drug_remarks"=> $regular_frequent_alcohol_drug_remarks_value,
  //         "qu_involved_mv_accident_while_driving"=>  $_request->involved_mv_accident_while_driving,
  //         "qu_involved_mv_accident_while_driving_remarks"=> $involved_mv_accident_while_driving_remarks_value,
  //         "qu_any_major_illness_injury_operation"=>  $_request->any_major_illness_injury_operation,
  //         "qu_any_major_illness_injury_operation_remarks" => $any_major_illness_injury_operation_remarks_value,
  //         "qu_any_permanent_impairment" =>  $_request->any_permanent_impairment,
  //         "qu_any_permanent_impairment_remarks"=> $any_permanent_impairment_remarks_value,
  //         "qu_other_disorders" =>  $_request->other_disorders,
  //         "qu_other_disorders_remarks" => $other_disorders_remarks_value,
  //         "qu_presently_experiencing_need_medical_attention" =>$_request->presently_experiencing_need_medical_attention,
  //         "qu_presently_experiencing_need_medical_attention_remarks" => $presently_experiencing_need_medical_attention_remarks_value,
  //         "qu_hospitalized_last_five_years" => $_request->hospitalized_last_five_years,
  //         "qu_hospitalized_last_five_years_remarks" => $hospitalized_last_five_years_remarks_value,
  //         "qu_often_physician" => 1,
  //         "qu_often_physician_remarks" => $_request->often_physician,
  //         "qu_date_last_examination_physician" => 1,
  //         "qu_date_last_examination_physician_remarks" => $_request->date_last_examination_physician,
  //         "qu_date_last_confinement" => 1,
  //         "qu_date_last_confinement_remarks" => $_request->date_last_confinement
  //       ];

  //       try {
  //       DB::beginTransaction();
  //       //---update !!!
  //       $_updateToScratch2 = "";
  //       $_updateToScratch2 = DB::table('tb_clinic_tests_scratch2')
  //                       ->where('trans_no', $trans_no)
  //                       ->update($_param);
  //       if($_updateToScratch2 == true || $_updateToScratch2 == ""){
  //         $_updateToProgress = "";
  //         $_updateToProgress = DB::table('tb_clinic_tests_progress')
  //                       ->where('trans_no', $trans_no)
  //                       ->update(['test_health_history_started' => $date_created
  //                                 ,'test_health_history_completed' => 1
  //                               ]);
  //         if($_updateToProgress == true || $_updateToProgress == ""){
  //           DB::commit();
  //           Logs::LoginActionLogs('SAVED PENDING TRANSACTION',$user_id.' - Complete Health History: '.$trans_no,'-',$_clinic_id.'-'.$user_id,$date_created);
  //           return response()->json([
  //             'status' => "1",
  //             'message' => "Application Information saving successful",
  //             'trans_no' => $trans_no
  //           ]);
  //         }
  //         else{
  //           return response()->json([
  //             'status' => "0",
  //             'message' => "There was a problem in saving applicant progress."
  //           ]);
  //         }
  //       }
  //       else {
  //         return response()->json([
  //           'status' => "0",
  //           'message' => "There was a problem in saving applicant information."
  //         ]);
  //       }
  //     }
  //     catch (\Throwable $e) {
  //       DB::rollback();
  //       return response()->json([
  //         'status' => "0",
  //         'message' => $e->getMessage()
  //       ]);
  //     }

  // }

              // $_param2 = [
            //   'trans_no'=> $tb_scratch2[0]->trans_no,
            //   "qu_head_neck_spinal_injury_disorders"=>  $tb_scratch2[0]->qu_head_neck_spinal_injury_disorders,
            //   "qu_head_neck_spinal_injury_disorders_remarks"=> $tb_scratch2[0]->qu_head_neck_spinal_injury_disorders_remarks,
            //   "qu_seizure_convulsions"=> $tb_scratch2[0]->qu_seizure_convulsions,
            //   "qu_seizure_convulsions_remarks"=> $tb_scratch2[0]->qu_seizure_convulsions_remarks,
            //   "qu_dizziness_fainting"=>  $tb_scratch2[0]->qu_dizziness_fainting,
            //   "qu_dizziness_fainting_remarks"=> $tb_scratch2[0]->qu_dizziness_fainting_remarks,
            //   "qu_eye_problem"=>  $tb_scratch2[0]->qu_eye_problem,
            //   "qu_eye_problem_remarks"=> $tb_scratch2[0]->qu_eye_problem_remarks,
            //   "qu_eye_problem_remarks"=>  $tb_scratch2[0]->qu_eye_problem_remarks,
            //   "qu_hearing_remarks"=> $tb_scratch2[0]->qu_hearing_remarks,
            //   "qu_hypertension"=>  $tb_scratch2[0]->qu_hypertension,
            //   "qu_hypertension_remarks"=> $tb_scratch2[0]->qu_hypertension_remarks,
            //   "qu_heart_attack_stroke"=>  $tb_scratch2[0]->qu_heart_attack_stroke,
            //   "qu_heart_attack_stroke_remarks"=> $tb_scratch2[0]->qu_heart_attack_stroke_remarks,
            //   "qu_lung_disease"=>  $tb_scratch2[0]->qu_lung_disease,
            //   "qu_lung_disease_remarks"=> $tb_scratch2[0]->qu_lung_disease_remarks,
            //   "qu_hyper_acidity_ulcer"=>  $tb_scratch2[0]->qu_hyper_acidity_ulcer,
            //   "qu_hyper_acidity_ulcer_remarks"=> $tb_scratch2[0]->qu_hyper_acidity_ulcer_remarks,
            //   "qu_diabetes"=>  $tb_scratch2[0]->qu_diabetes,
            //   "qu_diabetes_remarks"=> $tb_scratch2[0]->qu_diabetes_remarks,
            //   "qu_kidney_disease_stones_blood_in_urine"=>  $tb_scratch2[0]->qu_kidney_disease_stones_blood_in_urine,
            //   "qu_kidney_disease_stones_blood_in_urine_remarks"=> $tb_scratch2[0]->qu_kidney_disease_stones_blood_in_urine_remarks,
            //   "qu_muscular_disease"=>  $tb_scratch2[0]->qu_muscular_disease,
            //   "qu_muscular_disease_remarks"=> $tb_scratch2[0]->qu_muscular_disease_remarks,
            //   "qu_sleep_disorders_sleep_apnea"=>  $tb_scratch2[0]->qu_sleep_disorders_sleep_apnea,
            //   "qu_sleep_disorders_sleep_apnea_remarks"=> $tb_scratch2[0]->qu_sleep_disorders_sleep_apnea_remarks,
            //   "qu_nervous_psychiatric"=>  $tb_scratch2[0]->qu_nervous_psychiatric,
            //   "qu_nervous_psychiatric_remarks"=> $tb_scratch2[0]->qu_nervous_psychiatric_remarks,
            //   "qu_anger_management_issues"=>  $tb_scratch2[0]->qu_anger_management_issues,
            //   "qu_anger_management_issues_remarks"=> $tb_scratch2[0]->qu_anger_management_issues_remarks,
            //   "qu_regular_frequent_alcohol_drug"=>  $tb_scratch2[0]->qu_regular_frequent_alcohol_drug,
            //   "qu_regular_frequent_alcohol_drug_remarks"=> $tb_scratch2[0]->qu_regular_frequent_alcohol_drug_remarks,
            //   "qu_involved_mv_accident_while_driving"=>  $tb_scratch2[0]->qu_involved_mv_accident_while_driving,
            //   "qu_involved_mv_accident_while_driving_remarks"=> $tb_scratch2[0]->qu_involved_mv_accident_while_driving_remarks,
            //   "qu_any_major_illness_injury_operation"=>  $tb_scratch2[0]->qu_any_major_illness_injury_operation,
            //   "qu_any_major_illness_injury_operation_remarks" => $tb_scratch2[0]->qu_any_major_illness_injury_operation_remarks,
            //   "qu_any_permanent_impairment" =>  $tb_scratch2[0]->qu_any_permanent_impairment,
            //   "qu_any_permanent_impairment_remarks"=> $tb_scratch2[0]->qu_any_permanent_impairment_remarks,
            //   "qu_other_disorders" =>  $tb_scratch2[0]->qu_other_disorders,
            //   "qu_other_disorders_remarks" => $tb_scratch2[0]->qu_other_disorders_remarks,
            //   "qu_presently_experiencing_need_medical_attention" => $tb_scratch2[0]->qu_presently_experiencing_need_medical_attention,
            //   "qu_presently_experiencing_need_medical_attention_remarks" => $tb_scratch2[0]->qu_presently_experiencing_need_medical_attention_remarks,
            //   "qu_hospitalized_last_five_years" => $tb_scratch2[0]->qu_hospitalized_last_five_years,
            //   "qu_hospitalized_last_five_years_remarks" => $tb_scratch2[0]->qu_hospitalized_last_five_years_remarks,
            //   "qu_often_physician" => 1,
            //   "qu_often_physician_remarks" => $tb_scratch2[0]->qu_often_physician_remarks,
            //   "qu_date_last_examination_physician" => 1,
            //   "qu_date_last_examination_physician_remarks" => $tb_scratch2[0]->qu_date_last_examination_physician_remarks,
            //   "qu_date_last_confinement" => 1,
            //   "qu_date_last_confinement_remarks" => $tb_scratch2[0]->qu_date_last_confinement_remarks,
            // ];
