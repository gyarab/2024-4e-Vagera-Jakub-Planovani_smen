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
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class StatisticsController extends Controller
{
    public function yearlyStats(Request $request)
    {

       // $saved_data[] = array();
        $Year = $request->input('year');
//$Month = $request->input('month'];
        $Id = Auth::id();
        $count = 0;
        $time = 0;
        /*if ($Month < 10) {
            $Month = "0" . $Month;
        }*/
        for ($i = 1; $i < 32; $i++) {
           for ($m = 1; $m < 13; $m++) {
            $time = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }

            //$Date = $Year. "-".$Month."-".$Day;

           // DB::select("SELECT * FROM shift_active_data, attendance WHERE (shift_active_data.id_active = attendance.id_attendance AND shift_active_data.saved_date LIKE '$Year%' AND shift_active_data.id=$Id AND shift_active_data.id_active IN (SELECT id_planned FROM attendance));");
//$sql = "SELECT * FROM shift_active_data, attendance WHERE (shift_active_data.id_saved = attendance.planned_id AND shift_active_data.saved_date='$Date' AND shift_active_data.id_user=$Id AND shift_active_data.id_saved IN (SELECT planned_id FROM attendance));";


//$check_get = mysqli_query($conn, $sql);
/*if (mysqli_num_rows($check_get) == 0) {
    $saved_data[$count] = 0;

    $count++;
}else{
//$result = $mysqli->query($sql);

while ($rows = $result->fetch_assoc()) {
    $log_from = $rows['log_from'];
    $log_to = $rows['log_to'];
    $plan_from = $rows['saved_from'];
    $plan_to = $rows['saved_to'];
    $delay_arr = $rows['delay_arr'];
    $delay_dep = $rows['delay_dep'];
    if(strtotime($log_from) <strtotime($plan_from) && $delay_arr == 0){
        if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==0  ){
            $time = $time +strtotime($log_to) - strtotime($log_from); 

        }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to)+86400 - strtotime($log_from); 
    }else if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==1){
        $time = 86400 + strtotime($log_to)-strtotime($log_from);
    }else{
        $time = $time;
    }

    }else{
    if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to) - strtotime($log_from); 
    }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to)+86400 - strtotime($log_from); 
    }else{
        $time = $time;
    }
}
    
    $saved_data[$count] = $time;

    $count++;
}
}
*/
        }
    }
        //echo json_encode($saved_data);

    }
}

?>