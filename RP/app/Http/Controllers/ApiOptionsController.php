<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\JsonResponse;


class ApiOptionsController extends Controller
{
    function options(Request $request): JsonResponse
    {
        $saved_data = array();
        $shift_month = array();

        $date = $request->date;
        $id_user = $request->id;
        $fromFetch = "--:--";
        $toFetch = "--:--";

        $d = "";

            $d = $date;

            $fetch_count = DB::select("SELECT COUNT(*) as count FROM time_options WHERE id='$id_user' AND saved_at='$d' ");
            if ($fetch_count[0]->count > 0) {
                $fetch = DB::select(" SELECT * FROM time_options WHERE id='$id_user' AND saved_at='$d' ");
                foreach ($fetch as $result) {

                    $fromFetch =  substr($result->opt_from, 0, -3);
                    $toFetch =  substr($result->opt_to, 0, -3);
              
                }
            } 
          
            return response()->json(
                [
                    "status" => "success",    
                    "from" =>  $fromFetch,
                    "to" =>  $toFetch,
                    "message" => "Successfull transfer",
                ],
            200
            );

        
    
    }

    function optionsSave(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $date = $request->date;
        $id = $request->id;
        $time = time();
        /**
         * source: https://stackoverflow.com/questions/5563020/php-regex-to-validate-time
         * - formatnovani casu
         */
        if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $from) && !preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $to)){
            DB::delete("DELETE FROM time_options WHERE saved_at = '$date' AND id = $id");


        }else if ((preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $from) && !preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $to)) || (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $from) && !preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $to)) || (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $from) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $to))) { /*not allowing empty values and the row which has been removed.*/
            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $from)){
                $from = "00:00";
            }
            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $to)){
                $to = "00:00";
            }

            $check_unique_row = DB::select("SELECT COUNT(*) AS count FROM time_options WHERE saved_at = '$date' AND id='$id' ");
            if ($check_unique_row[0]->count == 0) {

                DB::insert("INSERT INTO time_options (id, saved_at, opt_from, opt_to, timestamp_update) VALUES ($id,'$date','$from','$to','$time')");


            } else {
            
                DB::update("UPDATE time_options SET opt_from='$from', opt_to='$to' ,timestamp_update='$time' WHERE saved_at='$date' AND id='$id'");

            }
        }
    }
    function workDay(Request $request): JsonResponse
    {
        $date = $request->date;
        $id = $request->id;
        $month_shift = DB::select("SELECT * FROM shift_active_data WHERE shift_active_data.saved_at='$date' AND shift_active_data.id='$id' ");

        foreach ($month_shift as $result_shift) {
            return response()->json(
                [
                    "status" => "success",    
                    "message" => "Successfull transfer",
                ],
            200
            );
        }
        return response()->json(
            [
                "status" => "success",    
                "message" => "Successfull transfer",
            ],
        400
        );
    }

}

?>