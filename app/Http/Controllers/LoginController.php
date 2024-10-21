<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
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


class LoginController extends Controller
{

    public function showLoginForm($_clinicId, Request $_request){
      $pageConfigs = [
       'myLayout' => 'blank'
    ];
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

            // $pageConfigs = [
            //     'bodyClass' => "bg-full-screen-image",
            //     'blankPage' => true
            // ];

            if($_selectClinicDetails->count() > 0){
                $_request->Session()->put('data_clinic', $_selectClinicDetails[0]);

                return view('login', [
                    'pageConfigs' => $pageConfigs
                ]);
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

    public function login_user($_clinicId, Request $_request){
        try {
                $_dateNow = DB::select("SELECT now();");
                $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");

                $_request->validate([
                    'user_id' => 'required|string|',
                    'password' => 'required|string|min:5|'
                ]);

                $_userId = $_request->user_id;
                $_password = $_request->password;
                $_enc_password = hash("sha512", $_password);

                $_selectLoginCredential = DB::table('tb_users')
                ->select('full_name',
                'clinic_id',
                'user_type',
                'password',
                'expiration',
                'gender',
                'user_id',
                )
                ->where('user_id', '=', $_userId)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();


                if ($_selectLoginCredential->count() > 0) {
                    if ($_selectLoginCredential[0]->password == $_enc_password) {

                        $_dateToday = date_format(date_create($_dateNow[0]->now), "Y-m-d");
                        $_dateaccountExpiration = date_format(date_create($_selectLoginCredential[0]->expiration), "Y-m-d");

                        if(strtotime($_dateaccountExpiration) <= strtotime($_dateToday)){

                            return back()->with('fail',"Account Expired");
                        }
                        else{

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
                                DB::raw("encode(pic1, 'escape') as pic1"),
                                DB::raw("encode(pic2, 'escape') as pic2"),
                                DB::raw("encode(pic3, 'escape') as pic3"),
                                DB::raw("encode(pic4, 'escape') as pic4"),
                                DB::raw("encode(pic5, 'escape') as pic5"))
                            ->where('user_id', '=', $_selectLoginCredential[0]->user_id)
                            ->where('full_name', '=', $_selectLoginCredential[0]->full_name)
                            ->where('clinic_id', '=', $_selectLoginCredential[0]->clinic_id)
                            ->where('gender', '=', $_selectLoginCredential[0]->gender)
                            ->get();

                            if($_selectphysiciandetail->count() > 0){

                                $_request->Session()->put('LoggedUser', $_selectphysiciandetail[0]);
                                // dd($_selectphysiciandetail);

                                // Logs::LoginActionLogs('USER LOGIN',$_selectLoginCredential[0]->user_id.' - Login Success','-',$_clinicId.'-'.$_selectLoginCredential[0]->user_id,$_newDateTime);

                                //return redirect(route('main_page', $_clinicId))->with('info','Login Successful');
                                return redirect(route('new_trans', $_clinicId))->with('info','Login Successful');

                                // return Session('LoggedUser');
                            }
                            else{
                                return back()->with('fail',"Physician account not found");
                            }
                        }
                    }
                    else {
                        return back()->with('fail',"Password Incorrect");
                    }
                }
                else {
                    return back()->with('fail',"User Id not found");
                }

            }
            catch (\Exception $e) {
                return back()->with('fail',$e->getMessage());
            }

    }

    public function logout_user($_clinicId, Request $_request){
        $_dateNow = DB::select("SELECT now();");
        $_newDateTime = date_format(date_create($_dateNow[0]->now), "Y-m-d H:i:s P");
        $user_id = Session('LoggedUser')->user_id;

        try {
            Auth::logout();

            // $_save_logs = Functions::activity_logs(
            //     'LOGOUT',
            //     'Admin Logout',
            //     '',
            //     Session('LoggedUser')->email,
            //     gethostname(),
            //     date('Y-m-d H:i:s')
            // );

            // if ($_save_logs['status'] == 0) {
            //     return back()->with('fail',$_save_logs['message']);
            // }
            // Logs::LoginActionLogs('USER LOGOUT',$user_id.' - Logout Success','-',$_clinicId.'-'.$user_id,$_newDateTime);

            $_request->session()->forget('LoggedUser');

            return redirect(route('login',$_clinicId))->with('info','Successfully Logged out');
        }
        catch (\Throwable $th) {
            return back()->with('fail',$th->getMessage());
        }
    }
}
