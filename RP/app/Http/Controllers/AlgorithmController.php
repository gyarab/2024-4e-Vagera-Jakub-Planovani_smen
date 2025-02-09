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


class AlgorithmController extends Controller
{
    public function insertCalendarData(Request $request)
    {
        $offer = array();
        $offer = [];
        $fromArr = $request->input('from');
        $toArr = $request->input('to');
        $idArr = $request->input('id_shift');
        $dateArr = $request->input('date');
        $deleteArr = $request->input('id_delete');
        $namesidArr = $request->input('namesid');
        $nameArr = $request->input('name');
        $areaArr = $request->input('area');
        $offer = $request->input('offer');
        $YM = $request->input('dateym');
        $time = time();
        //echo $fromArr[0];

        /*if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }*/

        for ($x = 0; $x < count($fromArr); $x++) {
            if (($fromArr[$x] != "")) { /*not allowing empty values and the row which has been removed.*/


                $fetch_unique_row = DB::select("SELECT COUNT(*) AS count FROM shift_planned_data WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                $check_unique = $fetch_unique_row[0]->count;
                /*foreach($fetch_unique_row as $fetch_result){
                    $qqq = 0;
                }*/
                //echo $check_unique;
                //echo "SELECT COUNT(*) AS count FROM shift_planned_data WHERE saved_at = '$dateArr[$x]' AND id_shift='$idArr[$x]'";
                //$areaArr[$x] = "1";
                /*if($areaArr[$x] == ""){
              = "NULL";
                }*/
                //$areaArr[$x] = "";
                /*if($areaArr[$x] == ""){
                    $areaArr[$x] = NULL;
                }*/
                //echo $areaArr[$x];
                if ($check_unique == 0) {
                    if ($namesidArr[$x] == "") {
                        //  echo "INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time', NULL, '$areaArr[$x]')";
                        DB::insert("INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time',NULL, '$areaArr[$x]')");
                        //echo "INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time',NULL, '$areaArr[$x]' )";
                    } else {
                        // echo "INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')";
                        DB::insert("INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");
                    }
                    // DB::insert("INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");

                    /*if (!mysqli_query($con, $sql)) {
                        die('Error: ' . mysqli_error($con));
                    }*/

                    $fetch_get_id = DB::select("SELECT * FROM shift_planned_data WHERE saved_at = '$dateArr[$x]' AND id_shift='$idArr[$x]'");
                    //$result_id = $con->query($get_id);
                    $id_get = 0;
                    foreach ($fetch_get_id as $result_id) {
                        $id_get = $result_id->id_planned;
                    }
                    /*while ($row_id = $result_id->fetch_assoc()) {
                        $id_get = $row_id['id'];
                    }*/
                    /*$sql2 = "INSERT INTO shift_active_data (saved_date, id_saved, id_of_shift, saved_from, saved_to, up_timestamp, id_user, user_name, comments)
            VALUES
            ('$dateArr[$x]',$id_get,'$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]','$nameArr[$x]', '$areaArr[$x]')";*/
                    DB::insert("INSERT INTO shift_active_data (saved_at, id_planned, id_shift, saved_from, saved_to, timestamp_update, id, comments)
                    VALUES
                    ('$dateArr[$x]',$id_get,'$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");
                    /*if (!mysqli_query($con, $sql2)) {
                        die('Error: ' . mysqli_error($con));
                    }*/
                } else {
                    //echo "111111";
                    if ($namesidArr[$x] == "") {
                        DB::update("UPDATE shift_planned_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments_on='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");
                    } else {
                        DB::update("UPDATE shift_planned_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments_on='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");

                    }
                    //$con->query($sqlsav);
                    $fetch_check_unique_shift2 = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$dateArr[$x]' AND shift_active_data.id_shift='$idArr[$x]' AND shift_active_data.id_planned IN (SELECT id_planned FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                    //$check_unique_shift2 = mysqli_query($con, "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$dateArr[$x]' AND shift_active_data.id_of_shift='$idArr[$x]' AND shift_active_data.id_saved IN (SELECT planned_id FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                    $check_unique_shift2 = $fetch_check_unique_shift2[0]->count;

                    if ($check_unique_shift2 == 0) {
                        //$sqlsav2 = "UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , up_timestamp='$time', id_user='$namesidArr[$x]', user_name='$nameArr[$x]', comments='$areaArr[$x]' WHERE saved_date='$dateArr[$x]' AND id_of_shift='$idArr[$x]' ";
                        //$con->query($sqlsav2);
                        // echo "UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ";
                        if ($namesidArr[$x] == "") {
                            DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                        } else {
                            DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");

                        }
                        /*DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                         */
                    }

                }
            }
        }
        $day = "";

        for ($x = 0; $x < count($deleteArr); $x++) {

            $year = substr($YM, 0, -3);
            $month = substr($YM, -2);
            $fetch_check_shift = DB::select("SELECT COUNT(*) AS count FROM shift_check WHERE id_shift = '$deleteArr[$x]' AND year_shift='$year' AND month_shift='$month'");
            //echo $year . $month;
            $check_unique_save = $fetch_check_shift[0]->count;
            // $check_unique_save = mysqli_query($con, $check_shift);
            if ($check_unique_save == 0) {
                DB::insert("INSERT INTO shift_check (id_shift, year_shift, month_shift) VALUES ('$deleteArr[$x]','$year','$month')");
                /*   $sql_shift = "INSERT INTO shift_check (id_shift, year_shift, month_shift)
           VALUES
   ('$deleteArr[$x]','$year','$month')";
                   if (!mysqli_query($con, $sql_shift)) {
                       die('Error: ' . mysqli_error($con));
                   }*/
            }
            for ($z = 1; $z < 32; $z++) {
                if ($z < 10) {
                    $day = "0" . $z;
                } else {
                    $day = $z;
                }
                $date = $YM . "-" . $day;
                //$up_time = "SELECT * FROM saved_shift_data WHERE saved_date = '$date' AND id_of_shift='$deleteArr[$x]'";
                $fetch_up_time = DB::select("SELECT * FROM shift_planned_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                //echo "SELECT * FROM shift_planned_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'";
                //$

                //$result = $con->query($up_time);
                foreach ($fetch_up_time as $result_up_time) {
                    $last_up = $result_up_time->timestamp_update;
                }
                if ($last_up < $time) {
                    // DB::delete("DELETE FROM shift_planned_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                    /*$sqldel = "DELETE FROM saved_shift_data WHERE saved_date = '$date' AND id_of_shift='$deleteArr[$x]'";
                    $con->query($sqldel);*/
                    $fetch_check_unique_shift = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$date' AND shift_active_data.id_shift='$deleteArr[$x]' AND shift_active_data.id_planned IN (SELECT id_planned FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                    //echo $fetch_check_unique_shift[0]->count;
                    $check_unique_shift = $fetch_check_unique_shift[0]->count;
                    if ($check_unique_shift == 0) {
                        DB::delete("DELETE FROM shift_active_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                        //$sqldel2 = "DELETE FROM shift_active_data WHERE saved_date = '$date' AND id_of_shift='$deleteArr[$x]'";
                        //$con->query($sqldel2);
                    }
                    /*$result = $con->query($up_time);
                    while($row = $result->fetch_assoc()) {
                        $last_up = $row['up_timestamp'];
                    }*/
                }
            }
        }
        $offers = 0;
        if (empty($offer)) {
            //$offers = count($offer);
           // return $offers;

        } else {
            $authUser = Auth::id();
            $offers = count($offer);
            for ($x = 0; $x < count($offer); $x++) {
                $id_shift_offer = substr($offer[$x], 7);
                $day_offer = substr($offer[$x], 0, 2);
                $date = $YM . "-" . $day_offer;
                DB::insert("REPLACE INTO shift_offer (id_shift, date, created_at, created_by) VALUE ('$id_shift_offer', '$date', '$time' , '$authUser') ");
                //$day_offer = substr($offer[$x], 7);


            }
        }
        for ($t = 1; $t < 32; $t++) {
        
            if ($t < 10) {
                $day_offer = "0" . $t;
            } else {
                $day_offer = $t;
            }
            $offer_date = $YM . "-" . $day_offer;
            //echo ("SELECT * FROM shift_offer WHERE date='' ");
            $fetch_offer = DB::select("SELECT * FROM shift_offer WHERE date='$offer_date' ");
            foreach ($fetch_offer as $result_offer) {
                $shift_offer  = $result_offer->id_shift;
                $fetch_offer2 = DB::select("SELECT * FROM shift_planned_data WHERE saved_at='$offer_date' AND id_shift='$shift_offer'  ");
                //echo "SELECT * FROM shift_planned_data WHERE saved_at='$offer_date' AND id_shift='$shift_offer'  ";
                foreach ($fetch_offer2 as $result_offer2) {
                    //echo $result_offer2->id;
                    if($result_offer2->id != null){
                        DB::delete("DELETE FROM shift_offer WHERE date='$offer_date' AND id_shift='$shift_offer' ");
                    }

                }

            }

        }


        /*print "Data added Successfully !";
        mysqli_close($con);*/
    }


    public function loadEmployeeTableCalendar(Request $request)
    {
        $saved_data[][] = array();
        $vacant = 0;
        $vacant_arr_count = 0;
        $id_user = array();
        $time_user = array();
        $name_user = array();
        $count_arr = array();
        $id_user = [];
        $time_user = [];
        $name_user = [];
        $count_arr = [];
        $id = array();
        $name = array();
        $to = array();
        $from = array();

        $id = $request->input('id');
        $name = $request->input('name');
        $to = $request->input("to");
        $from = $request->input('from');
        $dt = "";
        $hh = "2024-01-01";
        $A = 1;
        $R = "0" . $A;
        $d = "";
        $position = 0;

        for ($i = 1; $i < 9; $i++) {
            if ($i < 10) {
                $qq = "0" . $i;
            } else {
                $qq = $i;
            }
        }
        $aa = "\"2024-01\"";
        $d = "2024-01-" . $qq;

        for ($k = 0; $k < count($id); $k++) {
            $get_id = $id[$k];
            $get_name = $name[$k];
            $get_from = $from[$k];
            $get_to = $to[$k];
            if ($get_id == null || $get_id == "" || $get_id == 0) {
                $vacant_arr_count++;
                if (strtotime($get_to) > strtotime($get_from)) {
                    $time = strtotime($get_to) - strtotime($get_from);
                } else {
                    $time = strtotime($get_to) + 86400 - strtotime($get_from);
                }
                $vacant = $vacant + $time;
            } else if (in_array($get_id, $id_user)) {
                for ($u = 0; $u < count($id_user); $u++) {
                    if ($id_user[$u] == $get_id) {
                        if (strtotime($get_to) > strtotime($get_from)) {
                            $time = strtotime($get_to) - strtotime($get_from);
                        } else {
                            $time = strtotime($get_to) + 86400 - strtotime($get_from);
                        }
                        $time_user[$u] = $time_user[$u] + $time;
                        $count_arr[$u] = $count_arr[$u] + 1;
                        break;
                    }
                }
            } else {
                if (strtotime($get_to) > strtotime($get_from)) {
                    $time = strtotime($get_to) - strtotime($get_from);
                } else {
                    $time = strtotime($get_to) + 86400 - strtotime($get_from);
                }
                array_push($time_user, $time);
                array_push($count_arr, 1);
                array_push($id_user, $get_id);
                array_push($name_user, $get_name);
            }
        }



        array_multisort($name_user, $time_user, $id_user, $count_arr);
        echo '<div class="list-group">';


        //echo "<div class='container'>";
        if (count($id_user) != null) {
            for ($k = 0; $k < count($id_user); $k++) {
                if ($k == 0 && $vacant != null) {
                    echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Amount'>N</p></strong></div></div></a>";
                    $hour = round($vacant / 3600, 3);
                    $minute = $vacant % 3600;
                    echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Vacant'>Vacant </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='" . round((int) $hour) . " h " . ((int) ($minute / 60)) . " min'>" . round((int) $hour) . " h" . ((int) ($minute / 60)) . " min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px'>" . $vacant_arr_count . "</p></div></div></a>";
                } else if ($k == 0) {
                    echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Amount'>N</p></strong></div></div></a>";
                }
                $hour = round($time_user[$k] / 3600, 3);
                $minute = $time_user[$k] % 3600;
                echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='" . $name_user[$k] . "'>" . $name_user[$k] . " </p></div><div class='col-5'><p id='time-" . $id_user[$k] . "' style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='" . round((int) $hour) . " h " . ((int) ($minute / 60)) . " min'>" . round((int) $hour) . " h " . ((int) ($minute / 60)) . " min </p></div><div class='col-2'><p id='count-" . $id_user[$k] . "' style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px'>" . $count_arr[$k] . "</p></div> </div></a>";
            }
        } else if ($vacant != null) {
            echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Amount'>N</p></strong></div></div></a>";
            $hour = round($vacant / 3600, 3);
            $minute = $vacant % 3600;
            echo "<a href='#' class='list-group-item list-group-item-action mx-0 px-1'><div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='Vacant'>Vacant </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px' title='" . round((int) $hour) . " h " . ((int) ($minute / 60)) . " min'>" . round((int) $hour) . " h " . ((int) ($minute / 60)) . " min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden; margin-bottom: 0px'>" . $vacant_arr_count . "</p></div> </div></a>";
        }
        echo '</div>';
    }

}




?>