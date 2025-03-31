<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\JsonResponse;
class ApiSearchController extends Controller
{
    function search(Request $request): JsonResponse
    {

        $input = $request->search;

        $admin = $request->admin;
        $manager = $request->manager;
        $fullTime = $request->fullTime;
        $partTime = $request->partTime;




        $arr = array();
        $arr_filter = array();
        $allowed_positions = array();
        if($admin == 0 && $manager == 0 && $fullTime == 0 && $partTime == 0){


        }else{
            if($admin == 1){
                array_push($allowed_positions, "admin");
            }
            if($manager == 1){
                array_push($allowed_positions, "manager");
            }
            if($fullTime == 1 ){
                array_push($allowed_positions, "fulltime");

            }
            if($partTime == 1){
                array_push($allowed_positions, "parttime");

            }
        }
        trim($input);

        $arr = explode(" ", $input);



        $quer = array();
        $quer2 = array();
        $quer3 = array();
        $id_arr = array();
        $firstname_arr = array();
        $middlename_arr = array();
        $lastname_arr = array();
        $position_arr = array();
        $email_arr = array();
        $status_arr = array();
        $code_arr = array();
        $phone_arr = array();
        $json = [];
        $c = 0;
        $counter = 0;
        if (count($arr) != 0) {
            for ($x = 0; $x < count($arr); $x++) {
                if ($arr[$x] != "") {
                    $arr_filter[$counter] = $arr[$x];
                    $counter++;
                }
            }

        }

        if ($arr[0] == null) {
            $quer[$c] = "SELECT * FROM users";
            $c++;
        } else if ($counter == 1) {
            for ($i = 0; $i < 1; $i++) {
                for ($x = 0; $x < 1; $x++) {
                    for ($z = 0; $z < 1; $z++) {

                        $quer[$c] = "SELECT * FROM users WHERE first_name LIKE '$arr_filter[$i]%' ";
                        $c++;
                        $quer[$c] = "SELECT * FROM users WHERE middle_name LIKE '$arr_filter[$x]%' ";
                        $c++;
                        $quer[$c] = "SELECT * FROM users WHERE last_name LIKE '$arr_filter[$z]%' ";
                        $c++;
                    }
                }
            }
        } else if ($counter == 2) {

            for ($i = 0; $i < 2; $i++) {
                for ($x = 0; $x < 2; $x++) {
                    if ($i != $x) {
                        $quer[$c] = "SELECT * FROM users WHERE first_name LIKE '$arr_filter[$i]%' AND middle_name LIKE '$arr_filter[$x]%' ";
                        $c++;
                        $quer[$c] = "SELECT * FROM users WHERE first_name LIKE '$arr_filter[$i]%' AND last_name LIKE '$arr_filter[$x]%' ";
                        $c++;
                        $quer[$c] = "SELECT * FROM users WHERE middle_name LIKE '$arr_filter[$i]%' AND last_name LIKE '$arr_filter[$x]%' ";
                        $c++;
                    }

                }
            }
        } else if ($counter == 3) {
            for ($i = 0; $i < 3; $i++) {
                for ($x = 0; $x < 3; $x++) {
                    for ($z = 0; $z < 3; $z++) {

                        if ($i != $x && $i != $z && $z != $x) {
                            $quer[$c] = "SELECT * FROM users WHERE first_name LIKE '{$arr_filter[$i]}%' AND middle_name LIKE '{$arr_filter[$x]}%' AND last_name LIKE '{$arr_filter[$z]}%' ";
                            $c++;
                        }

                    }
                }
            }
        } else if ($counter >= 4) {
            $arr_multiple = array();
            $arr_multiple[0] = $arr_filter[0];
            $arr_multiple[1] = "";
            $arr_multiple[2] = $arr_filter[$counter - 1];
            for ($i = 1; $i < count($arr_filter) - 1; $i++) {
                $arr_multiple[1] = $arr_multiple[1] . " " . $arr_filter[$i];

            }
            for ($i = 0; $i < 3; $i++) {
                for ($x = 0; $x < 3; $x++) {
                    for ($z = 0; $z < 3; $z++) {

                        if ($i != $x && $i != $z && $z != $x) {
                            $quer[$c] = "SELECT * FROM users WHERE first_name LIKE '{$arr_multiple[$i]}%' AND middle_name LIKE '{$arr_multiple[$x]}%' AND last_name LIKE '{$arr_multiple[$z]}%' ";
                            $c++;
                        }

                    }
                }
            }
        }

        for ($d = 0; $d < $c; $d++) {
            $fetch_users = DB::select($quer[$d]);

            foreach ($fetch_users as $result_users) {
                if (in_array($result_users->id, $id_arr)) {

                } else {
                    array_push($id_arr, $result_users->id);
                    array_push($firstname_arr, $result_users->first_name);
                    array_push($middlename_arr, $result_users->middle_name);
                    array_push($lastname_arr, $result_users->last_name);
                    array_push($position_arr, $result_users->role);
                    array_push($email_arr, $result_users->email);
                    array_push($status_arr, $result_users->status);
                }

            }



        }
        array_multisort(
            
            $firstname_arr, SORT_ASC,
            $lastname_arr, SORT_ASC,
            $middlename_arr, SORT_ASC,
            $position_arr, SORT_ASC,
            $email_arr, SORT_ASC,
            $status_arr, SORT_ASC,
            $id_arr, SORT_ASC,
        );

        if (count($id_arr) == 0) {
          
        } else {
   
            for ($d = 0; $d < count($id_arr); $d++) {
                $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $id_arr[$d]");
                if ($fetch_count[0]->count > 0) {
                    $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $id_arr[$d]");
                    $link_image = "";
                    foreach ($fetch_link as $result_link) {
                        $link_image = $result_link->image_link;
                    }
                    $imageUrl = Storage::url($link_image);
                } else {
                    $imageUrl = Storage::url('/profile-images/avatar_blank2.jpg');
                }
                if (in_array($position_arr[$d], $allowed_positions) || count($allowed_positions) == 0) {
                array_push($json, [
                    "id" => $id_arr[$d],
                    "firstname" => $firstname_arr[$d],
                    "middlename" => $middlename_arr[$d],
                    "lastname" => $lastname_arr[$d],
                    "position" => $position_arr[$d], 
                    "email" => $email_arr[$d], 
                    "status" => $status_arr[$d],
                    "profile_url" => $imageUrl,

                ]);  
            }
    


              
            }
        }
 
        return response()->json(
            [
                "status" => "success",
                "data"=> $json,                
                "message" => "Successfull verification"
            ],
            200
        );
    }
    function upComming(Request $request): JsonResponse
    {
        $id = $request->id;
        $date = $request->date;

        $json = "";
        $selected_shift = DB::select("SELECT * FROM shift_active_data, shift_model, object_model WHERE shift_active_data.saved_at='$date' AND shift_active_data.id='$id' AND shift_model.id_shift = shift_active_data.id_shift AND shift_model.id_object = object_model.id_object ORDER BY shift_active_data.saved_from");

        foreach($selected_shift as $result){
            $json  .= '{"id": '.$result->id.', "color": "'.$result->color.'", "object": "'.$result->object_name.'", "shift": "'.$result->shift_name.'", "from": "'.$result->saved_from.'", "to": "'.$result->saved_to.'"}';

        }
        $json = '['.$json.']';
        $array = json_decode($json, true);

        return response()->json(
            [
                "status" => "success",
                "data"=> $array,                
                "message" => "Successfull verification"
            ],
            200
        );
    }

    function employeeDetail(Request $request): JsonResponse
    {
        $id = $request->id;
        error_log( $request->id);

        
        $selected_user = DB::select("SELECT * FROM users WHERE id='$id'");

        foreach($selected_user as $user){
            $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $user->id");
            if ($fetch_count[0]->count > 0) {
              $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $user->id");
              $link_image = "";
              foreach ($fetch_link as $result_link) {
                $link_image = $result_link->image_link;
              }
              $imageUrl = Storage::url($link_image);
            } else {
              $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            }
            return response()->json(
                [
                    "status" => "success",
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'bio' => $user->bio,
                    'firstname' => $user->first_name,
                    'middlename' => $user->middle_name,
                    'lastname' => $user->last_name,
                    'phone_number' => $user->phone_number,        
                    'phone_code' => $user->phone_code,               
                    'profile_url' => $imageUrl,  
                    'joined' => $user->created_at,             
                    "message" => "Successfull verification"
                ],
                200
            );
        }
        return response()->json(
            [
                "status" => "error",           
                "message" => "Failed to find user"
            ],
        404
        );



    }

    public function mainObjects(Request $request): JsonResponse
    {
        $fetch = DB::select("SELECT * FROM object_model WHERE superior_object_id=0 ORDER BY object_name");
        $object_id = array();
        $object_name = array();
        $object_superior = array();
        $json = "";
        $jsonArray = [];
        foreach ($fetch as $result) {
        
            $jsonArray[] = [
                "id" => $result->id_object,
                "name" => $result->object_name,
                "icon" => $result->object_icon
            ];
        }


        return response()->json(
            [
                "status" => "success",    
                "data" => $jsonArray,
                "message" => "Successfull transfer",
            ],
        200
        );

    }

    public function organization(Request $request): JsonResponse
    {
        $json = "";
        $jsonArray = [];

        $input_decrypt = $request->id;
        $date = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($date . ' - 1 days'));

        $data_name = array();

        /**
         * 0 - neaktivni
         * 1 - wrong
         * 2 - warning
         * 3 - active  *
         */
        $status = 0;
        $logFrom = "--:--";
        $logTo = "--:--";

        $finder = 0;


        $fetch_object = DB::select("SELECT * FROM object_model");
        $data2 = array();
        $icons = array();
        $data3 = array();
        $numberval = array();


        foreach ($fetch_object as $result_object) {
            $data1[] = $result_object->id_object;
            $data2[] = $result_object->object_name;
            $data4[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
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
                $iid = 0;
       
                $dd++;


                $row = 0;
                $shi_idm = array();
                $shi_namem = array();
                $shi_color = array();

                error_log($data1[$x]);

                $fetchcm_count = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$data1[$x]' ");
                $fetchcm = DB::select("SELECT * FROM shift_model WHERE id_object='$data1[$x]' ");

                if ($fetchcm_count[0]->count > 0) {

                    foreach ($fetchcm as $rfetchcm) {
                        array_push($shi_idm, $rfetchcm->id_shift);
                        array_push($shi_namem, $rfetchcm->shift_name);
                        array_push($shi_color, $rfetchcm->color);
                    }
                    

                    for ($k = 0; $k < count($shi_idm); $k++) {
/**source https://dba.stackexchange.com/questions/257618/how-to-select-all-columns-plus-one-alias-column-in-mysql */
                        //$sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_active = attendance.id_attendance WHERE (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$date' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";
                      //  $sqldd[$k] = "SELECT *, users.id as main_id FROM users, attendance WHERE (attendance.id_shift='$shi_idm[$k]' AND attendance.saved_at='$date' AND users.id=attendance.id) OR (attendance.id_shift='$shi_idm[$k]' AND attendance.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=attendance.id) ";
                        $sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_shift=attendance.id_shift AND shift_active_data.saved_at=attendance.saved_at AND shift_active_data.id=attendance.id WHERE (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$date' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_idm[$k]' AND shift_active_data.saved_at='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";

                    }
                    for ($k = 0; $k < count($shi_idm); $k++) {

                        $status = 0;
                        $logFrom = "--:--";
                        $logTo = "--:--";
                        $fetchddm = DB::select($sqldd[$k]);
               
                        foreach ($fetchddm as $rows_dm) {
                            $status = 0;
                            $logFrom = "--:--";
                            $logTo = "--:--";
                            $finder++;
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
                            
                            /**Smena jeste nezacala */
                            if ($rows_dm->log_from == null && strtotime($rows_dm->saved_from) > strtotime(date('H:i:s'))) {
                                /**Smena zacal, ale prichod neni potvrzeny */
                                $status = 0;
                                $logFrom = "--:--";
                                $logTo = "--:--";
                            } else if ($rows_dm->log_from == null) {
                                /**Potvrzeny prichod, nepotvrzeny odchod */
                                $status = 1;
                                $logFrom = "--:--";
                                $logTo = "--:--";
                            } else if ($rows_dm->log_to == null && $rows_dm->log_from != null) {
                                if (strtotime($rows_dm->saved_to) > strtotime($rows_dm->saved_from)) {
                                    if (strtotime($rows_dm->saved_to) < strtotime(date('H:i:s'))) {
                                        $status = 2;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = "--:--";
                                    } else {
                                        $status = 3;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = "--:--";
                                    }
                                } else {
                                    if (strtotime($rows_dm->saved_to) + 86400 < strtotime(date('H:i:s'))) {
                                        $status = 2;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = "--:--";
                                    } else {
                                        $status = 3;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = "--:--";
                                    }
                                }
                                /**Potvrzeny prichod, potvrzeny odchod */
                            } else if ($rows_dm->log_to != null && $rows_dm->log_from != null) {
                                if (strtotime($rows_dm->saved_to) > strtotime($rows_dm->saved_from)) {
                                    if (strtotime($rows_dm->saved_to) + 420 > strtotime($rows_dm->log_to)) {
                                        $status = 0;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = substr($rows_dm->log_to, 0, -3);
                                    } else {
                                        $status = 2;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = substr($rows_dm->log_to, 0, -3);
                                    }

                                } else {
                                    if (strtotime($rows_dm->saved_from) < strtotime($rows_dm->log_to)) {
                                        $plus = 0;
                                    } else {
                                        $plus = 86400;
                                    }
                                    if (strtotime($rows_dm->saved_to) + 86820 > strtotime($rows_dm->log_to) + $plus) {
                                        $status = 0;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = substr($rows_dm->log_to, 0, -3);
                                    } else {
                                        $status = 2;
                                        $logFrom = substr($rows_dm->log_from, 0, -3);
                                        $logTo = substr($rows_dm->log_to, 0, -3);
                                    }

                                }
                            }
                            if($finder == 1){
                                array_push($jsonArray, [
                                    "id" => $iid,
                                    "name" => $data2[$x],
                                    "icon" => $icons[$x],
                                    "color" => "#000000",
                                    "from" => "00:00",
                                    "to" => "00:00",
                                    "logFrom" => "00:00",
                                    "logTo" => "00:00",
                                    "shift" => "No shift",
                                    "imgURL" => "/profile-images/avatar_blank2.jpg",
                                    "status" => "0",
                                    "comment" => $rows_dm->comment_on
                                ]);
                            }
                            array_push($jsonArray, [
                                "id" => $rows_dm->id_attendance,
                                "name" => $rows_dm->last_name . " " . $rows_dm->middle_name . " " . $rows_dm->first_name,
                                "icon" => "bi none",
                                "color" => $shi_color[$k],
                                "from" => substr($rows_dm->saved_from, 0, -3),
                                "to" => substr($rows_dm->saved_to, 0, -3),
                                "logFrom" => $logFrom,
                                "logTo" => $logTo,
                                "shift" => $shi_namem[$k],
                                "imgURL" => $imageUrl,
                                "status" => $status,
                                "comment" => $rows_dm->comment_on
                            ]);
                        }

                    }

                }















                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        $this->sub_object($search, $data1, $data2, $data4, $icons, $jsonArray);
                        $row++;
                        break;
                    }
                }





            }
        }

        if(sizeof($jsonArray) >1){
            error_log( $jsonArray[1]['name']);


        }

        return response()->json(
            [
                "status" => "success",  
                "data" => $jsonArray,
                "message" => "OK",
            ],
        200
        );

    }
    private function sub_object($searching, $dat1, $dat2, $dat4, $icons,  array &$jsonArray)
    {

        $dates = date('Y-m-d');
        $yesterdays = date('Y-m-d', strtotime($dates . ' - 1 days'));
        $find = 0;
        $finder = 0;
        $shi_id = array();
        $shi_name = array();
        $shi_color = array();
        $status = 0;
        $logFrom = "--:--";
        $logTo = "--:--";

        for ($i = 0; $i < count($dat2); $i++) {
            $shi_id = [];
            if ($searching == $dat4[$i]) {
                if ($find == 0) {
                    $find = 1;

                } else {

                }
 
   
                $fetchc_counter = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$dat1[$i]'");
                if ($fetchc_counter[0]->count > 0) {
                   
                    $fetchc = DB::select("SELECT * FROM shift_model WHERE id_object='$dat1[$i]'");

                    foreach ($fetchc as $rfetchc) {
                        array_push($shi_id, $rfetchc->id_shift);
                        array_push($shi_name, $rfetchc->shift_name);
                        array_push($shi_color, $rfetchc->color);
                    }
              
                    for ($k = 0; $k < count($shi_id); $k++) {
                       
                        $sqldd[$k] = "SELECT *, users.id as main_id FROM users, shift_active_data LEFT JOIN attendance ON shift_active_data.id_shift=attendance.id_shift AND shift_active_data.saved_at=attendance.saved_at AND shift_active_data.id=attendance.id WHERE (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$dates' AND users.id=shift_active_data.id) OR (shift_active_data.id_shift='$shi_id[$k]' AND shift_active_data.saved_at='$yesterdays' AND log_from IS NOT NULL AND log_to IS NULL AND users.id=shift_active_data.id) ";
                    }
                    for ($k = 0; $k < count($shi_id); $k++) {
                      
                        $fetchdd = DB::select($sqldd[$k]);
                        foreach ($fetchdd as $rows_d) {
                            $finder++;
                            if ($rows_d->saved_at == $yesterdays) {
                                $add_y = "(yesterday)";
                            } else {
                                $add_y = "";
                            }
                           
                            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$rows_d->main_id' ");
                            $status = 0;
                            $logFrom = "--:--";
                            $logTo = "--:--";
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
                   
                            /**Smena jeste nezacala */
                            
                            if ($rows_d->log_from == null && strtotime($rows_d->saved_from) > strtotime(date('H:i:s'))) {
                                $status = 0;
                                $logFrom = "--:--";
                                $logTo = "--:--";
                                /**Smena zacal, ale prichod neni potvrzeny */
                            } else if ($rows_d->log_from == null) {
                                $status = 1;
                                $logFrom = "--:--";
                                $logTo = "--:--";
                                /**Potvrzeny prichod, nepotvrzeny odchod */
                            } else if ($rows_d->log_to == null && $rows_d->log_from != null) {
                                if (strtotime($rows_d->saved_to) > strtotime($rows_d->saved_from)) {
                                    if (strtotime($rows_d->saved_to) < strtotime(date('H:i:s'))) {
                                        $status = 2;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = "";
                                    } else {
                                        $status = 3;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = "--:--";
                                    }
                                } else {
                                    if (strtotime($rows_d->saved_to) + 86400 < strtotime(date('H:i:s'))) {
                                        $status = 2;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = "--:--";
                                    } else {
                                        $status = 3;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = "--:--";
                                    }
                                }
                                /**Potvrzeny prichod, potvrzeny odchod */
                            } else if ($rows_d->log_to != null && $rows_d->log_from != null) {
                                if (strtotime($rows_d->saved_to) > strtotime($rows_d->saved_from)) {
                                    if (strtotime($rows_d->saved_to) + 420 > strtotime($rows_d->log_to)) {
                                        $status = 0;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = substr($rows_d->log_to, 0, -3);
                                    } else {
                                        $status = 2;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = substr($rows_d->log_to, 0, -3);
                                    }

                                } else {
                                    if (strtotime($rows_d->saved_from) < strtotime($rows_d->log_to)) {
                                        $plus = 0;
                                    } else {
                                        $plus = 86400;
                                    }
                                    if (strtotime($rows_d->saved_to) + 86820 > strtotime($rows_d->log_to) + $plus) {
                                        $status = 0;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = substr($rows_d->log_to, 0, -3);
                                    } else {
                                        $status = 2;
                                        $logFrom = substr($rows_d->log_from, 0, -3);
                                        $logTo = substr($rows_d->log_to, 0, -3);
                                    }

                                }
                            }
                            if( $finder == 1){
                                array_push($jsonArray, [
                                    "id" => 0,
                                    "name" => $dat2[$i],
                                    "icon" => $icons[$i],
                                    "color" => "#111111",
                                    "from" => "00:00",
                                    "to" => "00:00",
                                    "logFrom" => "00:00",
                                    "logTo" => "00:00",
                                    "shift" => "No shift",
                                    "imgURL" => "/profile-images/avatar_blank2.jpg",
                                    "status" => "0",
                                    "comment" => $rows_d->comment_on
                                ]);
                            }
                            array_push($jsonArray, [
                                "id" => $rows_d->id_attendance,
                                "name" => $rows_d->last_name . " " . $rows_d->middle_name . " " . $rows_d->first_name,
                                "icon" => "bi none",
                                "color" => $shi_color[$k],
                                "from" => substr($rows_d->saved_from, 0, -3),
                                "to" => substr($rows_d->saved_to, 0, -3),
                                "logFrom" => $logFrom,
                                "logTo" => $logTo,
                                "shift" => $shi_name[$k],
                                "imgURL" => $imageUrl,
                                "status" => $status,
                                "comment" => $rows_d->comment_on
                            ]);
                        }

                    }

                }


                $row = 0;
                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->sub_object($sea, $dat1, $dat2, $dat4, $icons, $jsonArray);
                            break;
                        }
                    }
                }

            }
        }


    }

    public function searchORG(Request $request): JsonResponse
    {          
         $jsonArray = [];

        $object = $request->object;
        $date = $request->date;
        $fetch = DB::select("SELECT *, users.id as main_id FROM users, shift_active_data, object_model, shift_model WHERE shift_active_data.saved_at='$date' AND shift_active_data.id_shift=shift_model.id_shift AND shift_model.id_object='$object' AND users.id=shift_active_data.id AND object_model.id_object=shift_model.id_object ");
        error_log("SELECT *, users.id as main_id FROM users, shift_active_data, object_model, shift_model WHERE shift_active_data.saved_at='$date' AND shift_active_data.id_shift=shift_model.id_shift AND shift_model.id_object='$object' AND users.id=shift_active_data.id AND object_model.id_object=shift_model.id_object ");
        foreach ($fetch as $result){
            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$result->main_id' ");
          
            if ($fetch_img_count[0]->count > 0) {
                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id='$result->main_id' ");
                $link_image = "";
                foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                }
                $imageUrl = Storage::url($link_image);
            } else {
                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            }
            
            array_push($jsonArray, [
                "id" => $result->id_active,
                "name" => $result->last_name . " " . $result->middle_name . " " . $result->first_name,
                "color" => $result->color,
                "shift" => $result->shift_name,
                "from" => substr($result->saved_from, 0, -3),
                "to" => substr($result->saved_to, 0, -3),
                "image" => $imageUrl,

            ]);
        }
        
        return response()->json(
            [
                "status" => "success",  
                "data" => $jsonArray ,
                "message" => "OK",
            ],
        200
        );

    }
    public function getAssignments(Request $request):JsonResponse
    {     
        $jsonArray = [];
        $id_request = $request->id;
        $id = Auth::id();

        $id_obj = array();
        $name_obj = array();
        $superior_obj = array();
        $icons = array();
     

        $fetch = DB::select("SELECT * FROM object_model ");
        foreach ($fetch as $result) {

            $id_obj[] = $result->id_object;
            $name_obj[] = $result->object_name;
            $superior_obj[] = $result->superior_object_id;
            $icons[] = $result->object_icon;


        }
        array_multisort($id_obj, $name_obj, $superior_obj);
        for ($x = 0; $x < count($name_obj); $x++) {
            if ($id_obj[$x] == $id_request) {

                $replace = $superior_obj[$x];
                $checkAssignmentExistance = 0;

                $fetch_shift = DB::select("SELECT * FROM shift_model, shift_assignment WHERE shift_assignment.id=$id AND shift_assignment.id_shift=shift_model.id_shift AND shift_model.id_object='$id_obj[$x]' ");
      
                foreach ($fetch_shift as $result_shift) {
                    if($checkAssignmentExistance == 0){
                        array_push($jsonArray, [
                            "id" => 0,
                            "name" => $name_obj[$x],
                            "color" => "#00FFFFFF",
                            "icon" => $icons[$x],
            
                        ]);
                        $checkAssignmentExistance++;
                    }
                    array_push($jsonArray, [
                        "id" => $result_shift->id_shift,
                        "name" => $result_shift->shift_name,
                        "color" => $result_shift->color,
                        "icon" => "bi bi-house",
        
                    ]);
          
        
                }

                $row = 0;
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($id_obj[$x]  == $superior_obj[$h]) {
                       $this->subObjectAssignment($id_obj[$x], $id_obj, $name_obj, $superior_obj, $id, $icons, $jsonArray );
                        $row++;
                        break;
                    }
                }
                break;

            }

        }  
        return response()->json(
            [
                "status" => "success",  
                "data" => $jsonArray ,
                "message" => "OK",
            ],
        200
        );
    }
    
    private function subObjectAssignment($searching, $id_object, $name_object, $id_parent, $id, $icons, array &$jsonArray)
{
    static $dd = 1;
    $find = 0;

    for ($i = 0; $i < count($id_object); $i++) {
        $find2 = 0;
        if ($searching == $id_parent[$i]) {
            $fetch_shift_sub_count = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$id_object[$i]' ");
            $counter_sub = $fetch_shift_sub_count[0]->count;
 

            $checkAssignmentExistance = 0;
            $fetch_shift_sub = DB::select("SELECT * FROM shift_model, shift_assignment WHERE shift_assignment.id=$id AND shift_assignment.id_shift=shift_model.id_shift AND id_object='$id_object[$i]' ");
            foreach ($fetch_shift_sub as $result_shift_sub) {
                if($checkAssignmentExistance == 0){
                    array_push($jsonArray, [
                        "id" => 0,
                        "name" => $name_object[$i],
                        "color" => "#00FFFFFF",
                        "icon" => $icons[$i],
        
                    ]);
                    $checkAssignmentExistance++;
                }
                array_push($jsonArray, [
                    "id" => $result_shift_sub->id_shift,
                    "name" => $result_shift_sub->shift_name,
                    "color" => $result_shift_sub->color,
                    "icon" => "bi bi-house",
    
                ]);

    
            }

            if ($id_object[$i] != null) {
                for ($h = 0; $h < count($id_object); $h++) {
                    if ($id_object[$i] == $id_parent[$h]) {
                        $this->subObjectAssignment($id_object[$i], $id_object, $name_object, $id_parent, $id, $icons, $jsonArray);
                        break;
                    }
                }
            }
        }
    }


}


}
?>