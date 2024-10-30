<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewTransactionController;
use App\Http\Controllers\SavedTransactionController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdmindashboardController;
use App\Http\Controllers\loginbioController;


// Main Page Route
Route::get('/{clinic_id}/', [LoginController::class,'showLoginForm'])->name('home')->middleware('auth_check2','auth_check_browser');

Route::post('/{clinic_id}/login_user', [LoginController::class,'login_user'])->name('login_user')->middleware('auth_check2','auth_check_browser');
Route::get('/{clinic_id}/logout_user', [LoginController::class,'logout_user'])->name('logout_user');
Route::get('/{clinic_id}/balance_error', [loginbioController::class,'errror_balance'])->name('balance_error');

Route::get('/{clinic_id}/home', [loginbioController::class,'bio_login_form'])->name('bio_login_form')->middleware('auth_check2','auth_check_browser');
Route::post('/{clinic_id}/bio_login', [loginbioController::class,'bio_login'])->name('bio_login')->middleware('auth_check2','auth_check_browser');

// //admin-login
Route::get('/{clinic_id}/admin', [AdminLoginController::class,'showadminLoginForm'])->name('admin')->middleware('auth_check4','auth_check_browser');
Route::post('/{clinic_id}/login_admin', [AdminLoginController::class,'login_admin'])->name('login_admin')->middleware('auth_check4','auth_check_browser');
Route::get('/{clinic_id}/logout_admin', [AdminLoginController::class,'logout_admin'])->name('logout_admin');

// //admin dashboard
Route::group(['middleware' => ['auth_check3','auth_check_browser']], function(){
    Route::get('/{clinic_id}/admin_page', [AdmindashboardController::class,'getYearlyTransactions'])->name('admin_page');

    Route::post('/{clinic_id}/select_active_year', [AdmindashboardController::class,'select_active_year'])->name('select_active_year');
    Route::get('/{clinic_id}/getYearlyTransactions', [AdmindashboardController::class,'getYearlyTransactions'])->name('getYearlyTransactions');
    Route::post('/{clinic_id}/select_date', [AdmindashboardController::class,'select_date'])->name('select_date');

    Route::get('/{clinic_id}/fetch_admin_user_data', [AdmindashboardController::class,'fetch_admin_user_data'])->name('fetch_admin_user_data');
    Route::get('/{clinic_id}/admin_users_management', [AdmindashboardController::class,'admin_users_management'])->name('admin_users_management');

    Route::post('/{clinic_id}/admin_add_user', [AdmindashboardController::class,'admin_add_user'])->name('admin_add_user');
    Route::post('/{clinic_id}/admin_select_user', [AdmindashboardController::class,'admin_select_user'])->name('admin_select_user');
    Route::post('/{clinic_id}/admin_edit_user', [AdmindashboardController::class,'admin_edit_user'])->name('admin_edit_user');

    Route::get('/{clinic_id}/admin_account_setting', [AdmindashboardController::class,'admin_account_setting'])->name('admin_account_setting');
    Route::post('/{clinic_id}/admin_account_setting_edit', [AdmindashboardController::class,'admin_account_setting_edit'])->name('admin_account_setting_edit');
    Route::post('/{clinic_id}/admin_password_edit', [AdmindashboardController::class,'admin_password_edit'])->name('admin_password_edit');

    Route::get('/{clinic_id}/fetch_admin_summary_reportsby_date,{date_from},{date_to},{status}', [AdmindashboardController::class,'fetch_admin_summary_reportsby_date'])->name('fetch_admin_summary_reportsby_date');
    Route::get('/{clinic_id}/fetch_admin_summary_reports', [AdmindashboardController::class,'fetch_admin_summary_reports'])->name('fetch_admin_summary_reports');
    Route::get('/{clinic_id}/admin_summary_reports', [AdmindashboardController::class,'admin_summary_reports'])->name('admin_summary_reports');
    Route::get('/{clinic_id}/admin_summary_reportsby_date,{date_from},{date_to},{status}', [AdmindashboardController::class,'admin_summary_reportsby_date'])->name('admin_summary_reportsby_date');
    Route::get('/{clinic_id}/export_admin_summary_reports,{date_from},{date_to},{status}', [AdmindashboardController::class,'export_admin_summary_reports'])->name('export_admin_summary_reports');
    Route::get('/{clinic_id}/admin_certificate_list', [AdmindashboardController::class,'admin_certificate_list'])->name('admin_certificate_list');
    Route::get('/{clinic_id}/admin_certificate_list_by_date,{date_from},{date_to}', [AdmindashboardController::class,'admin_certificate_list_by_date'])->name('admin_certificate_list_by_date');
    Route::get('/{clinic_id}/admin_preview_upload_user,{trans_no}', [AdmindashboardController::class,'admin_preview_upload_user'])->name('admin_preview_upload_user');
    Route::get('/{clinic_id}/admin_generate_cert,{trans_no}', [AdmindashboardController::class,'admin_generate_cert'])->name('admin_generate_cert');

    Route::get('/{clinic_id}/fetch_admin_generate_logs', [AdmindashboardController::class,'fetch_admin_generate_logs'])->name('fetch_admin_generate_logs');
    Route::get('/{clinic_id}/admin_generate_logs', [AdmindashboardController::class,'admin_generate_logs'])->name('admin_generate_logs');
    Route::get('/{clinic_id}/export_admin_generate_logs_by_date,{date_from},{date_to},{module}', [AdmindashboardController::class,'export_admin_generate_logs_by_date'])->name('export_admin_generate_logs_by_date');
    Route::get('/{clinic_id}/admin_generate_logs_by_date,{date_from},{date_to},{module}', [AdmindashboardController::class,'admin_generate_logs_by_date'])->name('admin_generate_logs_by_date');
    Route::get('/{clinic_id}/fetch_admin_generate_logs_by_date,{date_from},{date_to},{module}', [AdmindashboardController::class,'fetch_admin_generate_logs_by_date'])->name('fetch_admin_generate_logs_by_date');
});

Route::group(['middleware' => ['auth_check','auth_check_browser']], function() {
    //dashboard
    //Route::get('/{clinic_id}/main_page', [OtherController::class,'main_page'])->name('main_page');

    //Route::post('/{clinic_id}/select_active_year', [OtherController::class,'select_active_year'])->name('select_active_year');
    //Route::post('/{clinic_id}/select_date', [OtherController::class,'select_date'])->name('select_date');

     Route::get('/{clinic_id}/TranasctionNumberGenerator', [NewTransactionController::class,'TranasctionNumberGenerator'])->name('TranasctionNumberGenerator');

    //new transaction
    Route::get('/{clinic_id}/fetch_data', [NewTransactionController::class,'fetch_data'])->name('fetch_data');
    // Route::get('/{clinic_id}/main_page', [NewTransactionController::class,'main_page'])->name('main_page');
    Route::get('/{clinic_id}/new_trans', [NewTransactionController::class,'new_trans'])->name('new_trans');
    Route::get('/{clinic}/age/{birthday}', [NewTransactionController::class,'age'])->name('age');
    Route::get('/{clinic}/bmi', [NewTransactionController::class,'bmi'])->name('bmi');
    Route::post('/{clinic_id}/check_client_record', [NewTransactionController::class,'check_client_record'])->name('check_client_record');
    Route::post('/{clinic_id}/new_trans_next', [NewTransactionController::class,'new_trans_next'])->name('new_trans_next');
    Route::post('/{clinic_id}/physical_exam_next', [NewTransactionController::class,'physical_exam_next'])->name('physical_exam_next');
    Route::post('/{clinic_id}/visual_hearing_exam_next', [NewTransactionController::class,'visual_hearing_exam_next'])->name('visual_hearing_exam_next');
    Route::post('/{clinic_id}/metabolic_neurological_exam_next', [NewTransactionController::class,'metabolic_neurological_exam_next'])->name('metabolic_neurological_exam_next');
    Route::post('/{clinic_id}/medical_history_next', [NewTransactionController::class,'medical_history_next'])->name('medical_history_next');
    Route::post('/{clinic_id}/assessment_condition_final', [NewTransactionController::class,'assessment_condition_final'])->name('assessment_condition_final');
    Route::post('/{clinic_id}/Preview', [NewTransactionController::class,'Preview'])->name('Preview');
    Route::get('/{clinic_id}/GetNewCertData,{trans_no}', [NewTransactionController::class,'GetNewCertData'])->name('GetNewCertData');
    Route::post('/{clinic_id}/new_transaction_upload', [NewTransactionController::class,'new_transaction_upload'])->name('new_transaction_upload');
    Route::post('/{clinic_id}/verify_biometrics', [NewTransactionController::class,'verify_biometrics'])->name('verify_biometrics');


    // save transaction
    Route::get('/{clinic_id}/fetch_user_data/{date_from},{date_to}', [SavedTransactionController::class,'fetch_by_date'])->name('fetch_by_date');
    Route::get('/{clinic_id}/fetch_user_data', [SavedTransactionController::class,'fetch_user_data'])->name('fetch_user_data');
    Route::get('/{clinic_id}/main_page', [SavedTransactionController::class,'get_save_client_data'])->name('main_page');
    Route::get('/{clinic_id}/get_save_client_data_bydate,{date_from},{date_to}', [SavedTransactionController::class,'get_save_client_data_bydate'])->name('get_save_client_data_bydate');
    Route::get('/{clinic_id}/continue_saved_data,{data}', [SavedTransactionController::class,'continue_saved_data'])->name('continue_saved_data');
    Route::post('/{clinic_id}/get_client_data', [SavedTransactionController::class,'get_client_data'])->name('get_client_data');
    Route::post('/{clinic_id}/save_trans_next', [SavedTransactionController::class,'save_trans_next'])->name('save_trans_next');
    Route::post('/{clinic_id}/save_physical_trans', [SavedTransactionController::class,'save_physical_trans'])->name('save_physical_trans');
    Route::post('/{clinic_id}/save_visual_hearing_trans', [SavedTransactionController::class,'save_visual_hearing_trans'])->name('save_visual_hearing_trans');
    Route::post('/{clinic_id}/save_metabolic_neurological_trans', [SavedTransactionController::class,'save_metabolic_neurological_trans'])->name('save_metabolic_neurological_trans');
    Route::post('/{clinic_id}/save_health_history_trans', [SavedTransactionController::class,'save_health_history_trans'])->name('save_health_history_trans');
    Route::post('/{clinic_id}/save_assessment_condition_trans', [SavedTransactionController::class,'save_assessment_condition_trans'])->name('save_assessment_condition_trans');
    Route::get('/{clinic_id}/view_saved_data,{data}', [SavedTransactionController::class,'view_saved_data'])->name('view_saved_data');
    Route::get('/{clinic_id}/save_get_new_cert_data,{trans_no}', [SavedTransactionController::class,'save_get_new_cert_data'])->name('save_get_new_cert_data');
    Route::get('/{clinic_id}/save_check_new_cert_printed_date,{trans_no}', [SavedTransactionController::class,'save_check_new_cert_printed_date'])->name('save_check_new_cert_printed_date');
    Route::post('/{clinic_id}/save_transaction_upload', [SavedTransactionController::class,'save_transaction_upload'])->name('save_transaction_upload');
    Route::post('/{clinic_id}/save_verify_biometrics', [SavedTransactionController::class,'save_verify_biometrics'])->name('save_verify_biometrics');

    //physician account setting
    Route::get('/{clinic_id}/physician_account_setting', [NewTransactionController::class,'physician_account_setting'])->name('physician_account_setting');
    Route::post('/{clinic_id}/physician_account_setting_edit', [NewTransactionController::class,'physician_account_setting_edit'])->name('physician_account_setting_edit');
    Route::post('/{clinic_id}/physician_password_edit', [NewTransactionController::class,'physician_password_edit'])->name('physician_password_edit');

    // Auth::routes(['verify' => true]);
  });
