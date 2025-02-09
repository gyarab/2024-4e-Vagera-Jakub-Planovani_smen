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


class CalendarController extends Controller
{
    public function cal_obj_load(Request $request)
    {

        $obj_id = array();
        $obj_name = array();
        $obj_superior = array();
        $numberval = array();
        $look1 = array();
        $arr2 = array();
        $admin = false;
        $man = false;
        $arr1 = array();
        $rights[] = array();
        $id = Auth::id();
        $type = 505;
        $position = "";
        $fetch_obj = DB::select("SELECT * FROM object_model");
        $object_final_string = "";
        $shift_final_string = "";
        $unique_shift_name = array();
        //$fetchid = DB::select()
        //$fetchid = mysqli_query($conn2, "SELECT position FROM user WHERE id='$id'");
        //$fetchid = mysqli_query($conn2, "SELECT position FROM user WHERE id='$id'");
        /*while ($row_id = mysqli_fetch_assoc($fetchid)) {
            $position = $row_id['position'];
        }*/

        if ($position == "admin" || $type = 404) {
            $admin = true;
        } else if ($position == "manager") {
            $man = true;
            /*$fetchright = mysqli_query($conn2, "SELECT * FROM manager_rights WHERE id_user='$id'");
            if (mysqli_num_rows($fetchright) > 0) {
                while ($rows_obj = mysqli_fetch_assoc($fetchright)) {
                    array_push($rights, $rows_obj['object_id']);
                }
            }*/
            $fetch_rights = DB::select("SELECT * FROM manager_rights WHERE id_user='$id'");
            foreach ($fetch_rights as $result_rights) {
                array_push($rights, $result_rights->id_object);

            }
            //$fetchright = mysqli_query($conn2, "SELECT * FROM manager_rights WHERE id_user='$id'");

        }

        //$input = Crypt::decrypt($request->input('input'));
        $input = Crypt::decrypt($request->input('input'));
        //echo $input;

        foreach ($fetch_obj as $result_obj) {
            $obj_id[] = $result_obj->id_object;
            $obj_name[] = $result_obj->object_name;
            $obj_superior[] = $result_obj->superior_object_id;
        }
        array_multisort($obj_id, $obj_name, $obj_superior);
        /*if (mysqli_num_rows($fetch) > 0) {
            while ($rows_dat = mysqli_fetch_assoc($fetch)) {
                $obj_id[] = $rows_dat['id_object'];
                $obj_name[] = $rows_dat['object_name'];
                $obj_superior[] = $rows_dat['superior_object_name'];
            }
            array_multisort($obj_id, $obj_name, $obj_superior);
        }*/



        $find2[] = array();
        $look = 0;
        for ($x = 0; $x < count($obj_id); $x++) {
            if ($obj_id[$x] == $input) {
                static $dd = 1;
                $look = $obj_id[$x];
                array_push($arr1, $obj_id[$x]);
                array_push($arr2, $obj_name[$x]);


                $search = $obj_id[$x] . "";
                //$numberval[$count] = $obj_id[$x] . "";
                $count = 1;


                $dd++;

                $row = 0;

                for ($h = 0; $h < count($obj_id); $h++) {
                    if ($search == $obj_superior[$h]) {
                        $this->sub_object($search, $obj_id, $obj_name, $obj_superior, $find2, $look, $input, $arr1, $arr2);
                        $row++;
                        break;
                    }
                }
                $first = 0;
                array_multisort($arr2, $arr1);
                if (count($arr1) != 0) {

                    for ($q = 0; $q < count($arr1); $q++) {

                        if ($admin == true || in_array($arr1[$q], $rights) == true) {

                            if ($first == 0) {
                                $object_final_string = $object_final_string . "<option value='|--ALL--|' selected>ALL</option>";
                                $shift_final_string = $shift_final_string . "<option value='|--ALL--|' selected>ALL</option>";

                                //$fetch_shift
                                //echo "<div class='form-check form-check-inline'>";
                                //echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' type='checkbox' id='inlineCheckboxall' onclick='object_all()' checked value='ALL'>";
                                //echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='inlineCheckboxall'>ALL</p>";
                                //echo "</div>";
                                $first++;
                            }
                            $object_final_string = $object_final_string . "<option value='$arr1[$q]' onclick='getSelectedValues()'>$arr2[$q]</option>";
                            $fetch_shift = DB::select("SELECT * FROM shift_model WHERE id_object ='$arr1[$q]' ");

                            foreach ($fetch_shift as $result_shifts) {
                                $needle = $result_shifts->shift_name;
                                if (in_array($needle, $unique_shift_name) == false) {
                                    $shift_final_string = $shift_final_string . "<option value='$needle'>$needle</option>";
                                    array_push($unique_shift_name, $result_shifts->shift_name);

                                }
                            }
                            //echo "<div class='form-check form-check-inline'>";
                            //echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' type='checkbox' id='inlineCheckbox" . $arr1[$q] . "' name='nobj' onclick='object_search(this.value)' value='" . $arr1[$q] . "'>";
                            //echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='inlineCheckbox" . $arr1[$q] . "'>" . $arr2[$q] . "</p>";
                            //echo "</div>";
                        }

                    }

                }

                break;


            }

        }
        //echo $object_final_string;
        return response()->json([
            'objects' => $object_final_string,
            'shifts' => $shift_final_string,
        ]);

    }
    public function pickLoaderCalendar(Request $request)
    {
        //$mysqli = require ("../database.php");

        //$conn = new mysqli($host, $username, $password, $dbname);

        $shi_arr = $request->input('shift_arr'); /**id smen na nacteni */
        $obj_arr = $request->input('object_arr');/**id objektu na nacteni */
        $user = Auth::id(); /**id uzivatele */
        $type = $request->input('type');
        $sql = array(); /**arr na sql prikazy */
        $final = array();/**return arr */

        /**arraye pro nacteni objektu */
        $obj_id[] = array();
        $obj_name[] = array();
        $obj_superior[] = array();

        //$data4[] = array();
        $arr1 = array();
        $arr2 = array();
        $arr3 = array();
        $arr4 = array();
        $arr5 = array();
        $final_id = array();
        $final_name = array();
        $final_color = array();
        /*$final_colordark = array();
        $final_mon = array();
        $final_monf = array();
        $final_mont = array();
        $final_tue = array();
        $final_tuef = array();
        $final_tuet = array();
        $final_wed = array();
        $final_wed = array();
        $final_wed = array();
        $final_thu = array();
        $final_fri = array();
        $final_sat = array();
        $final_sun = array();*/





        $r_filter[] = array();

        if (count($shi_arr) == 0) {
            $shi_arr[0] = "";
        }

        sort($shi_arr);

        //$input = $_POST['input'];
        //$fetchobj = mysqli_query($conn, "SELECT * FROM list_of_objects");
        $fetch_obj = DB::select("SELECT * FROM object_model");
        foreach ($fetch_obj as $result_obj) {
            $obj_id[] = $result_obj->id_object;
            $obj_name[] = $result_obj->object_name;
            $obj_superior[] = $result_obj->superior_object_id;
        }
        $input = Crypt::decrypt($request->input('input'));
        /*if (mysqli_num_rows($fetchobj) > 0) {
            /**Sorting data alphabetically */
        /*while ($rows_dat = mysqli_fetch_assoc($fetchobj)) {
            $data1[] = $rows_dat['id_object'];
            $data2[] = $rows_dat['object_name'];
            $data3[] = $rows_dat['superior_object_name'];
            $data4[] = $rows_dat['superior_object_id'];
        }
        array_multisort($data1, $data2, $data3, $data4);
    }*/



        $find2[] = array();
        $look = 0;
        for ($x = 0; $x < count($obj_name); $x++) {
            if ($obj_id[$x] == $input) {
                static $dd = 1;
                $look = $obj_id[$x];
                array_push($arr1, $obj_id[$x]);
                array_push($arr2, $obj_name[$x]);
                if (in_array($obj_id[$x], $obj_arr) == true) {
                    /*$fetchshim = mysqli_query($conn, "SELECT shift_name, id_shift FROM create_shift WHERE object_id='$data1[$x]' ");
                     */
                    $fetchshim = DB::select("SELECT shift_name, id_shift FROM shift_model WHERE id_object='$obj_id[$x]' ");
                    foreach ($fetchshim as $result_shift_data) {
                        array_push($arr3, $result_shift_data->id_shift);
                        array_push($arr4, $obj_id[$x]);
                        array_push($arr5, $result_shift_data->shift_name);

                    }
                    /*  if (mysqli_num_rows($fetchshim) > 0) {
                          while ($row_shim = mysqli_fetch_assoc($fetchshim)) {
                              array_push($arr3, $row_shim['id_shift']);
                              array_push($arr4, $obj_id[$x]);
                              array_push($arr5, $row_shim['shift_name']);
                          }
                      }*/
                    //$fetchshim = mysqli_query($conn, "SELECT shift_name, id_shift FROM create_shift WHERE object_id='$data1[$x]' ");
                }


                $search = $obj_id[$x] . "";
                $count = 1;


                $dd++;

                $row = 0;

                for ($h = 0; $h < count($obj_name); $h++) {
                    if ($search == $obj_superior[$h]) {
                        $this->subLoader($search, $obj_id, $obj_name, $obj_superior, $find2, $look, $input, $arr1, $arr2, $arr3, $arr4, $arr5, $obj_arr);
                        $row++;
                        break;
                    }
                }
                array_multisort($arr2, $arr1);

                break;


            }

        }
        $sort_arr = array();
        $sort_arr_id = array();
        $sort_arr_obj = array();
        array_multisort($arr5, $arr4, $arr3);

        $us = 0;
        $position = "";
        if (count($arr3) != 0) {

            //$sql_admin = "SELECT position FROM user WHERE id='$user'";
            //$fetchadmin = mysqli_query($conn, $sql_admin);
            $fetchadmin = DB::select("SELECT position FROM users WHERE id='$user'");
            foreach ($fetchadmin as $result_admin) {
                $position = $result_admin->role;
            }
            /*if (mysqli_num_rows($fetchadmin) > 0) {
                while ($rowadm = mysqli_fetch_assoc($fetchadmin)) {
                    $position = $rowadm['position'];
                }
            }*/
            if ($position == "admin" || $position == "manager" || $type == 333) {
                for ($i = 0; $i < count($arr3); $i++) {
                    array_push($sort_arr_id, $arr3[$i]);
                    array_push($sort_arr_obj, $arr4[$i]);
                }
            } else {

                /* ***Nefunguje, pojistka, neni potrebna***/
                for ($i = 0; $i < count($arr3); $i++) {

                    //$sql_fil = "SELECT * FROM manager_rights WHERE object_id='$arr3[$i]' AND id_user='$user'";
                    $fetchfil = DB::select("SELECT * FROM management_rights WHERE id_object='$arr3[$i]' AND id='$user'");
                    foreach ($fetchfil as $result_fil) {
                        array_push($sort_arr_id, $arr3[$i]);
                        array_push($sort_arr_obj, $$arr4[$i]);
                    }
                    /*if (mysqli_num_rows($fetchfil) > 0) {
                        array_push($sort_arr_id, $arr3[$i]);
                        array_push($sort_arr_obj, $$arr4[$i]);
                    }*/
                }

            }
        }
        if (count($shi_arr) != 0) {
            $index = 0;

            if (in_array("|--ALL--|", $shi_arr) == true) {
                // echo "455646546565";
                $fetchkk2 = DB::select("SELECT * FROM shift_model ");
                //if (mysqli_num_rows($fetchkk) > 0) {
                //while ($rowkk = mysqli_fetch_assoc($fetchkk)) {
                // echo $arr1[0];
                foreach ($fetchkk2 as $rowkk2) {
                    $checkk2 = $rowkk2->id_object;

                    if (in_array($checkk2, $arr1) == true) {

                        if (in_array($rowkk2->id_shift, $sort_arr_id) == false) {
                            array_push($sort_arr_id, $rowkk2->id_shift);
                            array_push($sort_arr_obj, $rowkk2->id_object);
                        }
                    }
                }
            } else {
                for ($i = 0; $i < count($shi_arr); $i++) {
                    //$sqlkk = "SELECT * FROM create_shift WHERE shift_name='$shi_arr[$i]'";
                    $fetchkk = DB::select("SELECT * FROM shift_model WHERE shift_name='$shi_arr[$i]'");
                    //if (mysqli_num_rows($fetchkk) > 0) {
                    //while ($rowkk = mysqli_fetch_assoc($fetchkk)) {
                    foreach ($fetchkk as $rowkk) {
                        $checkk = $rowkk->id_object;

                        if (in_array($checkk, $arr1) == true) {

                            if (in_array($rowkk->id_shift, $sort_arr_id) == false) {
                                array_push($sort_arr_id, $rowkk->id_shift);
                                array_push($sort_arr_obj, $rowkk->id_object);
                            }
                        }
                    }

                    //}
                }
            }
        }
        for ($i = 0; $i < count($arr1); $i++) {
            $srch = $arr1[$i];
            for ($l = 0; $l < count($sort_arr_id); $l++) {
                if ($sort_arr_obj[$l] == $srch) {
                    array_push($sort_arr, $sort_arr_id[$l]);

                }
            }
        }

        $final_arr = array();

        for ($i = 0; $i < count($sort_arr); $i++) {
            //$sql[0] = "SELECT * FROM create_shift WHERE id_shift='$sort_arr[$i]'";
            //$fetch = mysqli_query($conn, $sql[0]);
            $fetch_final_result = DB::select("SELECT * FROM shift_model, object_model WHERE shift_model.id_shift='$sort_arr[$i]' AND shift_model.id_object=object_model.id_object");
            foreach ($fetch_final_result as $result_final) {
                //echo $result_final->shift_name . "-";
                /*if (mysqli_num_rows($fetch) > 0) {
                   /* $us = 1;
                    while ($rows = mysqli_fetch_assoc($fetch)) {*/
                $check = $result_final->id_object;
                $final_id[] = $result_final->id_shift;
                $final_name[] = $result_final->shift_name;
                $final_color[] = $result_final->color;

                /*$arr = [
                    ['label' => 'ALL', 'value' => 'ALL'],
                    //['label' => 'FIFTH', 'value' => '65'],
                ];*/
                /*$final_arr[] = [
                    'label' => $item['name'],
                    'value' => $item['value'],
                ];*/
                $red = substr($result_final->color, 1, 2);
                $green = substr($result_final->color, 3, 2);
                $blue = substr($result_final->color, 5, 2);
                $red = base_convert($red, 16, 10);
                $green = base_convert($green, 16, 10);
                $blue = base_convert($blue, 16, 10);
                $red = round($red - $red / 100 * 30);
                $green = round($green - $green / 100 * 30);
                $blue = round($blue - $blue / 100 * 30);
                $red = base_convert($red, 10, 16);
                $green = base_convert($green, 10, 16);
                $blue = base_convert($blue, 10, 16);
                if (strlen($red) < 2) {
                    $red = "0" . $red;
                }
                if (strlen($green) < 2) {
                    $green = "0" . $green;
                }
                if (strlen($blue) < 2) {
                    $blue = "0" . $blue;
                }
                $colordark = "#" . $red . $green . $blue;
                $final_arr[] = [
                    'id_shift' => $result_final->id_shift,
                    'shift_name' => $result_final->shift_name,
                    'color' => $result_final->color,
                    'darkcolor' => $colordark,
                    'monday' => $result_final->monday,
                    'tuesday' => $result_final->tuesday,
                    'wednesday' => $result_final->wednesday,
                    'thursday' => $result_final->thursday,
                    'friday' => $result_final->friday,
                    'saturday' => $result_final->saturday,
                    'sunday' => $result_final->sunday,
                    'mon_from' => $result_final->mon_from,
                    'mon_to' => $result_final->mon_to,
                    'tue_from' => $result_final->tue_from,
                    'tue_to' => $result_final->tue_to,
                    'wed_from' => $result_final->wed_from,
                    'wed_to' => $result_final->wed_to,
                    'thu_from' => $result_final->thu_from,
                    'thu_to' => $result_final->thu_to,
                    'fri_from' => $result_final->fri_from,
                    'fri_to' => $result_final->fri_to,
                    'sat_from' => $result_final->sat_from,
                    'sat_to' => $result_final->sat_to,
                    'sun_from' => $result_final->sun_from,
                    'sun_to' => $result_final->sun_to,
                    'id_object' => $result_final->id_object,
                    'object_name' => $result_final->object_name,
                ];
                /*$colordark = "#" . $red . $green . $blue;
                $final[$index][3] = $colordark;
                $final[$index][4] = $rows['monday'];
                $final[$index][5] = $rows['tuesday'];
                $final[$index][6] = $rows['wednesday'];
                $final[$index][7] = $rows['thursday'];
                $final[$index][8] = $rows['friday'];
                $final[$index][9] = $rows['saturday'];
                $final[$index][10] = $rows['sunday'];
                $final[$index][11] = $rows['mon_from'];
                $final[$index][12] = $rows['mon_to'];
                $final[$index][13] = $rows['tue_from'];
                $final[$index][14] = $rows['tue_to'];
                $final[$index][15] = $rows['wed_from'];
                $final[$index][16] = $rows['wed_to'];
                $final[$index][17] = $rows['thu_from'];
                $final[$index][18] = $rows['thu_to'];
                $final[$index][19] = $rows['fri_from'];
                $final[$index][20] = $rows['fri_to'];
                $final[$index][21] = $rows['sat_from'];
                $final[$index][22] = $rows['sat_to'];
                $final[$index][23] = $rows['sun_from'];
                $final[$index][24] = $rows['sun_to'];
                $final[$index][25] = $rows['object_id'];
                $final[$index][26] = $rows['object_name'];
                $index++;*/

                /*}
            }*/
            }
        }
        return response()->json($final_arr);
        /*return response()->json([
            'id_shift' => $final_id,
            'shift_name' => $final_name ,
            'color' => $final_color ,
            'final_result' => $final_arr
        ]);*/
    }
    public function getCommentCalendar(Request $request)
    {
        $saved_data[][] = array();
        $test_arr[] = array();
        $date = date("Y-m-d");
        $idArr = array();
        //echo $date;
        $Year = $request->input('year');
        $Month = $request->input('month');
        $idArr = $request->input('id');
        /*$Year = $_POST['year'];
        $Month = $_POST['month'];
        $idArr = json_decode($_POST["id"]);*/
        /*$cha = $_POST['cha'];
        $nns = $_POST['nn'];*/
        $dt = "";
        $hh = "2024-01-01";
        $A = 1;
        $R = "0" . $A;
        $d = "";
        $max_day = cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
        $IS = 0;

        $first = 0;
        for ($i = 1; $i < 9; $i++) {
            if ($i < 10) {
                $qq = "0" . $i;
            } else {
                $qq = $i;
            }
        }
        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        $aa = "\"2024-01\"";
        $d = "2024-01-" . $qq;


        $coll = 0;
        //echo $idArr[0];


        for ($x = 0; $x < count($idArr); $x++) {
            $IS = 0;

            //$sql_check = " SELECT SELECT COUNT(*) AS count FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift=$Year AND month_shift =$Month ";
            $fetch_existance = DB::select("SELECT COUNT(*) AS count FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift='$Year' AND month_shift ='$Month' ");
            $check_existance = $fetch_existance[0]->count;
            //$check_existance = mysqli_query($con, $sql_check);
            if ($check_existance != 0) {
                for ($i = 0; $i < 31; $i++) {
                    if (($i + 1) < 10) {
                        $dt = "0" . ($i + 1);
                    } else {
                        $dt = ($i + 1);
                    }


                    $t = "-";

                    $d = $Year . "-" . $Month . "-" . $dt;
                    $check_existance_cell = 0;
                    if ($max_day >= $dt) {
                        $fetch_message = DB::select("SELECT COUNT(*) AS count FROM shift_planned_data WHERE id_shift='$idArr[$x]' AND saved_at='$d' ");
                        $check_existance_cell = $fetch_message[0]->count;
                        /*$sql_get = " SELECT * FROM saved_shift_data WHERE id_of_shift='$idArr[$x]' AND saved_date='$d' ";
                        $test_arr[] = $sql_get;
                        if ($first == 0) {
                            $first++;
                        }
                        $get_com = "";*/
                        //$check_get = mysqli_query($con, $sql_get);
                        //$result_get = $mysqli_sav->query($sql_get);
                    } else {
                        $IS = 1;
                    }
                    if ($check_existance_cell == 0 || $IS == 1) {
                        $saved_data[$coll][$i] = "";
                    } else {
                        $sql_get = DB::select("SELECT * FROM shift_planned_data WHERE id_shift='$idArr[$x]' AND saved_at='$d' ");
                        $get_com = "";
                        foreach ($sql_get as $result_get) {
                            $get_com = $result_get->comments_on;
                        }
                        /*while ($rows_get = $result_get->fetch_assoc()) {
                            $get_com = $rows_get['comments'];

                        }*/

                        $saved_data[$coll][$i] = $get_com;
                    }
                }
                $coll++;
            } else {
                for ($i = 0; $i < 31; $i++) {
                    $saved_data[$coll][$i] = "";
                }
                $coll++;
            }
        }
        return $saved_data;
    }

    public function getSavedCalendarData(Request $request)
    {
        $saved_data[][] = array();
        /*$Year = $_POST['year'];
        $Month = $_POST['month'];
        $idArr = json_decode($_POST["id"]);*/
        //$cha = $_POST['cha'];
        // $nns = $_POST['nn'];
        $dt = "";
        $hh = "2024-01-01";
        $Year = $request->input('year');
        $Month = $request->input('month');
        $idArr = $request->input('id');
        //$e = $cha;
        $A = 1;
        $R = "0" . $A;
        $d = "";
        $max_day = cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
        $IS = 0;

        if ($Month < 10) {
            $Month = "0" . $Month;
        }
        for ($i = 1; $i < 9; $i++) {
            if ($i < 10) {
                $qq = "0" . $i;
            } else {
                $qq = $i;
            }
        }
        $aa = "\"2024-01\"";
        $d = "2024-01-" . $qq;
        //echo count($idArr);
        for ($x = 0; $x < count($idArr); $x++) {
            $IS = 0;
            $fetch_check = DB::select("SELECT COUNT(*) AS count FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift='$Year' AND month_shift ='$Month' ");
            // "SELECT COUNT(*) AS count FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift='$Year' AND month_shift ='$Month' ";
            $check_existance = $fetch_check[0]->count;
            if ($check_existance == 0) {
                $saved_data[$x][0] = "0";
                for ($i = 1; $i < 32; $i++) {
                    $saved_data[$x][$i] = "empty";
                }
            } else {
                $saved_data[$x][0] = "1";
                for ($i = 1; $i < 32; $i++) {
                    if ($i < 10) {
                        $dt = "0" . $i;
                    } else {
                        $dt = $i;
                    }
                    $t = "-";
                    $d = $Year . "-" . $Month . "-" . $dt;
                    if ($max_day >= $dt) {
                        $fetch_get = DB::select("SELECT COUNT(*) as count FROM shift_planned_data WHERE id_shift='$idArr[$x]' AND saved_at='$d' ");
                        $check_get = $fetch_get[0]->count;
                        //$check_get = mysqli_query($con, $sql_get);
                    } else {
                        $IS = 1;
                    }
                    if ($check_get == 0 || $IS == 1) {
                        $saved_data[$x][$i] = "empty";
                    } else {
                        
                        $fetch_data = DB::select("SELECT shift_planned_data.saved_from, shift_planned_data.saved_to, shift_planned_data.id FROM shift_planned_data WHERE shift_planned_data.id_shift='$idArr[$x]' AND shift_planned_data.saved_at='$d'");
                        //echo "SELECT shift_planned_data.saved_from, shift_planned_data.saved_to, shift_planned_data.id AS main_id FROM shift_planned_data, users WHERE shift_planned_data.id_shift='$idArr[$x]' AND shift_planned_data.saved_at='$d' AND shift_planned_data.id=users.id";
                        foreach ($fetch_data as $result_data) {
                            $get_from = $result_data->saved_from;
                            $get_to = $result_data->saved_to;
                            $get_id = $result_data->id;
                            if($get_id == '' || $get_id == 0){
                                $final_name = "--vacant--";
                            }else{
                                $final_name = "--vacant--";
                                $fetch_user_data = DB::select("SELECT * FROM users WHERE id='$get_id'");
                                foreach ($fetch_user_data as $result_user) {
                                    $final_name = $result_user->first_name . " " . $result_user->middle_name . " " . $result_user->last_name;
                                }
                            }
                            //echo "----";
                            //echo $get_id;
                            //$get_name = $result_data->firn;
                            //$get_name = $rows_get['user_name'];
                        }
                        // echo "1112";
                        //$result_get = $mysqli_sav->query($sql_get);
                        $saved_data[$x][$i] = $get_from . "//" . $get_to . "//" . $get_id . "//" . $final_name ;
                    }
                }
            }
            //return $saved_data;
        }
        return $saved_data;
    }
    public function getShiftOffer(Request $request)
    {
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Day = $request->input('day');
        $shift = $request->input('shift');
        if($Month < 9){
            $Month = '0'.($Month + 1 );
        }else{
            $Month = ($Month + 1 );
        }
        $date = $Year . "-". $Month. "-" . $Day;
     
        $fetch = DB::select("SELECT COUNT(*) AS count FROM shift_offer WHERE date='$date' AND id_shift=' $shift ' ");
        $counter = $fetch[0]->count;
        return  $counter;
    }
    public function insertOffer(Request $request)
    {
        $id = Auth::id();
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Day = $request->input('day');
        $shift = $request->input('shift');
        if($Month < 9){
            $Month = '0'.($Month + 1 );
        }else{
            $Month = ($Month + 1 );
        }
        $date = $Year . "-". $Month. "-" . $Day;
        $time = time();
       DB::insert("INSERT INTO shift_offer (id_shift, date, created_at, created_by) VALUE ('$shift', '$date', '$time' , '$id') ");
    }
    public function deleteOffer(Request $request)
    {
        $id = Auth::id();
        $Year = $request->input('year');
        $Month = $request->input('month');
        $Day = $request->input('day');
        $shift = $request->input('shift');
        if($Month < 9){
            $Month = '0'.($Month + 1 );
        }else{
            $Month = ($Month + 1 );
        }
        $date = $Year . "-". $Month. "-" . $Day;
        $time = time();
       DB::delete("DELETE FROM shift_offer WHERE date='$date' AND id_shift=' $shift '");
    }
    
    private function sub_object($searching, $dat1, $dat2, $dat4, $find2, $look, $input, array &$arr1, array &$arr2)
    {
        static $dd = 1;
        static $find3;

        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
                if ($find == 0) {
                    $find = 1;

                } else {

                }
                array_push($arr1, $dat1[$i]);
                array_push($arr2, $dat2[$i]);
                $dd++;
                $row = 0;
                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->sub_object($sea, $dat1, $dat2, $dat4, $find2, $look, $input, $arr1, $arr2);
                            break;
                        }
                    }
                }


            }
        }


    }
    private function subLoader($searching, $dat1, $dat2, $dat4, $find2, $look, $input, array &$arr1, array &$arr2, array &$arr3, array &$arr4, array &$arr5, $obj_arr)
    {

        /*global $arr1;
        global $arr2;
        global $arr3;
        global $arr4;
        global $arr5;
        global $obj_arr;
        global $conn;*/
        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
                array_push($arr1, $dat1[$i]);
                array_push($arr2, $dat2[$i]);
                if (in_array($dat1[$i], $obj_arr) == true) {

                    $fetchshim_sub = DB::select("SELECT shift_name, id_shift FROM shift_model WHERE id_object='$dat1[$i]' ");
                    foreach ($fetchshim_sub as $result_shift_data_sub) {
                        array_push($arr3, $result_shift_data_sub->id_shift);
                        array_push($arr4, $dat1[$i]);
                        array_push($arr5, $result_shift_data_sub->shift_name);

                    }
                    /*$fetchshi = mysqli_query($conn, "SELECT shift_name, id_shift FROM create_shift WHERE object_id='$dat1[$i]'");
                    if (mysqli_num_rows($fetchshi) > 0) {
                        while ($row_shi = mysqli_fetch_assoc($fetchshi)) {
                            array_push($arr3, $row_shi['id_shift']);
                            array_push($arr4, $dat1[$i]);
                            array_push($arr5, $row_shi['shift_name']);
                        }
                    }*/
                }
                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->subLoader($sea, $dat1, $dat2, $dat4, $find2, $look, $input, $arr1, $arr2, $arr3, $arr4, $arr5, $obj_arr);
                            break;
                        }
                    }
                }


            }
        }


    }
}



?>