<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

class AdminLoginController extends Controller
{
    public function showadminLoginForm($_clinicId, Request $_request){
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
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
            //dd($_apiUrl, $_selectClinicDetails);

            if($_selectClinicDetails->count() > 0){
                $_request->Session()->put('data_clinic', $_selectClinicDetails[0]);

                return view('adminlogin', [
                    'pageConfigs' => $pageConfigs
                ]);
            }else {
                return view('content/miscellaneous/error', [
                    'pageConfigs' => $pageConfigs
                ])->with('fail',"Clinic Id not found");
            }
        } catch (\Exception $e) {
            return view('content/miscellaneous/error', [
                // 'pageConfigs' => $pageConfigs
            ])->with('fail', $e->getMessage());
        }
    }

    public function login_admin($_clinicId, Request $_request){
        try {
          // dd($_request);
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
                ->select('full_name'
                        ,'first_name'
                        ,'middle_name'
                        ,'last_name'
                        ,'clinic_id'
                        ,'user_type'
                        ,'password'
                        ,'expiration'
                        ,'gender'
                        ,'user_id'
                        ,'is_active'
                        ,DB::raw("encode(pic1, 'escape') as pic1"))
                ->where('user_id', '=', $_userId)
                ->where('clinic_id', '=', $_clinicId)
                ->where('is_active', '=', 1)
                ->get();

                // dd($_selectLoginCredential);
                if ($_selectLoginCredential->count() > 0) {

                    if($_selectLoginCredential[0]->clinic_id == $_clinicId){

                        if ($_selectLoginCredential[0]->password == $_enc_password) {
                          $_dateToday = date_format(date_create($_dateNow[0]->now), "Y-m-d");
                          $_dateaccountExpiration = date_format(date_create($_selectLoginCredential[0]->expiration), "Y-m-d");

                          if(strtotime($_dateaccountExpiration) <= strtotime($_dateToday)){
                              dd(strtotime($_dateaccountExpiration) <= strtotime($_dateToday));
                            return back()->with('fail',"Account Expired");
                            }
                               if($_selectLoginCredential[0]->user_type != 'Administrator'){
                                    return back()->with('fail',"Invalid Administrator Account");
                               }

                                   $_request->Session()->put('UserLoggedInfo', $_selectLoginCredential[0]);

                                    return redirect(route('admin_page', $_clinicId))->with('info','Login Successful');
                        }
                        else {

                            return back()->with('fail',"Password Incorrect");
                        }
                    }
                    else{
                        return back()->with('fail','Invalid User Clinic Id');
                    }

                }
                else {
                    return back()->with('fail',"User Id not found in Clinic Id - ".$_clinicId);
                }

            }
            catch (\Exception $e) {
                return back()->with('fail',$e->getMessage());
            }

    }

    public function admin_page($_clinicId, Request $_request)
    {

        $_selectLoginCredential = DB::table('tb_users')
        ->select('user_id')
        ->where('user_id', '=', Session('UserLoggedInfo')->user_id)
        ->where('clinic_id', '=', $_clinicId)
        ->where('is_active', '=', 1)
        ->get();

        if($_selectLoginCredential->count() > 0){
            $pageConfigs = ['pageHeader' => true];
            return view('admin_page', ['pageConfigs' => $pageConfigs]);
        }
        else{
            return redirect(route('logout_user',$_clinicId))->with('info','User Id and Clinic Id does not match');
        }

    }

    public function logout_admin($_clinicId, Request $_request){
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

            $_request->session()->forget('Loggedadmin');
            $_request->session()->forget('active_year');
            $_request->session()->forget('select_date');
            $_request->session()->forget('UserLoggedInfo');
            return redirect(route('admin',$_clinicId))->with('info','Successfully Logged out');
        }
        catch (\Throwable $th) {
            return back()->with('fail',$th->getMessage());
        }
    }
}
