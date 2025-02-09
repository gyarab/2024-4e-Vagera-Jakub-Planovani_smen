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


class OrganizationController extends Controller
{
    public function loadOrganizationTable(Request $request)
    {


        $input = $request->input('input');
        // echo $input;
        $input_decrypt = Crypt::decrypt($input);
        $date = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($date . ' - 1 days'));

        $data_name = array();

        // $fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
        $fetch_object = DB::select("SELECT * FROM object_model");
        $data2 = array();
        $icons = array();
        $data3 = array();
        $numberval = array();


        foreach ($fetch_object as $result_object) {
            // while ($rows_dat = mysqli_fetch_assoc($fetch)) {
            $data1[] = $result_object->id_object;
            $data2[] = $result_object->object_name;
            //$data3[] = $result_object['superior_object_name'];
            $data4[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
            //}
            // array_multisort($data1, $data2, $data3, $data4);
        }
        array_multisort($data1, $data2, $data4, $icons);

        $search = "";


        $nm = "box";
        $dd = 1;
        for ($x = 0; $x < count($data2); $x++) {
            if ($data4[$x] == null && $data1[$x] == $input_decrypt) {
                static $dd = 1;

                $search = $data1[$x] . "";
                $count = 1;
                echo "<div>";
                echo "<center><h5 class='my-1'><i class=' $icons[$x]'></i>&nbsp;$data2[$x]</h5></center>";
               // echo "<p class='p-2 mb-1 text-center' style='margin:auto;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;background: #4CAF50;color:#ffffff; font-size: 18px;'><i class=' $icons[$x]'></i>&nbsp;" . $data2[$x] . "<p>";

                $dd++;


                $row = 0;
                $shi_idm = array();
                $shi_namem = array();
                //$sqlshm = "SELECT * FROM create_shift WHERE object_id='$data1[$x]' ";
                //$fetchcm = mysqli_query($conn2, $sqlshm);
                $fetchcm_count = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$data1[$x]' ");
                $fetchcm = DB::select("SELECT * FROM shift_model WHERE id_object='$data1[$x]' ");
                if ($fetchcm_count[0]->count > 0) {
                    foreach ($fetchcm as $rfetchcm) {
                        array_push($shi_idm, $rfetchcm->id_shift);
                        array_push($shi_namem, $rfetchcm->shift_name);
                    }

                    /* while ($rows_cm = mysqli_fetch_assoc($fetchcm)) {
                       array_push($shi_idm, $rows_cm['id_shift']);
                       array_push($shi_namem, $rows_cm['shift_name']);
               
                     }*/
                    for ($k = 0; $k < count($shi_idm); $k++) {
/**source https://dba.stackexchange.com/questions/257618/how-to-select-all-columns-plus-one-alias-column-in-mysql */
                        //$sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_active = attendance.id_attendance WHERE (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$date' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";
                      //  $sqldd[$k] = "SELECT *, users.id as main_id FROM users, attendance WHERE (attendance.id_shift='$shi_idm[$k]' AND attendance.saved_at='$date' AND users.id=attendance.id) OR (attendance.id_shift='$shi_idm[$k]' AND attendance.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=attendance.id) ";
                        $sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_shift=attendance.id_shift AND shift_active_data.saved_at=attendance.saved_at AND shift_active_data.id=attendance.id WHERE (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$date' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";

                    }
                    for ($k = 0; $k < count($shi_idm); $k++) {
                        // echo $sqldd[$k];
                        //$fetchddm = mysqli_query($conn2, $sqldd[$k]);
                        $fetchddm = DB::select($sqldd[$k]);
                        //  while ($rows_dm = mysqli_fetch_assoc($fetchddm)) {
                        foreach ($fetchddm as $rows_dm) {
                            if ($rows_dm->saved_at == $yesterday) {
                                $add_ym = "(yesterday)";
                            } else {
                                $add_ym = "";
                            }
                            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$rows_dm->main_id' ");
          
                            if ($fetch_img_count[0]->count > 0) {
                                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id='$rows_dm->main_id' ");
                                $link_image = "";
                                foreach ($fetch_link as $result_link) {
                                    $link_image = $result_link->image_link;
                                }
                                $imageUrl = Storage::url($link_image);
                            } else {
                                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                            }
                            echo "<ul class='list-group'><li class='list-group-item'><div class='row'><div class='col-12 col-md-7'><p style='display:inline;font-size:14px'>" . substr($rows_dm->saved_from, 0, -3) . "-" . substr($rows_dm->saved_to, 0, -3) . " " . $shi_namem[$k] . " " . $add_ym . " |  <img src=' $imageUrl ' class='rounded-circle object-fit-cover'
                                style='height: 25px; width: 25px' ><strong>&nbsp;" . $rows_dm->last_name . " " . $rows_dm->middle_name . " " . $rows_dm->first_name . "</strong> </p></div><div class='col-12 col-md-5 d-flex d-md-block justify-content-start'>";
                            /**Smena jeste nezacala */
                            if ($rows_dm->log_from == null && strtotime($rows_dm->saved_from) > strtotime(date('H:i:s'))) {
                                echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>--:-- / --:--</div><div style='float:right;font-size:14px'>Has not started:&nbsp;&nbsp;</div></div></li></ul>";
                                /**Smena zacal, ale prichod neni potvrzeny */
                            } else if ($rows_dm->log_from == null) {
                                echo "<div style='border-width: thin;float:right;color:red;padding-left:2px;padding-right:2px;font-size:14px'>--:-- / --:--</div><div style='float:right;color:red;font-size:14px'>Has not started:&nbsp;&nbsp;</div></div></li></ul>";
                                /**Potvrzeny prichod, nepotvrzeny odchod */
                            } else if ($rows_dm->log_to == null && $rows_dm->log_from != null) {
                                if (strtotime($rows_dm->saved_to) > strtotime($rows_dm->saved_from)) {
                                    if (strtotime($rows_dm->saved_to) < strtotime(date('H:i:s'))) {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / --:--</div><div style='float:right;color:greenfont-size:14px;'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    }
                                } else {
                                    if (strtotime($rows_dm->saved_to) + 86400 < strtotime(date('H:i:s'))) {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / --:--</div><div style='float:right;color:green;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    }
                                }
                                /**Potvrzeny prichod, potvrzeny odchod */
                            } else if ($rows_dm->log_to != null && $rows_dm->log_from != null) {
                                if (strtotime($rows_dm->saved_to) > strtotime($rows_dm->saved_from)) {
                                    if (strtotime($rows_dm->saved_to) + 420 > strtotime($rows_dm->log_to)) {
                                        echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / " . substr($rows_dm->log_to, 0, -3) . "</div><div style='float:right;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";

                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / " . substr($rows_dm->log_to, 0, -3) . "</div><div style='float:right;color:#E49B0F;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    }

                                } else {
                                    if (strtotime($rows_dm->saved_from) < strtotime($rows_dm->log_to)) {
                                        $plus = 0;
                                    } else {
                                        $plus = 86400;
                                    }
                                    if (strtotime($rows_dm->saved_to) + 86820 > strtotime($rows_dm->log_to) + $plus) {
                                        echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / " . substr($rows_dm->log_to, 0, -3) . "</div><div style='float:right;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_dm->log_from, 0, -3) . " / " . substr($rows_dm->log_to, 0, -3) . "</div><div style='float:right;color:#E49B0F;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    }

                                }
                            }
                           // echo "</p></div></small>";
                        }

                    }

                }















                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        $this->sub_object($search, $data1, $data2, $data4, $icons);
                        $row++;
                        break;
                    }
                }

                echo "</div>";




            }

        }
    }

    private function sub_object($searching, $dat1, $dat2, $dat4, $icons)
    {
        //echo "54d4sa6";

        $dates = date('Y-m-d');
        $yesterdays = date('Y-m-d', strtotime($dates . ' - 1 days'));
        $find = 0;
        $shi_id = array();
        $shi_name = array();

        for ($i = 0; $i < count($dat2); $i++) {
            $shi_id = [];
            if ($searching == $dat4[$i]) {
                if ($find == 0) {
                    $find = 1;

                } else {

                }
                echo "<div style='padding: 5px;border-width: thin'>";

                echo "<h6 ><i class='$icons[$i]'></i>&nbsp;" . $dat2[$i] . " : </h6>";
                echo "<hr class='m-2 mb-1'>";
                // $sqlsh = "SELECT * FROM create_shift WHERE object_id='$dat1[$i]' ";
                //$fetchc = mysqli_query($conn2, $sqlsh);
                $fetchc_counter = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$dat1[$i]'");
                // echo "SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$dat1[$i]";
                if ($fetchc_counter[0]->count > 0) {
                    $fetchc = DB::select("SELECT * FROM shift_model WHERE id_object='$dat1[$i]'");

                    foreach ($fetchc as $rfetchc) {
                        array_push($shi_id, $rfetchc->id_shift);
                        array_push($shi_name, $rfetchc->shift_name);
                    }
                    /* while ($rows_c = mysqli_fetch_assoc($fetchc)) {
                       array_push($shi_id, $rows_c['id_shift']);
                       array_push($shi_name, $rows_c['shift_name']);
             
                     }*/
                    for ($k = 0; $k < count($shi_id); $k++) {
                       
                        //$sqldd[$k] = "SELECT * FROM saved_shift_data LEFT JOIN attendance ON saved_shift_data.id = attendance.planned_id WHERE (id_of_shift='$shi_id[$k]' AND saved_date='$date') OR (id_of_shift='$shi_id[$k]' AND saved_date='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL) ";
                       // $sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_active = attendance.id_attendance WHERE (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$dates' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$yesterdays' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";
                        $sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_shift=attendance.id_shift AND shift_active_data.saved_at=attendance.saved_at AND shift_active_data.id=attendance.id WHERE (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$dates' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$yesterdays' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";
                    }
                    for ($k = 0; $k < count($shi_id); $k++) {
                        //echo $sqldd[$k];
                      
                        // echo  $sqldd[$k];
                        //fetchdd = mysqli_query($conn2, $sqldd[$k]);
                        $fetchdd = DB::select($sqldd[$k]);
                        //while ($rows_d = mysqli_fetch_assoc($fetchdd)) {
                        foreach ($fetchdd as $rows_d) {
                            //echo $sqldd[$k];
                            if ($rows_d->saved_at == $yesterdays) {
                                $add_y = "(yesterday)";
                            } else {
                                $add_y = "";
                            }
                           
                            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$rows_d->main_id' ");
          
                            if ($fetch_img_count[0]->count > 0) {
                                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id='$rows_d->main_id' ");
                                $link_image = "";
                                foreach ($fetch_link as $result_link) {
                                    $link_image = $result_link->image_link;
                                }
                                $imageUrl = Storage::url($link_image);
                            } else {
                                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                            }
                   
                            echo " <ul class='list-group'><li class='list-group-item'><div class='row'><div class='col-12 col-md-7'><p class='m-0' style='display:inline; font-size:14px'>" . substr($rows_d->saved_from, 0, -3) . "-" . substr($rows_d->saved_to, 0, -3) . " " . $shi_name[$k] . " " . $add_y . " | <img src='$imageUrl' class='rounded-circle object-fit-cover' 
                 style='height: 25px; width: 25px'><strong>&nbsp;" . $rows_d->last_name . " " . $rows_d->middle_name . " " . $rows_d->first_name . "</strong> </p></div><div class='col-12 col-md-5 d-flex d-md-block justify-content-start'>";
                            /**Smena jeste nezacala */
                            //return null;
                            if ($rows_d->log_from == null && strtotime($rows_d->saved_from) > strtotime(date('H:i:s'))) {
                                echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>--:-- / --:--</div><div class='d-flex d-md-block justify-content-start' style='float:right;font-size:14px'>Has not started:&nbsp;&nbsp;</div></div></li></ul>";
                                /**Smena zacal, ale prichod neni potvrzeny */
                            } else if ($rows_d->log_from == null) {
                                echo "<div style='border-width: thin;float:right;color:red;padding-left:2px;padding-right:2px;font-size:14px'>--:-- / --:--</div><div class='d-flex d-md-block justify-content-start' style='float:right;color:red;font-size:14px'>Has not started:&nbsp;&nbsp;</div></div></li></ul>";
                                //echo "<div class='col-12'><div class='row'><div class='col-9'><p>ds</p></div><div class='col-3'><div style='border-width: thin;float:right;color:red'>--:-- / --:--</div></div></div></div>";

                                /**Potvrzeny prichod, nepotvrzeny odchod */
                            } else if ($rows_d->log_to == null && $rows_d->log_from != null) {
                                if (strtotime($rows_d->saved_to) > strtotime($rows_d->saved_from)) {
                                    if (strtotime($rows_d->saved_to) < strtotime(date('H:i:s'))) {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / --:--</div><div style='float:right;color:green;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    }
                                } else {
                                    if (strtotime($rows_d->saved_to) + 86400 < strtotime(date('H:i:s'))) {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / --:--</div><div style='float:right;color:green;font-size:14px'>Active:&nbsp;&nbsp;</div></div></li></ul>";
                                    }
                                }
                                /**Potvrzeny prichod, potvrzeny odchod */
                            } else if ($rows_d->log_to != null && $rows_d->log_from != null) {
                                if (strtotime($rows_d->saved_to) > strtotime($rows_d->saved_from)) {
                                    if (strtotime($rows_d->saved_to) + 420 > strtotime($rows_d->log_to)) {
                                        echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / " . substr($rows_d->log_to, 0, -3) . "</div><div style='float:right;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";

                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / " . substr($rows_d->log_to, 0, -3) . "</div><div style='float:right;color:#E49B0F;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    }

                                } else {
                                    if (strtotime($rows_d->saved_from) < strtotime($rows_d->log_to)) {
                                        $plus = 0;
                                    } else {
                                        $plus = 86400;
                                    }
                                    if (strtotime($rows_d->saved_to) + 86820 > strtotime($rows_d->log_to) + $plus) {
                                        echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / " . substr($rows_d->log_to, 0, -3) . "</div><div style='float:right;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    } else {
                                        echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px;font-size:14px'>" . substr($rows_d->log_from, 0, -3) . " / " . substr($rows_d->log_to, 0, -3) . "</div><div style='float:right;color:#E49B0F;font-size:14px'>Ended:&nbsp;&nbsp;</div></div></li></ul>";
                                    }

                                }
                            }
                            //echo "</div>";
                        }

                    }

                }


                //$dd++;
                $row = 0;
                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->sub_object($sea, $dat1, $dat2, $dat4, $icons);
                            break;
                        }
                    }
                }


                // echo "<hr>";
                echo "</div>";

                //echo "<br>";
            }
        }


    }

}

?>