<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Logs extends Model
{
    public static function LoginActionLogs($module,$description,$remarks,$processed_by,$period){
        try {
            $_insertLogs = DB::table('tb_user_logs')
                ->insert([
                    'module' => $module,
                    'description' => $description,
                    'remarks' => $remarks,
                    'processed_by' => $processed_by,
                    'period' => $period,
                ]);
            if( $_insertLogs > 0){
                return "User logs saved successfully";
            }
            else{
                return "There was an error in saving user logs.";
            }
        } catch (\Exception $e) {
            return array("errorCode" => "exception", "msg" => $e->getMessage());
        }
    }
}
