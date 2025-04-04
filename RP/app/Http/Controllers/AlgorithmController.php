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
 
        if ($fromArr != null) {
            for ($x = 0; $x < count($fromArr); $x++) {
                if (($fromArr[$x] != "")) { 


                    $fetch_unique_row = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                    $check_unique = $fetch_unique_row[0]->count;
         
                    if ($check_unique == 0) {
                        if ($namesidArr[$x] == "") {
                            DB::insert("INSERT INTO shift_active_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time',NULL, '$areaArr[$x]')");
                        } else {
                            DB::insert("INSERT INTO shift_active_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");
                        }

                    } else {
                        if ($namesidArr[$x] == "") {
                            DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");
                        } else {
                            DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");

                        }
      
                    }
                }
            }
        }
        $day = "";
        /**
         * Aplikuji se jen novejsi data
         */
        if ($deleteArr != null) {
            for ($x = 0; $x < count($deleteArr); $x++) {

                $year = substr($YM, 0, -3);
                $month = substr($YM, -2);
                $fetch_check_shift = DB::select("SELECT COUNT(*) AS count FROM shift_check WHERE id_shift = '$deleteArr[$x]' AND year_shift='$year' AND month_shift='$month'");
                $check_unique_save = $fetch_check_shift[0]->count;
                if ($check_unique_save == 0) {
                    DB::insert("INSERT INTO shift_check (id_shift, year_shift, month_shift) VALUES ('$deleteArr[$x]','$year','$month')");
            
                }
                for ($z = 1; $z < 32; $z++) {
                    if ($z < 10) {
                        $day = "0" . $z;
                    } else {
                        $day = $z;
                    }
                    $date = $YM . "-" . $day;
                    $fetch_up_time = DB::select("SELECT * FROM shift_active_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                  

                    foreach ($fetch_up_time as $result_up_time) {
                        $last_up = $result_up_time->timestamp_update;

                        if ($last_up < $time) {
                         
                            $fetch_check_unique_shift = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$date' AND shift_active_data.id_shift='$deleteArr[$x]' AND shift_active_data.id_planned IN (SELECT id_planned FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                            $check_unique_shift = $fetch_check_unique_shift[0]->count;
                            if ($check_unique_shift == 0) {
                                DB::delete("DELETE FROM shift_active_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                    
                            }
         
                        }
                    }
                }
            }
        }


        $offers = 0;
        if (empty($offer)) {
       

        } else {
            $authUser = Auth::id();
            $offers = count($offer);
            for ($x = 0; $x < count($offer); $x++) {
                $id_shift_offer = substr($offer[$x], 7);
                $day_offer = substr($offer[$x], 0, 2);
                $date = $YM . "-" . $day_offer;
                DB::insert("REPLACE INTO shift_offer (id_shift, date, created_at, created_by) VALUE ('$id_shift_offer', '$date', '$time' , '$authUser') ");


            }
        }
        for ($t = 1; $t < 32; $t++) {

            if ($t < 10) {
                $day_offer = "0" . $t;
            } else {
                $day_offer = $t;
            }
            $offer_date = $YM . "-" . $day_offer;
            $fetch_offer = DB::select("SELECT * FROM shift_offer WHERE date='$offer_date' ");
            foreach ($fetch_offer as $result_offer) {
                $shift_offer = $result_offer->id_shift;
                $fetch_offer2 = DB::select("SELECT * FROM shift_active_data WHERE saved_at='$offer_date' AND id_shift='$shift_offer'  ");
                foreach ($fetch_offer2 as $result_offer2) {
                    if ($result_offer2->id != null) {
                        DB::delete("DELETE FROM shift_offer WHERE date='$offer_date' AND id_shift='$shift_offer' ");
                    }

                }

            }

        }

    }
    /**
     * 
     * stary ukladaci kod
     */
    /*public function insertCalendarData(Request $request)
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
 
        if ($fromArr != null) {
            for ($x = 0; $x < count($fromArr); $x++) {
                if (($fromArr[$x] != "")) { /*not allowing empty values and the row which has been removed.*/


                    /*$fetch_unique_row = DB::select("SELECT COUNT(*) AS count FROM shift_planned_data WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                    $check_unique = $fetch_unique_row[0]->count;
         
                    if ($check_unique == 0) {
                        if ($namesidArr[$x] == "") {
                            DB::insert("INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time',NULL, '$areaArr[$x]')");
                        } else {
                            DB::insert("INSERT INTO shift_planned_data (saved_at, id_shift, saved_from, saved_to, timestamp_update, id, comments_on) VALUES ('$dateArr[$x]','$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");
                        }

               

                        $fetch_get_id = DB::select("SELECT * FROM shift_planned_data WHERE saved_at = '$dateArr[$x]' AND id_shift='$idArr[$x]'");
                        $id_get = 0;
                        foreach ($fetch_get_id as $result_id) {
                            $id_get = $result_id->id_planned;
                        }

                        DB::insert("INSERT INTO shift_active_data (saved_at, id_planned, id_shift, saved_from, saved_to, timestamp_update, id, comments)
                    VALUES
                    ('$dateArr[$x]',$id_get,'$idArr[$x]','$fromArr[$x]','$toArr[$x]','$time','$namesidArr[$x]', '$areaArr[$x]')");
                
                    } else {
                        if ($namesidArr[$x] == "") {
                            DB::update("UPDATE shift_planned_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments_on='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");
                        } else {
                            DB::update("UPDATE shift_planned_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments_on='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]'");

                        }
                        $fetch_check_unique_shift2 = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$dateArr[$x]' AND shift_active_data.id_shift='$idArr[$x]' AND shift_active_data.id_planned IN (SELECT id_planned FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                        $check_unique_shift2 = $fetch_check_unique_shift2[0]->count;

                        if ($check_unique_shift2 == 0) {
                            if ($namesidArr[$x] == "") {
                                DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id=NULL, comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");
                            } else {
                                DB::update("UPDATE shift_active_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , timestamp_update='$time', id='$namesidArr[$x]', comments='$areaArr[$x]' WHERE saved_at='$dateArr[$x]' AND id_shift='$idArr[$x]' ");

                            }
                         
                        }

                    }
                }
            }
        }
        $day = "";
        if ($deleteArr != null) {
            for ($x = 0; $x < count($deleteArr); $x++) {

                $year = substr($YM, 0, -3);
                $month = substr($YM, -2);
                $fetch_check_shift = DB::select("SELECT COUNT(*) AS count FROM shift_check WHERE id_shift = '$deleteArr[$x]' AND year_shift='$year' AND month_shift='$month'");
                $check_unique_save = $fetch_check_shift[0]->count;
                if ($check_unique_save == 0) {
                    DB::insert("INSERT INTO shift_check (id_shift, year_shift, month_shift) VALUES ('$deleteArr[$x]','$year','$month')");
            
                }
                for ($z = 1; $z < 32; $z++) {
                    if ($z < 10) {
                        $day = "0" . $z;
                    } else {
                        $day = $z;
                    }
                    $date = $YM . "-" . $day;
                    $fetch_up_time = DB::select("SELECT * FROM shift_planned_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                  

                    foreach ($fetch_up_time as $result_up_time) {
                        $last_up = $result_up_time->timestamp_update;

                        if ($last_up < $time) {
                         
                            $fetch_check_unique_shift = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$date' AND shift_active_data.id_shift='$deleteArr[$x]' AND shift_active_data.id_planned IN (SELECT id_planned FROM attendance WHERE (log_from IS NOT NULL AND log_to IS NULL) OR (log_from IS NOT NULL AND log_to IS NOT NULL)) )");
                            $check_unique_shift = $fetch_check_unique_shift[0]->count;
                            if ($check_unique_shift == 0) {
                                DB::delete("DELETE FROM shift_active_data WHERE saved_at = '$date' AND id_shift='$deleteArr[$x]'");
                    
                            }
         
                        }
                    }
                }
            }
        }


        $offers = 0;
        if (empty($offer)) {
       

        } else {
            $authUser = Auth::id();
            $offers = count($offer);
            for ($x = 0; $x < count($offer); $x++) {
                $id_shift_offer = substr($offer[$x], 7);
                $day_offer = substr($offer[$x], 0, 2);
                $date = $YM . "-" . $day_offer;
                DB::insert("REPLACE INTO shift_offer (id_shift, date, created_at, created_by) VALUE ('$id_shift_offer', '$date', '$time' , '$authUser') ");


            }
        }
        for ($t = 1; $t < 32; $t++) {

            if ($t < 10) {
                $day_offer = "0" . $t;
            } else {
                $day_offer = $t;
            }
            $offer_date = $YM . "-" . $day_offer;
            $fetch_offer = DB::select("SELECT * FROM shift_offer WHERE date='$offer_date' ");
            foreach ($fetch_offer as $result_offer) {
                $shift_offer = $result_offer->id_shift;
                $fetch_offer2 = DB::select("SELECT * FROM shift_planned_data WHERE saved_at='$offer_date' AND id_shift='$shift_offer'  ");
                foreach ($fetch_offer2 as $result_offer2) {
                    if ($result_offer2->id != null) {
                        DB::delete("DELETE FROM shift_offer WHERE date='$offer_date' AND id_shift='$shift_offer' ");
                    }

                }

            }

        }

    }*/


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
        if ($id != null) {
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
        }



        array_multisort($name_user, $time_user, $id_user, $count_arr);
        echo '<div class="list-group">';



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


   
    public function algorithmPick(Request $request)
    {
        $id_arr = array();/**arr pro id kandidatu */
        $name_arr = array();/**arr pro jmena kandidatu */
        $position_arr = array();/**arr pro pozice kandidatu */

        $from = $request->from;/**odkdy zacina hledana smena*/
        $to = $request->to;/**kdy konci hledana smena*/
        $date = $request->date;/**den hledane smeny*/
        $id_shift = $request->id;/**id smeny*/
        $y_id = $request->y_id;/** arr s id uzivatelu z kalendare z predchoziho dne */
        $y_from = $request->y_from;/** arr s casy (odkdy) uzivatelu z kalendare z predchoziho dne */
        $y_to = $request->y_to;/** arr s casy (dokdy) uzivatelu z kalendare z predchoziho dne */
        $c_id = $request->c_id;/** arr s id  uzivatelu z kalendare z dnesniho dne */
        $c_from = $request->c_from;/** arr s casy (odkdy) uzivatelu z kalendare z dnesniho dne */
        $c_to = $request->c_to;/** arr s casy (dokdy) uzivatelu z kalendare z dnesniho dne */
        $nposition = $request->nposition; /*hodnota pro backtrace*/
        if ($y_from == null) {
            $y_from = array();
        }
        if ($y_id == null) {
            $y_id = array();
        }
        if ($y_to == null) {
            $y_to = array();
        }

        if ($c_id == null) {
            $c_id = array();
        }else{
            for ($i = 0; $i < count($c_id); $i++) {
                error_log($c_id[$i]);
            }   

        }
        if ($c_from == null) {
            $c_from = array();
        }
        if ($c_to == null) {
            $c_to = array();
        }


        $is_right = 0; /**promena pro vyrazovani dat */
        $return_data = 0; /**return data */
        /**typy - slouzi k testovani algoritmu */
        $typ = 0;
        $typ2 = 0;

        $add_posible_users2_constant = 0;/**konstanty pro prvni vyrazeni */
        $add_posible_users3_constant = 0;/**konstanty pro druhe vyrazeni */
        $from_permanent = "";
        $to_permanent = "";
        $posible_users1 = array();/**arr pro prvni vyrazeni na id*/
        $posible_users2 = array();/**arr pro druhe vyrazeni na id*/
        $posible_users3 = array();/**arr pro treti vyrazeni na id*/


        $fetch = DB::select("SELECT * FROM shift_assignment, users WHERE shift_assignment.id_shift = '$id_shift' AND users.id=shift_assignment.id");
        foreach ($fetch as $rows) {
            array_push($id_arr, $rows->id);
            $first_name = $rows->first_name;
            $middle_name = $rows->middle_name;
            $last_name = $rows->last_name;
            $name = $last_name . " " . $middle_name . " " . $first_name;
            array_push($name_arr, $name);
            array_push($position_arr, $rows->role);
        }

        if (count($id_arr) != 0) {

            /**zjisteni vcerejsiho dne ze timestampu */
            /**source : https://techvblogs.com/blog/get-last-day-of-month-from-date-in-php */
            // Converting string to date 
            $date_stamp = strtotime($date);

            // Last date of current month. 
            $ydate = strtotime(date("Y-m-d", $date_stamp - 86400));

            // Day of the last date  
            $yesterday = date("Y-m-d", $ydate);

            //$sql_yesterday = "SELECT * FROM saved_shift_data WHERE saved_date = '$yesterday' ";

            $fetch_y_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE saved_at = '$yesterday' ");
            $fetch_y = DB::select("SELECT * FROM shift_active_data WHERE saved_at = '$yesterday' ");

            /**pridani dat do arrayi s uzivateli z kalendare z predchoziho dne  */
            if ($fetch_y_count[0]->count != 0) {
                foreach ($fetch_y as $rows_y) {
                    array_push($y_from, $rows_y->saved_from);
                    array_push($y_to, $rows_y->saved_to);
                    array_push($y_id, $rows_y->id);
                }

            }
  
            /**pridani dat do arrayi s uzivateli z kalendare z dnesniho dne  */
            //$sql_today = "SELECT * FROM saved_shift_data WHERE saved_date = '$date' ";
            $fetch_t_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE saved_at = '$date' ");
            $fetch_t = DB::select("SELECT * FROM shift_active_data WHERE saved_at = '$date' ");
            if ($fetch_t_count[0]->count != 0) {
                foreach ($fetch_t as $rows_t) {
                    array_push($c_from, $rows_t->saved_from);
                    array_push($c_to, $rows_t->saved_to);
                    array_push($c_id, $rows_t->id);
                }
            }





            /**zjisteni casovych moznosti brigadniku */
            $dayofweek = date('D', strtotime($date));
            for ($i = 0; $i < count($id_arr); $i++) {
                if ($position_arr[$i] == "parttime") {
                    error_log("1");
                    $fetch_time_count = DB::select("SELECT COUNT(*) AS count FROM time_options WHERE id='$id_arr[$i]' AND saved_at='$date'");
                    $fetch_time = DB::select("SELECT * FROM time_options WHERE id='$id_arr[$i]' AND saved_at='$date'");

                    $is_right = 0;
                    $from_time = null;
                    $to_time = null;
            

                    if ($fetch_time_count[0]->count != 0) {
                        $from_time = null;
                        foreach ($fetch_time as $rows_time) {
                            $from_time = $rows_time->opt_from;
                            $to_time = $rows_time->opt_to;
                        }
                    }
                    if ($from_time != null) {
                        if (strtotime($from) >= strtotime($to)) {
                            if (strtotime($from_time) >= strtotime($to_time)) {
                                if (strtotime($from_time) <= strtotime($from) && strtotime($to_time) >= strtotime($to)) {
                                    $is_right = 1;
                                }
                                $typ = 1;
                            }
                        } else {
                            if (strtotime($from_time) >= strtotime($to_time)) {
                                if (strtotime($from_time) <= strtotime($from)) {
                                    $is_right = 1;
                                }
                                $typ = 2;
                            } else {
                                if (strtotime($from_time) <= strtotime($from) && strtotime($to_time) >= strtotime($to)) {
                                    $is_right = 1;
                                }
                                $typ = 3;

                            }
                        }

                    }
                    if ($is_right == 1) {
                        array_push($posible_users1, $id_arr[$i]);
                    }
                    $ees = $typ . "//" . $id_arr[$i] . "---" . $date . "---" . $dayofweek . "-" . $is_right . "--" . $from_time . "--" . $to_time;

                } else {
                    /**zjisteni casovych moznosti permanentnich uzivatelu (manazer, admin a full-time employee) */
                    $from_permanent = null;
                    $to_permanent = null;
                    if ($dayofweek == "Mon") {
                        $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND monday=1";
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND monday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND monday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->mon_from;
                                $to_permanent = $rows_permanent->mon_to;
                            }
                        }
              
                    } else if ($dayofweek == "Tue") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND tuesday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND tuesday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->tue_from;
                                $to_permanent = $rows_permanent->tue_to;
                            }
                        }

                    } else if ($dayofweek == "Wed") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND wednesday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND wednesday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->wed_from;
                                $to_permanent = $rows_permanent->wed_to;
                            }
                        }

                    } else if ($dayofweek == "Thu") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND thursday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND thursday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->thu_from;
                                $to_permanent = $rows_permanent->thu_to;
                            }
                        }

                    } else if ($dayofweek == "Fri") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND friday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND friday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->fri_from;
                                $to_permanent = $rows_permanent->fri_to;
                            }
                        }
        
                    } else if ($dayofweek == "Sat") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND saturday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND saturday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->sat_from;
                                $to_permanent = $rows_permanent->sat_to;
                            }
                        }
             
                    } else if ($dayofweek == "Sun") {
                        $fetch_permanent_count = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id_arr[$i]' AND sunday=1");
                        $fetch_permanent = DB::select("SELECT * FROM permanent_time_options WHERE id='$id_arr[$i]' AND sunday=1");
                        if ($fetch_permanent_count[0]->count != 0) {
                            foreach ($fetch_permanent as $rows_permanent) {
                                $from_permanent = $rows_permanent->sun_from;
                                $to_permanent = $rows_permanent->sun_to;
                            }
                        }
               
                    }
                    $is_right = 0;
                    if ($from_permanent != null) {
                        if (strtotime($from) >= strtotime($to)) {
                            if (strtotime($from_permanent) >= strtotime($to_permanent)) {
                                if (strtotime($from_permanent) <= strtotime($from) && strtotime($to_permanent) >= strtotime($to)) {
                                    $is_right = 1;
                                }
                                $typ = 1;
                            }
                        } else {
                            if (strtotime($from_permanent) >= strtotime($to_permanent)) {
                                if (strtotime($from_permanent) <= strtotime($from)) {
                                    $is_right = 1;
                                }
                                $typ = 2;
                            } else {
                                if (strtotime($from_permanent) <= strtotime($from) && strtotime($to_permanent) >= strtotime($to)) {
                                    $is_right = 1;
                                }
                                $typ = 3;

                            }
                        }

                    }
                    /**prvni vyrazeni na zaklade casovych moznosti */
                    if ($is_right == 1) {
                        array_push($posible_users1, $id_arr[$i]);
                    }


                }


            }
            if (count($posible_users1) != 0) {
                if (count($y_id) != 0) {

                    for ($e = 0; $e < count($posible_users1); $e++) {
                        $add_posible_users2_constant = 0;
                        if (in_array($posible_users1[$e], $y_id)) {
                            for ($w = 0; $w < count($y_id); $w++) {
                                if ($posible_users1[$e] == $y_id[$w]) {
                                    if (strtotime($y_from[$w]) >= strtotime($y_to[$w])) {
                                        if (strtotime($y_to[$w]) <= strtotime($from)) {
                                        } else {
                                            $add_posible_users2_constant = 1;
                                        }

                                    } else {

                                    }

                                }
                            }
                            if ($add_posible_users2_constant == 0) {
                                array_push($posible_users2, $posible_users1[$e]);
                            }

                        } else {
                            $typ2 = 3;
                            array_push($posible_users2, $posible_users1[$e]);
                        }

                    }
                } else {


                    /**druhe vyrazeni na zaklade toho zda-li se vcerejsi smeny neprekryvaji s zvolenou smenou */
                    for ($e = 0; $e < count($posible_users1); $e++) {
                        array_push($posible_users2, $posible_users1[$e]);

                    }
                }
            }
            if (count($posible_users2) != 0) {
                if (count($c_id) != 0) {

                    for ($e = 0; $e < count($posible_users2); $e++) {
                        $add_posible_users3_constant = 0;
                        if (in_array($posible_users2[$e], $c_id)) {
                            for ($w = 0; $w < count($c_id); $w++) {
                                if ($posible_users2[$e] == $c_id[$w]) {
                                    if (strtotime($c_from[$w]) >= strtotime($c_to[$w])) {

                                        $add_posible_users3_constant = 1;


                                    } else {

                                        if (strtotime($c_to[$w]) <= strtotime($from)) {

                                        } else {
                                            $add_posible_users3_constant = 1;
                                        }
                                    }

                                }
                            }
                            if ($add_posible_users3_constant == 0) {
                                array_push($posible_users3, $posible_users2[$e]);
                            }

                        } else {
                            $typ2 = 3;
                            array_push($posible_users3, $posible_users2[$e]);
                        }

                    }
                } else {
                    /**treti vyrazeni na zaklade toho zda-li se dnesni smeny neprekryvaji s zvolenou smenou */
                    for ($e = 0; $e < count($posible_users2); $e++) {
                        array_push($posible_users3, $posible_users2[$e]);
                    }
                }
            }







            $final_name = "";
       

            /**vraceni vybraneho uzivatele */
            if (count($posible_users3) != 0) {
                for ($t = 0; $t < count($id_arr); $t++) {
                    if ($posible_users3[$nposition] == $id_arr[$t]) {
                        $final_name = $name_arr[$t];
                        //break;
                    }
                }
                $exist_next = 0;
                if (isset($posible_users3[$nposition + 1])) {
                    $exist_next = 1;
                }

                array_push($posible_users3, 0);
                return response()->json(['mark_cell_xnext' => $exist_next, 'create_nunmber' => $posible_users3[$nposition], 'sub_name' => $final_name, 'all_users' => $posible_users3]);

                //return response()->json(['mark_cell_xnext' => $exist_next, 'create_nunmber' => $posible_users3[$nposition], 'sub_name' => $posible_users3]);


            } else {

                array_push($posible_users3, 0);

                return response()->json(['mark_cell_xnext' => 0, 'create_nunmber' => 0, 'sub_name' => "--vacant--", 'all_users' => $posible_users3]);


            }
        } else {
       
            array_push($posible_users3, 0);

            return response()->json(['mark_cell_xnext' => 0, 'create_nunmber' => 0, 'sub_name' => "--vacant--", 'all_users' => $posible_users3]);


        }


    }
    public function algorithmBestCombination(Request $request)
    {


        $count = array();
        $idExistanceArr = array();
        $position = array();
        $combination = array();
    
        $filter_combination_first = array();
        $filter_combination_second = array();
        $filter_combination_third = array();
        $filter_combination_second_arr = array();
        $filter_combination_third_arr = array();
        $filter_combination_four_arr = array();
        $output_arr = array();
        $maxes_arr = array();
        $max = 0;
        $current_max = 0;
        $max_position = 0;
        $min_position = 1000000000000;
        $current_max_position = 0;
        $max_count = 0;
        $current_max_count = 0;
        $filter_column = array();
        $repeat_arr = array();
        $length_var = 0;
        $countedArr = array();
        $filteredShiftCounter = array();
        $filteredShiftCounterTemp = array();
        $filteredPosition = array();
        $returnNames = array();

        $idExistanceArr = $request->id;
        $idExistanceArrTemp = array();
        $count = $request->count;
        $countTemp = array();

        $combination = $request->combination;
      
        if (is_array($combination)) {
            $rowCount = count($combination);
            $colCount = count($combination[0]);
            /***
             * Prochazeni do sirky
             * Vytvari array s poctem odpracovanych hodin s danou smenou
             * 
             */
            for ($j = 0; $j < $rowCount; $j++) {
                $tempArray = [];
                if (count($count) != 0) {
                    for ($w = 0; $w < count($count); $w++) {
                        $countTemp[$w] =  $count[$w];
                        $idExistanceArrTemp[$w] = $idExistanceArr[$w];
                    }
                 }
                for ($i = 0; $i < $colCount; $i++) {

                    if (count($idExistanceArrTemp) != 0) {
                        $searchKey = -1;
                        for ($key = 0; $key < count($idExistanceArrTemp); $key++) {
                            if ($combination[$j][$i] == $idExistanceArrTemp[$key]){
                                $searchKey = $key;
                                break;

                            }
                        }
                        if( $searchKey == -1){
                            $tempArray[] = 0;
                            $idExistanceArrTemp[] = $combination[$j][$i];
                            $countTemp[] = 1;
                        }else{
                            $tempArray[] = $countTemp[$searchKey];
                            $countTemp[$searchKey] += 1;
                        }
                    }else{
                        $tempArray[] = 0;
      
                    }
                }
                $countedArr[] = $tempArray;
            }
            /***
             * For loop vypocitava kolik hodin navic je od nejvetsiho poctu odpracovanych hodin
             * 
             * 
             */
            for ($j = 0; $j < count($countedArr[0]); $j++) {
                $biggestExistingShift = 0;
                for ($i = 0; $i < count($countedArr); $i++) {
                    if($biggestExistingShift < $countedArr[$i][$j]){
                        if($combination[$i][$j] == 0){
                            $biggestExistingShift = 0;

                        }else{

                        $biggestExistingShift = $countedArr[$i][$j];
                        }
                    }
                }
                for ($i = 0; $i < count($countedArr); $i++) {
                    if($combination[$i][$j] == 0){
                        $countedArr[$i][$j] = 0;

                    }else{
                        $countedArr[$i][$j] = $biggestExistingShift - $countedArr[$i][$j];

                    }
                }
            }
            /*
            *Vypis filtrovane kombinace
            for ($j = 0; $j < count($countedArr[0]); $j++) {
                for ($i = 0; $i < count($countedArr); $i++) {
                    error_log("Combinace [" . $i . "," . $j . "] = " . $countedArr[$i][$j] . " <>");
                }
            }*/
            $biggestCombinationAdvantageMax = 0;
            $biggestCombinationAdvantageCurrent = 0;
            for ($j = 0; $j < count($countedArr); $j++) {
                $biggestCombinationAdvantageCurrent = 0;
                for ($i = 0; $i < count($countedArr[0]); $i++) {
                    $biggestCombinationAdvantageCurrent += $countedArr[$j][$i];
                }
                if($biggestCombinationAdvantageMax < $biggestCombinationAdvantageCurrent ){
                    $filteredShiftCounter = [];
                    $filteredShiftCounter[] = $combination[$j];
                    $biggestCombinationAdvantageMax = $biggestCombinationAdvantageCurrent;
                }else{
                    $filteredShiftCounter[] = $combination[$j];
                }
            }

            /** 
             * Prochazi do sirky
            */
            for ($j = 0; $j < count($filteredShiftCounter[0]); $j++) {
                for ($i = 0; $i < count($filteredShiftCounter); $i++) {
                    error_log("XXXX[" . $i . "," . $j . "] = " . $filteredShiftCounter[$i][$j] . " <>");
                }
            }
            if (is_array($filteredShiftCounter)) {
                if(count($filteredShiftCounter) > 1){
                    $rowCountFiltered = count($filteredShiftCounter);
                    $colCountFiltered = count($filteredShiftCounter[0]);
                    /***
                     * Prochazeni do sirky
                     * Vytvari array s poctem odpracovanych hodin s danou smenou
                     * 
                     */
                    for ($j = 0; $j < $rowCountFiltered; $j++) {
                        $tempArrayFiltered = [];
                        for ($i = 0; $i < $colCountFiltered; $i++) {
                            $searchUserPosition = $filteredShiftCounter[$j][$i];
                            $fetch_position = DB::select("SELECT role FROM users WHERE id=$searchUserPosition");
                            $position_name = "";
                            foreach ($fetch_position as $rows) {
                                $position_name = $rows->role;
                            }
                            if ($position_name == "admin" || $position_name == "manager" || $position_name == "fulltime") {
                                $tempArrayFiltered[] = 1;
                            }else{
                                $tempArrayFiltered[] = 0;
                            }
                        }
                        $filteredShiftCounterTemp[] = $tempArrayFiltered;
                    }
                    for ($j = 0; $j < count($filteredShiftCounterTemp[0]); $j++) {
                        for ($i = 0; $i < count($filteredShiftCounterTemp); $i++) {
                            error_log("OOOOO[" . $i . "," . $j . "] = " . $filteredShiftCounterTemp[$i][$j] . " <>");
                        }
                    }
                    $biggestPositionAdvantageMax = 0;
                    $biggestPositionAdvantageCurrent = 0;
                    for ($j = 0; $j < count($filteredShiftCounterTemp); $j++) {
                        $biggestPositionAdvantageCurrent = 0;
                        for ($i = 0; $i < count($filteredShiftCounterTemp[0]); $i++) {
                            $biggestPositionAdvantageCurrent += $filteredShiftCounterTemp[$j][$i];
                        }
                        if($biggestPositionAdvantageMax < $biggestPositionAdvantageCurrent ){
                            $filteredPosition = [];
                            $filteredPosition[] = $filteredShiftCounter[$j];
                            $biggestPositionAdvantageMax = $biggestPositionAdvantageCurrent;
                        }else{
                            $filteredPosition[] = $filteredShiftCounter[$j];
                        }
                    }
                    if(count($filteredPosition) > 1){
                        $rowPositionCounter = count($filteredPosition);
                        $randomPosition = rand(0,$rowPositionCounter-1);
                        for ($j = 0; $j < count($filteredPosition[$randomPosition]); $j++) {
                            $returnNames[$j] = $this->getName($filteredPosition[$randomPosition][$j]);
    
                        } 
                        return response()->json(['namesArr' => $returnNames, 'idArr' => $filteredPosition[$randomPosition]]);

                    }else{
                        for ($j = 0; $j < count($filteredPosition[0]); $j++) {
                            $returnNames[$j] = $this->getName($filteredPosition[0][$j]);
    
                        }      
                        return response()->json(['namesArr' => $returnNames, 'idArr' => $filteredPosition[0]]);
                    }
                }else{
                    for ($j = 0; $j < count($filteredShiftCounter[0]); $j++) {
                        $returnNames[$j] = $this->getName($filteredShiftCounter[0][$j]);

                    }
                    return response()->json(['namesArr' => $returnNames, 'idArr' => $filteredShiftCounter[0]]);

                }
            }
   
         } else {
        } 
        
    }
    public function getName($userId){
        $fetch_position = DB::select("SELECT * FROM users WHERE id=$userId");
        foreach ($fetch_position as $rows) {
            $first_name = $rows->first_name;
            $middle_name = $rows->middle_name;
            $last_name = $rows->last_name;
            return $first_name . " ". $middle_name ." " .  $last_name; 
        }
        return "";
    }

}




?>