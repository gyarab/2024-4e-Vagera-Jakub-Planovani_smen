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
use Illuminate\Http\JsonResponse;


class ApiStatisticsController extends Controller
{
    public function yearlyStats(Request $request)
    {

        $Year = $request->input('year');
        $Id = Auth::id();
        $count = 0;
        $time = 0;
        $amount_arr = array();
        $status_arr = array();

        for ($m = 1; $m < 13; $m++) {
            for ($i = 1; $i < 32; $i++) {

                if (checkdate($m, $i, $Year) == true) {
                    $count++;
                    if ($i < 10) {
                        $Day = "0" . $i;
                    } else {
                        $Day = $i;
                    }
                    if ($m < 10) {
                        $Month = "0" . $m;
                    } else {
                        $Month = $m;
                    }
                    $fullDate = $Year . "-" . $Month . "-" . $Day;
                    $amount = 0;
                    $status = 0;
                    $time = 0;

                    $fetch_stats = DB::select("SELECT * FROM attendance WHERE id='$Id' AND saved_at='$fullDate'  ");
                    foreach ($fetch_stats as $result) {
                        if ($result->log_to == null) {
                            $status = 1;
                        } else {
                            $time = 0;
                            $log_from = $result->log_from;
                            $log_to = $result->log_to;
                            $plan_from = $result->planned_from;
                            $plan_to = $result->planned_to;
                            $delay_arr = $result->delay_arr;
                            $delay_dep = $result->delay_dep;
                            if (strtotime($log_from) < strtotime($plan_from) && $delay_arr == 0) {
                                if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 0) {
                                    $time = $time + strtotime($log_to) - strtotime($log_from);

                                } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                                    $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                                } else if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 1) {
                                    $time = 86400 + strtotime($log_to) - strtotime($log_from);
                                } else {
                                    $time = $time;
                                }

                            } else {
                                if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null) {
                                    $time = $time + strtotime($log_to) - strtotime($log_from);
                                } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                                    $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                                } else {
                                    $time = $time;
                                }
                            }
                     
                            $amount = $time;
                        }
                    }
                    array_push($amount_arr, $amount);
                    array_push($status_arr, $status);
                }
            }
        }

        return response()->json(['amount' => $amount_arr, 'status' => $status_arr, 'count' => $count]);


    }
    public function weekStats(Request $request): JsonResponse
    {
        $Id = Auth::id();
        $amount_arr = array();
        $monday = date('Y-m-d', strtotime('monday this week'));
        for ($m = 0; $m < 7; $m++) {
            $new_date = date('Y-m-d', strtotime($monday . ' +' . $m . ' day'));
            $amount = 0;
            $status = 0;
            $time = 0;

            $fetch_stats = DB::select("SELECT * FROM attendance WHERE id='$Id' AND saved_at='$new_date'  ");
            foreach ($fetch_stats as $result) {
                if ($result->log_to == null) {
                    $status = 1;
                } else {
                    $time = 0;
                    $log_from = $result->log_from;
                    $log_to = $result->log_to;
                    $plan_from = $result->planned_from;
                    $plan_to = $result->planned_to;
                    $delay_arr = $result->delay_arr;
                    $delay_dep = $result->delay_dep;
                    if (strtotime($log_from) < strtotime($plan_from) && $delay_arr == 0) {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 0) {
                            $time = $time + strtotime($log_to) - strtotime($log_from);

                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                        } else if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 1) {
                            $time = 86400 + strtotime($log_to) - strtotime($log_from);
                        } else {
                            $time = $time;
                        }

                    } else {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) - strtotime($log_from);
                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                        } else {
                            $time = $time;
                        }
                    }
              
                    $amount = $time;
                }
            }
            array_push($amount_arr, $amount);

        }
        return response()->json(['amount' => $amount_arr]);

    }
    public function myStatsTable(Request $request): JsonResponse
    {


        $saved_data = array();
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Id = Auth::id();
        $scheduleTotal = 0;
        $logTotal = 0;

        $id_object = array();
        $object_name = array();
        $superior_object_id = array();
        $icons = array();
        $search_object = [];
        $search_icon = [];
        error_log($Year . ' - '. $Month. " - ". $Id);
        $fetch_object_count = DB::select("SELECT COUNT(*) AS count FROM object_model ");

        $fetch_object = DB::select("SELECT * FROM object_model ");

        if ($fetch_object_count[0]->count > 0) {
            /**Sorting data alphabetically */
            foreach ($fetch_object as $rows_dat) {

                $id_object[] = $rows_dat->id_object;
                $object_name[] = $rows_dat->object_name;
                $superior_object_id[] = $rows_dat->superior_object_id;
                $icons[] = $rows_dat->object_icon;

            }
            array_multisort($id_object, $object_name, $superior_object_id, $icons);
        }
        $jsonArray = [];
        $count = 0;
        $time = 0;
        $first = 0;
        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        for ($i = 1; $i < 32; $i++) {
            $time = 0;
            $first = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }

            $Date = $Year . "-" . $Month . "-" . $Day;
            $fetch_attendace_count = DB::select("SELECT COUNT(*) AS count FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift");
            $fetch_attendace = DB::select("SELECT *, object_model.id_object AS obj FROM attendance, shift_model, object_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object ");

            if ($fetch_attendace_count[0]->count == 0) {

            } else {

                foreach ($fetch_attendace as $rows) {
                    $time = 0;
                    $time_row = 0;
                    $first_row = 0;
                    $first = 0;
                    $not_unlog = "";
                    $log_from = $rows->log_from;
                    $log_to = $rows->log_to;
                    $plan_from = $rows->planned_from;
                    $plan_to = $rows->planned_to;
                    $delay_arr = $rows->delay_arr;
                    $delay_dep = $rows->delay_dep;
                    $name = $rows->shift_name;
                    $color = $rows->color;
                    if (strtotime($log_from) < strtotime($plan_from) && $delay_arr == 0) {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 0) {
                            $time = round(($time + strtotime($log_to) - strtotime($log_from)) / 3600, 3);
                            $time_row = ($time + strtotime($log_to) - strtotime($log_from)) % 3600;

                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = round(($time + strtotime($log_to) + 86400 - strtotime($log_from)) / 3600, 3);
                            $time_row = ($time + strtotime($log_to) + 86400 - strtotime($log_from)) % 3600;
                        } else if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 1) {
                            $time = round((86400 + strtotime($log_to) - strtotime($log_from)) / 3600, 3);
                            $time_row = (86400 + strtotime($log_to) - strtotime($log_from)) % 3600;
                        } else {
                            $not_unlog = "*";
                        }

                    } else {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null) {
                            $time = round(($time + strtotime($log_to) - strtotime($log_from)) / 3600, 3);
                            $time_row = ($time + strtotime($log_to) - strtotime($log_from)) % 3600;
                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = round(($time + strtotime($log_to) + 86400 - strtotime($log_from)) / 3600, 3);
                            $time_row = ($time + strtotime($log_to) + 86400 - strtotime($log_from)) % 3600;
                        } else {
                            $not_unlog = "*";
                        }

                    }
                    if (strtotime($plan_from) < strtotime($plan_to)) {
                        $first = round((strtotime($plan_to) - strtotime($plan_from)) / 3600, 3);
                        $first_row = (strtotime($plan_to) - strtotime($plan_from)) % 3600;
                    } else {
                        $first = round((strtotime($plan_to) + 84600 - strtotime($plan_from)) / 3600, 3);
                        $first_row = (strtotime($plan_to) + 84600 - strtotime($plan_from)) % 3600;
                    }
                    $scheduleTotal = $scheduleTotal+  $first;
                    $logTotal = $logTotal +$time;
                    for ($x = 0; $x < count($id_object); $x++) {
                        if (0 == $superior_object_id[$x]) {
                            if ($rows->obj == $id_object[$x]) {
                                $search_object[0] = $object_name[$x];
                                $search_icon[0] = $icons[$x];
                                error_log($object_name[$x]);
                            }
        
                            for ($h = 0; $h < count($object_name); $h++) {
                                if ($id_object[$x] == $superior_object_id[$h]) {
                                    $main = $rows->obj;
                                    $this->getMainObject($id_object[$x], $id_object, $object_name, $superior_object_id, $search_object, $search_icon, $main, $object_name[$x], $icons[$x]);
                                    break;
                                }
                            }
                        }
                    }
                    array_push($jsonArray, [
                        "id" => $rows->id_attendance,
                        "color" => $color,
                        "date" => $Date,
                        "main" => $Date,
                        "object" => $rows->object_name,
                        "main" => $search_object[0] ?? null,
                        "scheduled" => round((int) $first) . 'h ' . ((int) ($first_row / 60)) . 'min',
                        "log" => round((int) $time) . 'h ' . ((int) ($time_row / 60)) . 'min' . $not_unlog,
                        "logInTime" => $rows->log_from,
                        "logOutTime" => $rows->log_to,
                        "shift" => $name,
                        "mainIcon" => $search_icon[0] ?? null,
                        "subIcon" => $rows->object_icon,
                    ]);
                


                    $count++;
                }
            }

        }
        return response()->json(
            [
                "status" => "success",
                "data" => $jsonArray,
                "message" => "Successfull transfer",
                "scheduleTotal" => round((int) $scheduleTotal) . 'h ' . ((int) ($scheduleTotal  * 3600 % 3600 / 60)) . 'min',
                "logTotal" => round((int) $logTotal) . 'h ' . ((int) ($logTotal  * 3600 % 3600 / 60)) . 'min',
            ],
        200
        );


    }
    public function myStats(Request $request)
    {

        $Year = $request->input('year');
        $Month = $request->input('month');
        $Id = Auth::id();
        $count = 0;
        $time = 0;
        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        for ($i = 1; $i < 32; $i++) {
            $time = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }

            $Date = $Year . "-" . $Month . "-" . $Day;
            $fetch_attendace_count = DB::select("SELECT COUNT(*) AS count FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift");
            $fetch_attendace = DB::select("SELECT * FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift ");

      
            if ($fetch_attendace_count[0]->count == 0) {
                $saved_data[$count] = 0;

                $count++;
            } else {

                foreach ($fetch_attendace as $rows) {

                    $log_from = $rows->log_from;
                    $log_to = $rows->log_to;
                    $plan_from = $rows->planned_from;
                    $plan_to = $rows->planned_to;
                    $delay_arr = $rows->delay_arr;
                    $delay_dep = $rows->delay_dep;
                    if (strtotime($log_from) < strtotime($plan_from) && $delay_arr == 0) {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 0) {
                            $time = $time + strtotime($log_to) - strtotime($log_from);

                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                        } else if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null && $delay_dep == 1) {
                            $time = 86400 + strtotime($log_to) - strtotime($log_from);
                        } else {
                            $time = $time;
                        }

                    } else {
                        if (strtotime($log_to) > strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) - strtotime($log_from);
                        } else if (strtotime($log_to) < strtotime($log_from) && strtotime($log_to) != null) {
                            $time = $time + strtotime($log_to) + 86400 - strtotime($log_from);
                        } else {
                            $time = $time;
                        }
                    }

                    $saved_data[$count] = ($time) / 3600;

                    $count++;
                }
            }

        }
        return $saved_data;
    }
    public function loadStatsComment(Request $request)
    {

        $Year = $request->input('year');
        $Month = $request->input('month');
        $Id = Auth::id();
        $is = 0;

        echo '<ul class="list-group">';
        if ($Month < 10) {
            $Month = "0" . $Month;
        }








        for ($i = 1; $i < 32; $i++) {
            $time = 0;
            $first = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }
            $Date = $Year . "-" . $Month . "-" . $Day;
            $fetch_attendance_count = DB::select("SELECT COUNT(*) AS count FROM attendance WHERE attendance.id='$Id' AND attendance.saved_at='$Date' ");
            $fetch_attendance = DB::select("SELECT * FROM attendance WHERE attendance.id='$Id' AND attendance.saved_at='$Date' ");

            if ($fetch_attendance_count[0]->count == 0) {

            } else {
                foreach ($fetch_attendance as $rows_output) {
                    $com1 = $rows_output->comment_on;
                    $com2 = $rows_output->com_from;
                    $com3 = $rows_output->com_to;
                    if ($com1 != null || $com2 != null || $com3 != null) {
                        $is = 1;
                        echo '<li id="mt-'.$rows_output->id_attendance.'" name="'.$rows_output->id_attendance.'" class="list-group-item list-group-item-action" onclick="highlight(this.id)">';
                        echo "<div class='row mt-2 mb-2 mb-md-0'>";
                        echo "<div class='col-12'>";
                        echo "<div class='row'>";
                        echo "<div class='col-12 col-md-3 align-middle'>";

                        echo "<label class='align-middle' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' >" . $Date . "</label>";
                        echo "</div>";
                        echo "<div class='col-12 col-md-3'>";
                        echo "<textarea class='form-control' disabled='true'>" . $rows_output->comment_on . "</textarea>";
                        echo "</div>";

                        echo "<div class='col-12 col-md-3'>";
                        echo "<textarea class='form-control hyphens' disabled='true'>" . $rows_output->com_from . "</textarea>";
                        echo "</div>";

                        echo "<div class='col-12 col-md-3' >";
                        echo "<textarea class='form-control hyphens' disabled='true'>" . $rows_output->com_to . "</textarea>";
                        echo "</div>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                    }
                }


            }

        }

        if ($is == 0) {
            echo "<li class='list-group-item list-group-item-action border-0'><div class='row'><div class='col-12'><h6 class='mb-0'>No data found</h6> </div></div></li>";

        }






        echo "</ul>";
        echo "<hr style='height:3px'>";
    }
    public function loadPieStats(Request $request)
    {

        $Year = $request->input('year');
        $Month = $request->input('month');
        $Object = Crypt::decrypt($request->input('object'));
        $Id = Auth::id();
        $Objects_list = array();
        $Shifts_list = array();
        $Shifts_name = array();
        $Shifts_color = array();
        $counter_arr = array();
        $counter_arr = [];
        $objects_list = array();
        $shift_ex = 0;
        $is = 0;
        $counter_arr_color = array();
        $counter_arr_count = array();
        $counter_arr_name = array();

        $fetch_object_count = DB::select("SELECT COUNT(*) AS count FROM object_model");

        $fetch_object = DB::select("SELECT * FROM object_model");

        $id_object = array();
        $object_name = array();
        $data3 = array();
        $id_superior = array();
        $saved_data = array();
        $p = 0;



        if ($fetch_object_count[0]->count > 0) {
            /**Sorting data alphabetically */
            foreach ($fetch_object as $rows_dat) {
                $id_object[] = $rows_dat->id_object;
                $object_name[] = $rows_dat->object_name;
                $id_superior[] = $rows_dat->superior_object_id;
            }
            array_multisort($id_object, $object_name, $id_superior);
        }




        if ($Month < 10) {
            $Month = "0" . $Month;
        }






        for ($x = 0; $x < count($id_object); $x++) {
            if ($id_object[$x] == $Object) {


                $search = $id_object[$x] . "";

                array_push($objects_list, $id_object[$x]);

                for ($h = 0; $h < count($id_object); $h++) {
                    if ($search == $id_superior[$h]) {
                        $this->subObjectLoad($search, $id_object, $object_name, $id_superior, $objects_list);
                        break;
                    }
                }
            }

        }


        if (count($objects_list) != 0) {
            for ($x = 0; $x < count($objects_list); $x++) {
                $fetch_shift = DB::select("SELECT * FROM shift_model WHERE id_object=$objects_list[$x]");
                foreach ($fetch_shift as $rows_shift) {

                    $shift_ex = 1;
                    array_push($Shifts_list, $rows_shift->id_shift);
                    $Shifts_name[$rows_shift->id_shift] = $rows_shift->shift_name;
                    $Shifts_color[$rows_shift->id_shift] = $rows_shift->color;
                }
            }

            if ($shift_ex == 1) {
                for ($i = 1; $i < 32; $i++) {
                    $time = 0;
                    $first = 0;
                    if ($i < 10) {
                        $Day = "0" . $i;
                    } else {
                        $Day = $i;
                    }
                    $Date = $Year . "-" . $Month . "-" . $Day;
                    $fetch_attendance_count = DB::select("SELECT COUNT(*) AS count FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift ");
                    $fetch_attendance = DB::select("SELECT *, shift_model.id_shift AS shi FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift ");

                    if ($fetch_attendance_count[0]->count == 0) {

                    } else {
                        foreach ($fetch_attendance as $rows_output) {

                            if (in_array($rows_output->shi, $Shifts_list)) {
                                if (count($counter_arr_count) != 0) {
                                    $finder = 0;
                                    for ($q = 0; $q < count($counter_arr_count); $q++) {
                                        if ($counter_arr_name == $rows_output->shi) {
                                            $counter_arr_count[$q] == ($counter_arr_count[$q] + 1);
                                            $finder++;
                                            break;
                                        }


                                    }
                                    if ($finder == 0) {
                                        array_push($counter_arr_count, 1);
                                        array_push($counter_arr_name, $rows_output->shift_name);
                                        array_push($counter_arr_color, $rows_output->color);
                                    }

                                } else {
                                    array_push($counter_arr_count, 1);
                                    array_push($counter_arr_name, $rows_output->shift_name);
                                    array_push($counter_arr_color, $rows_output->color);

                                }
                    
                            }
                        }
                    }
                }

             
            } 
        } 
        return response()->json([
            'count' => $counter_arr_count,
            'name' => $counter_arr_name,
            'color' => $counter_arr_color,
        ]);
    }

    public function loadTableLog(Request $request)
    {

        $saved_data[] = array();
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Id = Auth::id();
        $count = 0;
        $time = 0;
        $first = 0;
        $prefix = array();
        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        $fetch_object_count = DB::select("SELECT COUNT(*) AS count FROM object_model ");

        $fetch_object = DB::select("SELECT * FROM object_model ");

        if ($fetch_object_count[0]->count > 0) {
            /**Sorting data alphabetically */
            foreach ($fetch_object as $rows_dat) {

                $id_object[] = $rows_dat->id_object;
                $object_name[] = $rows_dat->object_name;
                $superior_object_id[] = $rows_dat->superior_object_id;
                $object_icon[] = $rows_dat->object_icon;

            }
            array_multisort($id_object, $object_name, $superior_object_id, $object_icon);
        }
        echo '<ul class="list-group">';

        for ($i = 1; $i < 32; $i++) {
            $time = 0;
            $first = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }

            $Date = $Year . "-" . $Month . "-" . $Day;
            $fetch_attendance_count = DB::select("SELECT COUNT(*) AS count FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift ");
            $fetch_attendance = DB::select("SELECT *, shift_model.id_shift AS shi FROM attendance, shift_model WHERE attendance.id='$Id' AND attendance.saved_at='$Date' AND attendance.id_shift=shift_model.id_shift ");

            if ($fetch_attendance_count[0]->count == 0) {

            } else {
                $prefix[0] = "";
                foreach ($fetch_attendance as $rows) {
                    $time = 0;
                    $time_row = 0;
                    $first_row = 0;
                    $first = 0;
                    $not_unlog = "";
                    $log_from = $rows->log_from;
                    $log_to = $rows->log_to;
                    $obj_id = $rows->id_object;
                    $obj_name = "";
                    $this->subTableLog($obj_id, $id_object, $object_name, $superior_object_id, $object_icon, $prefix);
                    for ($f = 0; $f < count($id_object); $f++) {
                        if ($id_object[$f] == $obj_id) {
                            $obj_name = "<i class='" . $object_icon[$f] . "'></i> " . $object_name[$f];
                            break;
                        }
                    }
                    $finalName = $prefix[0] . " - " . $obj_name;

                    echo '<li id="mt-'.$rows->id_attendance.'" name="'.$rows->id_attendance.'" class="list-group-item list-group-item-action" onclick="highlight(this.id)">';
                    echo '<div class="row">';
                    echo '<div class="col-12 col-md-3">';
                    echo '<p class="hyphens mb-0" style="overflow-wrap: break-word;">' . $Date . '</p>';
                    echo '</div>';
                    echo '<div class="col-12 col-md-3">';
                    echo '<p class="hyphens mb-0" style="overflow-wrap: break-word;">' . $finalName . '</p>';
                    echo '</div>';
                    echo '<div class="col-12 col-md-3">';
                    echo '<p class="hyphens mb-0" style="overflow-wrap: break-word;">' . $log_from . '</p>';
                    echo '</div>';
                    echo '<div class="col-12 col-md-3">';
                    echo '<p class="hyphens mb-0" style="overflow-wrap: break-word;">' . $log_to . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</li>';


                }
            }

        }
        echo "</ul>";
        echo '<hr style="height: 3px;">';
    }
    public function loadTableBreak(Request $request)
    {

        //$saved_data[] = array();
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Id = Auth::id();
        $count = 0;
        $time = 0;
        $first = 0;
        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        echo '<ul class="list-group">';

        for ($i = 1; $i < 32; $i++) {
            $time = 0;
            $first = 0;
            if ($i < 10) {
                $Day = "0" . $i;
            } else {
                $Day = $i;
            }

            $Date = $Year . "-" . $Month . "-" . $Day;
            $fetch_attendance_count = DB::select("SELECT COUNT(*) AS count FROM attendance WHERE attendance.id='$Id' AND attendance.saved_at='$Date' ");
            $fetch_attendance = DB::select("SELECT * FROM attendance WHERE attendance.id='$Id' AND attendance.saved_at='$Date' ");

            //$check_get = mysqli_query($conn, $sql);
            if ($fetch_attendance_count[0]->count == 0) {

            } else {
                 //$result = $mysqli->query($sql);
                foreach ($fetch_attendance as $rows){
                 //while ($rows = $result->fetch_assoc()) {
                     $from_arr = [];
                     $to_arr = [];
                     $not_unlog = "";


                     $pause_from = $rows->pause_from;
                     $pause_to = $rows->pause_to;
                     if ($pause_from != null) {
                         $from_arr = explode("||", $pause_from);
                         $to_arr = explode("||", $pause_to);
                         if (count($from_arr) != 0) {
                             for ($r = 0; $r < count($from_arr); $r++) {
                                echo '<li id="mt-'.$rows->id_attendance.'" name="'.$rows->id_attendance.'" class="list-group-item list-group-item-action" onclick="highlight(this.id)">';
                                 echo '<div class="row">';
                                 echo '<div class="col-12 col-md-4">';
                                 echo '<p class="mb-0">' . $Date . '</p>';
                                 echo '</div>';
                                 echo '<div class="col-12 col-md-4">';
                                 echo '<p class="mb-0">' . $from_arr[$r] . '</p>';
                                 echo '</div>';
                                 echo '<div class="col-12 col-md-4">';
                                 echo '<p class="mb-0">' . $to_arr[$r] . '</p>';
                                 echo '</div>';
                                 echo '</div>';
                                 echo '</li>';
                             }
                         }
                     }

                     $count++;
                 }
            }

        }
        echo "</ul>";
        echo '<hr style="height: 3px;">';
    }
    function floorToFraction($number, $denominator = 1)
    {
        $x = $number * $denominator;
        $x = floor($x);
        $x = $x / $denominator;
        return $x;
    }

    function subObjectLoad($searching, $dat1, $dat2, $dat4, array &$objects_list)
    {
        //global $Objects_list;
        for ($i = 0; $i < count($dat1); $i++) {
            if ($searching == $dat4[$i]) {

                $sea = $dat1[$i] . "";
                //$Objects_list[] = $dat1[$i];
                array_push($objects_list, $dat1[$i]);

                if ($sea != null) {
                    for ($h = 0; $h < count($dat1); $h++) {
                        if ($sea == $dat4[$h]) {
                            //sub_object($sea, $dat1, $dat2, $dat3, $dat4);
                            $this->subObjectLoad($sea, $dat1, $dat2, $dat4, $objects_list);
                            break;
                        }
                    }
                }

            }
        }

    }
    function subTableLog($searching, $dat1, $dat2, $dat4, $icon, array &$prefix)
    {

        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat1[$i]) {
                $sea = $dat4[$i] . "";
                if ($sea != 0) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat1[$h]) {
                            $this->subTableLog($sea, $dat1, $dat2, $dat4, $icon, $prefix);
                            break;
                        }
                    }
                } else {
                    $prefix[0] = "<i class='" . $icon[$i] . "'></i> " . $dat2[$i];
                    break;


                }


            }
        }

    }
    public function getMainObject($searching, $obj_id, $obj_name, $obj_superior, array &$search_object, array &$search_icon, $search_id, $main_name, $main_icon)
    {
        for ($i = 0; $i < count($obj_name); $i++) {
            if ($searching == $obj_superior[$i]) {
                if ($obj_id[$i] != null) {
                    error_log($main_name);
                    if ($obj_id[$i] == $search_id) {
                        $search_object[0] = $main_name;
                        $search_icon[0] = $main_icon;
                        return; // Exit the function once the search_id is found
                    }
                    for ($h = 0; $h < count($obj_name); $h++) {
                        if ($obj_id[$i] == $obj_superior[$h]) {
                            $this->getMainObject($obj_id[$i], $obj_id, $obj_name, $obj_superior, $search_object, $search_icon, $search_id, $main_name, $main_icon);
                            //return; // Exit the function once the recursive call is made
                            break;
                        }
                    }
                }
            }
        }
    }
}
?>