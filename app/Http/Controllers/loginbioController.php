<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;



class loginbioController extends Controller
{
    public function bio_login($_clinicId, Request $_request){

        $_request->validate([
            'physician_user_id' => 'required',
          ]);

        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

        $_clinic_accredation_number = Session('data_clinic')->lto_authorization_no;
        $physician_name = $_request->physician_user_id;


        $_selectLoginCredential = DB::table('tb_users')
        ->select('full_name','clinic_id','user_type','password','expiration','gender','user_id')
        ->where('full_name', '=', $physician_name)
        ->where('clinic_id', '=', $_clinicId)
        ->where('is_active', '=', 1)
        ->get();

        $_selectphysiciandetail = DB::table('tb_physicians')
        ->select('user_id',
            'physician_id',
            'clinic_id',
            'full_name',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'birthday',
            'prc_no',
            'ptr_no',
            'contact_no',
            'email_address',
            'digital_signature',
            'is_active',
            'prc_expiration',
            'password',
            DB::raw("encode(pic1, 'escape') as pic1"))
        ->where('full_name', '=', $physician_name)
        ->where('clinic_id', '=', $_clinicId)
        ->get();

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
        $biometricsData_ = str_replace(' ', '', $biometricsData);
        // decrypted String
        $decrypted = openssl_decrypt(base64_decode($biometricsData), $method, $password, OPENSSL_RAW_DATA, $iv);
        $biometrics_data = json_decode($decrypted)->finger_bmp;

        $payloadParameter = [
            "first_name" => '',
            "last_name"=> '',
            "middle_name" => '',
            "address" => '',
            "date_of_birth"=> '',
            "gender"=> '',
            "nationality"=> '',
            "civil_status"=> '',
            "height"=> '',
            "weight"=> '',
            "purpose"=> '',
            "license_no"=> '',
            "condition"=> '',
            "assessment"=> '',
            "assessment_status" => '',
            "medical_exam_date"=> '',
            "client_application_date"=> '',
            "itpcode"=> '',
            "reference_no" => '',
            "physician_prc_license_no" => '',
            "occupation" => '',
            "applicant_photo" => '',
            "blood_pressure" => '',
            "disability" => '',
            "disease" => '',
            "snellen_bailey_lovie_left" => '',
            "snellen_bailey_lovie_right" => '',
            "corrective_lens_left" => '',
            "corrective_lens_right" => '',
            "color_blind_left" => '',
            "color_blind_right" => '',
            "hearing_left" => '',
            "hearing_right" => '',
            "upper_extremities_left" => '',
            "upper_extremities_right" => '',
            "lower_extremities_left"  => '',
            "lower_extremities_right" => '',
            "diabetes" => '',
            "diabetes_treatment" => '',
            "epilepsy" => '',
            "epilepsy_treatment" => '',
            "last_seizure" => '',
            "sleepapnea" => '',
            "sleepapnea_treatment" => '',
            "mental" => '',
            "mental_treatment" => '',
            "other" => '',
            "other_treatment" => '',
            "other_medical_condition" => '',
            "temporary_duration" => "60 days",
            "remarks" => '',
            "medical_certificate_validity" => '',
            "eye_color" => '',
            "blood_type" =>  ''
        ];

        if(count($_selectphysiciandetail) > 0){

            $upload_details = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://clinic.api.qa.lto.direct/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results',[
            "physician_username" => $_selectphysiciandetail[0]->physician_id ,
            "physician_biometrics"=> [$biometrics_data],
            "lto_accreditation_no" => $_clinic_accredation_number,
                  "Exam_Datas" => [(
                          $payloadParameter
                    )]
            ]);
            $header_response = $upload_details->headers();
            $processupload_details_return = json_decode($upload_details->getBody()->getContents());
            $tb_clinic_balance = DB::table('tb_clinic_balance')
            ->where('clinic_id', $_clinicId)
            ->select(
              'transmission_fee',
              'balance',
              'account_type',
              'max_credit')
            ->get();

            if($tb_clinic_balance[0]->balance <= -10000.00){
                return response()->json([
                    'status' => "2",
                    'message' => "Insufficient Balance"
                ]);
            }
            else{
                if($header_response['error_message'][0] == "ORA-20003: Fingerprint does not match with the physician username. Record is not inserted."){
                    return response()->json([
                       'status' => "0",
                       'message' => "Fingerprint does not match"
                   ]);
               }
               else if($header_response['error_message'][0] == "ORA-20001: Accreditation Number does not match with the physician username. Record is not inserted."){
                   return response()->json([
                       'status' => "0",
                       'message' => "Clinic Accreditation Number does not match with the physician"
                   ]);
               }
               else{
                   $saveLogs = Logs::LoginActionLogs('USER LOGIN',$_selectLoginCredential[0]->user_id.' - Login Success','-',$_clinicId.'-'.$_selectLoginCredential[0]->user_id,$_newDateTime);
                   $_request->Session()->put('LoggedUser', $_selectphysiciandetail[0]);
                   $saveLogs;
                    return response()->json([
                        'status' => "1",
                        'message' => "Login Successful",
                        'balance' => $tb_clinic_balance[0]->balance
                    ]);

               }
            }


        }
        else{
            return response()->json([
                'status' => "0",
                'message' => "Physician does not exist"
                ]);
        }
    }

    public function bio_login_form($_clinicId, Request $_request){

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

        $_selectphysiciandetail = DB::table('tb_physicians')
        ->select('full_name',)
        ->where('clinic_id', '=', $_clinicId)
        ->get();

        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];


        if($_selectClinicDetails->count() > 0){
            $_request->Session()->put('data_clinic', $_selectClinicDetails[0]);
            return view('bio_login', [
                'pageConfigs' => $pageConfigs,
                'data' => $_selectphysiciandetail
            ]);
        }else {
            return view('content/miscellaneous/error', [
                'pageConfigs' => $pageConfigs
            ])->with('fail',"Clinic Id not found");
        }

    }
    
    public function errror_balance($_clinicId, Request $_request){

        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        if(session()->has('LoggedUser')){
            $user_id = Session('LoggedUser')->user_id;
            Logs::LoginActionLogs('USER LOGOUT',$user_id.' - Logout Success','-',$_clinicId.'-'.$user_id,$_newDateTime);
            Auth::logout();
            $_request->session()->forget('LoggedUser');
        }

        return view('content/miscellaneous/error_balance', [
            'pageConfigs' => $pageConfigs
        ])->with('fail',"Insufficient Balance");

    }
}
