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


class ShiftController extends Controller
{
    public function deleteShift(Request $request)
    {

        $shift_id = $request->input('shift_id');
        $id_decrypted = Crypt::decrypt($shift_id);
        DB::delete("DELETE FROM shift_model WHERE id_shift='$id_decrypted' " );
        DB::delete("DELETE FROM shift_assignment WHERE id_shift='$id_decrypted' " );
        DB::delete("DELETE FROM shift_check WHERE id_shift='$id_decrypted' " );
        DB::delete("DELETE FROM shift_offer WHERE id_shift='$id_decrypted' " );
        DB::delete("DELETE FROM shift_active_data WHERE id_shift='$id_decrypted' " );

    }
    public function enableShift(Request $request)
    {

        $shift_id = $request->input('shift_id');
        $status = $request->input('status');
        $id_decrypted = Crypt::decrypt($shift_id);
        DB::update("UPDATE shift_model SET rep_non='$status' WHERE id_shift='$id_decrypted' ");

    }
    public function loadExistingObjects(Request $request)
    {
        $fetch = DB::select("SELECT * FROM object_model ");
        $data1 = array();
        $data2 = array();
        $data4 = array();
        foreach ($fetch as $result) {
            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            $data4[] = $result->superior_object_id;
        }
        for ($x = 0; $x < count($data1); $x++) {
            if (($data4[$x] == 0)) {
                $encrypted = Crypt::encrypt($data1[$x]);
                echo "<option value='$encrypted ' seleted='selected'>";
                echo $data2[$x];
                echo "</option>";

            }
        }

    }
    public function editShift(Request $request)
    {
        $mon_f = $request->input('mf');
        $mon_t = $request->input('mt');
        $mon = $request->input('mond');

        $tue_f = $request->input('tuf');
        $tue_t = $request->input('tut');
        $tue = $request->input('tued');

        $wed_f = $request->input('wf');
        $wed_t = $request->input('wt');
        $wed = $request->input('wedd');

        $thu_f = $request->input('thf');
        $thu_t = $request->input('tht');
        $thu = $request->input('thud');

        $fri_f = $request->input('ff');
        $fri_t = $request->input('ft');
        $fri = $request->input('frid');

        $sat_f = $request->input('saf');
        $sat_t = $request->input('sat');
        $sat = $request->input('satd');

        $sun_f = $request->input('suf');
        $sun_t = $request->input('sut');
        $sun = $request->input('sund');

        $repeat = $request->input('repeat');

        $jobname = $request->input('jobname');
        $color = $request->input('color');
        $update = $request->input('update');
        $description = $request->input('description');

        $shift_id = $request->input('shift_id');
        $shift_id_decrypted = Crypt::decrypt($shift_id);


        $start = date("Y-m-d");

        $id = Auth::id();

        $object = $request->input('object');
        $object_decrypted = Crypt::decrypt($object);
        DB::update("UPDATE shift_model SET rep_non='$repeat', monday='$mon', mon_from='$mon_f', mon_to='$mon_t', tuesday='$tue', tue_from='$tue_f', tue_to='$tue_t', wednesday='$wed', wed_from='$wed_f', wed_to='$wed_t', thursday='$thu', thu_from='$thu_f', thu_to='$thu_t', friday='$fri', fri_from='$fri_f', fri_to='$fri_t', saturday='$sat', sat_from='$sat_f', sat_to='$sat_t', sunday='$sun', sun_from='$sun_f', sun_to='$sun_t', shift_name='$jobname', color='$color', id_object='$object_decrypted', description='$description' WHERE id_shift='$shift_id_decrypted' ");

    }
    public function loadExistingShiftParametrs(Request $request)
    {
        $id = $request->input('id');
        $id_decrypted = Crypt::decrypt($id);
        $fetch = DB::select("SELECT * FROM shift_model WHERE id_shift='$id_decrypted' ");
        foreach ($fetch as $result) {
            $repeat = $result->rep_non;
            $shift_id = $result->id_shift;
            $monday = $result->monday;
            $mon_from = $result->mon_from;
            $mon_to = $result->mon_to;
            $tuesday = $result->tuesday;
            $tue_from = $result->tue_from;
            $tue_to = $result->tue_to;
            $wednesday = $result->wednesday;
            $wed_from = $result->wed_from;
            $wed_to = $result->wed_to;
            $thursday = $result->thursday;
            $thu_from = $result->thu_from;
            $thu_to = $result->thu_to;
            $friday = $result->friday;
            $fri_from = $result->fri_from;
            $fri_to = $result->fri_to;
            $saturday = $result->saturday;
            $sat_from = $result->sat_from;
            $sat_to = $result->sat_to;
            $sunday = $result->sunday;
            $sun_from = $result->sun_from;
            $sun_to = $result->sun_to;
            $shift_name = $result->shift_name;
            $color = $result->color;
            $id_object = $result->id_object;
            $description = $result->description;


        }
        $obj_id = array();
        $obj_name = array();
        $obj_superior = array();
        $final_id = array();
        $local_id = array();

        $fetch_object = DB::select("SELECT * FROM object_model ");
        foreach ($fetch_object as $result_obj) {
            $obj_id[] = $result_obj->id_object;
            $obj_name[] = $result_obj->object_name;
            $obj_superior[] = $result_obj->superior_object_id;
        }
        for ($x = 0; $x < count($obj_id); $x++) {

            if ($obj_superior[$x] == 0) {
                $shift_arr = array();
                $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$obj_id[$x]'  ");
                foreach ($fetch_shifts as $result_shift) {
                    array_push($shift_arr, $result_shift->id_shift);
                }

                if (in_array($shift_id, $shift_arr) && count($shift_arr) != null) {
                    array_push($final_id, $obj_id[$x]);
                    array_push($local_id, $obj_id[$x]);
                    break;


                } else {
                    for ($h = 0; $h < count($obj_id); $h++) {
                        if ($obj_id[$x] == $obj_superior[$h]) {
                            $this->search_shift($obj_id[$x], $obj_id, $obj_name, $obj_superior, $shift_id, $final_id, $obj_id[$x], $local_id);
                            break;
                        }
                    }
                }
            }

        }
        $main_object = Crypt::encrypt($final_id[0]);
        $sub_object = Crypt::encrypt($local_id[0]);
        $shift_id_decrypted = Crypt::encrypt($shift_id);


        return response()->json([
            'data1' => $id,
            'data2' => $id_decrypted,
            'monday' => $monday,
            'mon_from' => $mon_from,
            'mon_to' => $mon_to,
            'tuesday' => $tuesday,
            'tue_from' => $tue_from,
            'tue_to' => $tue_to,
            'wednesday' => $wednesday,
            'wed_from' => $wed_from,
            'wed_to' => $wed_to,
            'thursday' => $thursday,
            'thu_from' => $thu_from,
            'thu_to' => $thu_to,
            'friday' => $friday,
            'fri_from' => $fri_from,
            'fri_to' => $fri_to,
            'saturday' => $saturday,
            'sat_from' => $sat_from,
            'sat_to' => $sat_to,
            'sunday' => $sunday,
            'sun_from' => $sun_from,
            'sun_to' => $sun_to,
            'shift_name' => $shift_name,
            'color' => $color,
            'id_object' => $id_object,
            'main_object' => $main_object,
            'sub_object' => $sub_object,
            'shift_id' => $shift_id_decrypted,
            'repeat' => $repeat,
            'description' => $description,

        ]);
    }
    public function shiftSave(Request $request)
    {
 

        $mon_f = $request->input('mf');
        $mon_t = $request->input('mt');
        $mon = $request->input('mond');

        $tue_f = $request->input('tuf');
        $tue_t = $request->input('tut');
        $tue = $request->input('tued');

        $wed_f = $request->input('wf');
        $wed_t = $request->input('wt');
        $wed = $request->input('wedd');

        $thu_f = $request->input('thf');
        $thu_t = $request->input('tht');
        $thu = $request->input('thud');

        $fri_f = $request->input('ff');
        $fri_t = $request->input('ft');
        $fri = $request->input('frid');

        $sat_f = $request->input('saf');
        $sat_t = $request->input('sat');
        $sat = $request->input('satd');

        $sun_f = $request->input('suf');
        $sun_t = $request->input('sut');
        $sun = $request->input('sund');

        $jobname = $request->input('jobname');
        $color = $request->input('color');
        $update = $request->input('update');


        $start = date("Y-m-d");
        $rep = 1;
    

        $id = Auth::id();
        $object = $request->input('object');
        $object_decrypted = Crypt::decrypt($object);
        DB::insert("INSERT INTO shift_model (start_shift, rep_non, monday, mon_from, mon_to, tuesday, tue_from, tue_to, wednesday, wed_from, wed_to, thursday, thu_from, thu_to, friday, fri_from, fri_to, saturday, sat_from, sat_to, sunday, sun_from, sun_to, shift_name, color, id_object, created_by) VALUES ('$start','$rep','$mon','$mon_f','$mon_t','$tue','$tue_f','$tue_t','$wed','$wed_f','$wed_t','$thu','$thu_f','$thu_t','$fri','$fri_f','$fri_t','$sat','$sat_f','$sat_t','$sun','$sun_f','$sun_t','$jobname','$color','$object_decrypted', '$id')");

    }
    public function loadObjectStructure(Request $request)
    {
        $object = $request->input('object');

        $is_encrypte = 0;


        if ($object == "0") {
            $is_encrypte = 1;

        } else {
            $object_decrypted = Crypt::decrypt($object);
        }

        $sub_object = $request->input('sub_object');

        $is_sub_encrypte = 0;
        $object_sub_decrypted = "";

        if ($sub_object == "0") {
            $is_sub_encrypte = 1;

        } else {
            $object_sub_decrypted = Crypt::decrypt($sub_object);
        }



        $search_main = "";
        $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $data1 = array();
        $data2 = array();

        $data4 = array();
        $icons = array();
        $encrytion = array();
        $previous = 0;

        foreach ($fetch as $result) {

            $data1[] = $result->id_object;
            $data2[] = $result->object_name;


            $data4[] = $result->superior_object_id;
            $icons[] = $result->object_icon;
        }
        $encrytion = array();
        foreach ($data1 as $d) {
            $encrytion[$d] = Crypt::encrypt($d);
        }
        for ($x = 0; $x < count($data1); $x++) {

            $data1[$x] = $encrytion[$data1[$x]];
            if ($data4[$x] == 0) {

                $data4[$x] = 0;
            } else {

                $data4[$x] = $encrytion[$data4[$x]];
            }
        }
        if ($is_encrypte == 0) {
            $search_main = $encrytion[$object_decrypted];
        }

        $search = "";



        for ($x = 0; $x < count($data2); $x++) {

            if (($data4[$x] == 0 && $is_encrypte == 1) || ($data1[$x] == $search_main && $is_encrypte == 0)) {
                static $dd = 1;

                $search = $data1[$x] . "";




                echo "<div class='accordion w-100' id='$data1[$x]'>";

                echo "<button data-mdb-dropdown-init class='dropdown-toggle btn btn-primary' id='menu' role='button' data-mdb-toggle='dropdown' data-bs-toggle='dropdown' style='min-width:230px' aria-expanded='false' clicked='true'><i class='$icons[$x]'></i>&nbsp;";
                echo $data2[$x];
                echo "</button><ul class='dropdown-menu' id='drop_menu' aria-labelledby='menu'>";
                echo "" . objectDropdownShift($encrytion, $sub_object) . "</ul>";
                if ($is_sub_encrypte == 0 && $object_sub_decrypted == Crypt::decrypt($data1[$x])) {
                    echo "<div style='float: right' class='mt-2'><input id='" . $data1[$x] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)'  class='hidden radio-label' checked >";
                } else {
                    echo "<div style='float: right' class='mt-2'><input id='" . $data1[$x] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)'  class='hidden radio-label' >";

                }
                echo "<label for='yes-button' class='button-label mt-0' style='margin-left: 15px;margin-right: 15px;  '>Select </label> </div>";

                $dd++;


                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        sub_object_model($search, $data1, $data2, $data4, $previous, $object_sub_decrypted, $is_sub_encrypte, $icons);
                        break;
                    }
                }

                echo "</div>";




                break;

            }


        }



    }



    public function loadExistingListShift(Request $request)
    {




        $fetch = DB::select("SELECT * FROM object_model ");
        $data2 = array();
        $data3 = array();
        $data1 = array();
        $data4 = array();
        $get_id = array();
        $get_name = array();
        $sm = array();
        $get_object = array();
        $numberval = array();
        $arr[][] = array();
        $arr2[][] = array();
        $arr_help = array();
        $arr_help2 = array();
        $rows = 0;
        $help = 0;
        $shi_name = array();
        $shi_id = array();
        $shi_help = array();

        $object = $request->input('object');
        $is_encrypted = 0;
        $object_decrypted = -1;

        if ($object == "0") {
            $is_encrypted = 1;
        } else {
            $object_decrypted = Crypt::decrypt($object);
        }

        foreach ($fetch as $result) {
            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            $data4[] = $result->superior_object_id;
        }

        $count = 0;
        $dd = 1;
        for ($x = 0; $x < count($data2); $x++) {
            if (($data4[$x] == 0 && $is_encrypted == 1) || ($data1[$x] == $object_decrypted && $is_encrypted == 0)) {
                static $dd = 1;
                $b = false;
                $help = 0;
                $search = $data1[$x] . "";
                $numberval[$count] = $data1[$x] . "";
                $count++;
                $rows = 0;
                $help = 0;
                $pus = 1;

                $dd++;
                $fetch_sh = DB::select("SELECT * FROM shift_model WHERE id_object='$data1[$x]' ");
                foreach ($fetch_sh as $result) {

                    array_push($shi_name, $result->shift_name);
                    array_push($shi_id, $result->id_shift);
                }
        



                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        $this->sub_object_list($search, $data1, $data2, $data4, $get_id, $count, $get_object, $get_name, $sm, $shi_name, $shi_id);
                        break;
                    }
                }
                if (count($shi_id) > 0) {
                    array_multisort($shi_name, $shi_id);

                    for ($z = 0; $z < count($shi_id); $z++) {
                        if (in_array($shi_name[$z], $shi_help)) {
                        } else {
                            array_push($shi_help, $shi_name[$z]);
                            $encrypted_shift = Crypt::encrypt($shi_id[$z]);
                            echo "<div class='form-check form-check-inline'>";
                            echo "<input class='form-check-input' style='display:inline;' onclick='shift_search(this.value)' type='checkbox' id='sh" . $encrypted_shift . "' value='" . $shi_name[$z] . "'>";
                            echo "<label class='form-check-label' style='display:inline;' for='sh" . $encrypted_shift . "'>" . $shi_name[$z] . "</label>";
                            echo "</div>";
                        }
                    }
                }

                break;

            }

        }
    }


    public function loadExistingShifts(Request $request)
    {
        $object = $request->input('object');
        $search_text = $request->input('search_text');

        $is_encrypted = 0;
        $object_decrypted = -1;

        if ($object == "0") {
            $is_encrypted = 1;
        } else {
            $object_decrypted = Crypt::decrypt($object);
        }


        $fetch = DB::select("SELECT * FROM object_model");
        $data1 = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();
        $icons_obj = array();

        $arr_obj = array();
        $arr_sort = array();
        $shi = $request->input('shift_list');
        $obj = array();
        $shii = "";
        $obji = "";
        $type = 1;
        $id_user = Auth::id();
        $admin = false;
        $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id_user'");
        $rights = array();
        
        $role = $fetch_position[0]->r;
        if($role == "admin"){
            $admin = true;
        }
        $fetch_rights = DB::select("SELECT * FROM management_rights WHERE id='$id_user'");
        foreach ($fetch_rights as $result_rights) {
            array_push($rights, $result_rights->id_object);

        } 

        foreach ($fetch as $result) {
            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            $data4[] = $result->superior_object_id;
            $icons_obj[] = $result->object_icon;
        }


        for ($x = 0; $x < count($data2); $x++) {
            if (($data4[$x] == 0 && $is_encrypted == 1) || ($data1[$x] == $object_decrypted && $is_encrypted == 0)) {
                static $dd = 1;

                array_push($arr_obj, $data1[$x]);
                array_push($arr_sort, $data2[$x]);

                $row = 0;
                $search = $data1[$x] . "";
                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        $this->sub_object($search, $data1, $data2, $data4, $arr_obj, $arr_sort, $icons_obj);
                        $row++;
                        break;
                    }
                }
                break;

            }

        }


        if ($arr_obj != null) {

            array_multisort($arr_sort, $arr_obj);

            echo "<div class='row gx-2' >";
            $id_shift = array();
            $start_shift = array();
            $rep_non = array();
            $monday = array();
            $mon_from = array();
            $mon_to = array();
            $tuesday = array();
            $tue_from = array();
            $tue_to = array();
            $wednesday = array();
            $wed_from = array();
            $wed_to = array();
            $thursday = array();
            $thu_from = array();
            $thu_to = array();
            $friday = array();
            $fri_from = array();
            $fri_to = array();
            $saturday = array();
            $sat_from = array();
            $sat_to = array();
            $sunday = array();
            $sun_from = array();
            $sun_to = array();
            $shift_name = array();
            $color = array();
            $id_object = array();
            $object_name = array();
            $object_icon = array();
            $description = array();

            for ($i = 0; $i < count($arr_obj); $i++) {
                $ID_object = $arr_obj[$i];
         
                $fetch_shift = DB::select("SELECT * FROM shift_model, object_model WHERE shift_model.id_object='$ID_object' AND object_model.id_object='$ID_object' ORDER BY shift_model.shift_name");

                foreach ($fetch_shift as $result) {


                    $id_shift[] = $result->id_shift;
                    $start_shift[] = $result->start_shift;
                    $rep_non[] = $result->rep_non;
                    $monday[] = $result->monday;
                    $mon_from[] = $result->mon_from;
                    $mon_to[] = $result->mon_to;
                    $tuesday[] = $result->tuesday;
                    $tue_from[] = $result->tue_from;
                    $tue_to[] = $result->tue_to;
                    $wednesday[] = $result->wednesday;
                    $wed_from[] = $result->wed_from;
                    $wed_to[] = $result->wed_to;
                    $thursday[] = $result->thursday;
                    $thu_from[] = $result->thu_from;
                    $thu_to[] = $result->thu_to;
                    $friday[] = $result->friday;
                    $fri_from[] = $result->fri_from;
                    $fri_to[] = $result->fri_to;
                    $saturday[] = $result->saturday;
                    $sat_from[] = $result->sat_from;
                    $sat_to[] = $result->sat_to;
                    $sunday[] = $result->sunday;
                    $sun_from[] = $result->sun_from;
                    $sun_to[] = $result->sun_to;
                    $shift_name[] = $result->shift_name;
                    $color[] = $result->color;
                    $id_object[] = $result->id_object;
                    $object_name[] = $result->object_name;
                    $object_icon[] = $result->object_icon;
                    $description[] = $result->description;
                }
            }

            $dd = 2;

            if (count($id_shift) > 0) {
                for ($x = 0; $x < count($id_shift); $x++) {
                    $ok = False;
                    if ($shi == null && $obj == null) {
                        $ok = True;
                    } else if (count($shi) == 0 && count($obj) != 0) {
                        if (in_array($id_object[$x], $obj)) {
                            $ok = True;
                        }
                    } else if (count($shi) != 0 && count($obj) == 0) {

                        if (in_array($shift_name[$x], $shi)) {

                            $ok = True;

                        }
                    } else {
                        if (in_array($shift_name[$x], $shi) || in_array($id_object[$x], $obj)) {
                            $ok = True;
                        }
                    }
                    if ($ok == True) {
                        /**source : https://stackoverflow.com/questions/2790899/how-to-check-if-a-string-starts-with-a-specified-string */
      
                        $strshi = strtolower($shift_name[$x]);
                        $strobj = strtolower($object_name[$x]);

                        if ($shii == "" && $obji == "") {
                            $search_fit = true;
                        } else if ($shii == "" && $obji != "") {
                            if (substr($strobj, 0, strlen($obji)) == $obji) {
                                $search_fit = true;

                            }
                        } else if ($shii != "" && $obji == "") {
                            if (substr($strshi, 0, strlen($shii)) == $shii) {
                                $search_fit = true;

                            }

                        } else if ($shii != "" && $obji != "") {
                            if (substr($strshi, 0, strlen($shii)) == $shii && substr($strobj, 0, strlen($obji)) == $obji) {
                                $search_fit = true;
                            }
                        }
                        if(str_starts_with($object_name[$x], $search_text) == false && str_starts_with($shift_name[$x], $search_text) == false){
                            $search_fit = false;
                        }
                        if ($search_fit == true) {
                            if ($admin == true || in_array($id_object[$x], $rights) == true) {
                            $id_encrypted = Crypt::encrypt($id_shift[$x]);
                            echo "<div class='col-12 col-md-3 col-sm-6 p-2 lg  mb-3  '>";
                            echo "<div class='card p-2' >";
                            echo "<div class='row' >";
                            echo "<div class='col-8'>";
                            echo "<div style='padding-top: 5px' ><h5 class='px-2 py-1 text-light' id='h_shi-" . $id_encrypted . "' style='margin-top: 10px;height: 50px;background: " . $color[$x] . ";border-radius: 25px;display:inline;text-overflow: ellipsis;white-space: nowrap;overflow: hidden' title='" . $shift_name[$x] . "'>" . $shift_name[$x] . "</h5></div>";
                            echo "<div class='py-2' ><h6 id='h_obj-" . $id_encrypted . "' style='border-radius: 25px;display:inline;text-overflow: ellipsis;white-space: nowrap;overflow: hidden' title='" . $object_name[$x] . "'><i class='$object_icon[$x]'></i>&nbsp;" . $object_name[$x] . " </h6></div>";


                            echo "</div>";


                            echo "<div class='col-4'>";

                            echo "<div class='text-end'>";
                            echo "<p style='margin-right: 10px;display: inline'>Enable</p>";

                            echo "<label class='switch '>";
                            if ($rep_non[$x] == 1) {
                                echo "<input id='enable_$id_encrypted' type='checkbox' class='primary' onclick='enableShift(this.id)' checked>";
                            } else {
                                echo "<input id='enable_$id_encrypted' type='checkbox' class='primary' onclick='enableShift(this.id)' >";
                            }
                            echo "<span class='slider round' ></span>";
                            echo "</label>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='row' >";
                            echo "<div class='col-6'>";
                            if ($monday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Monaday&nbsp</b>  " . substr($mon_from[$x], 0, -3) . " - " . substr($mon_to[$x], 0, -3) . "</p>";
                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Monday&nbsp</b> --:-- - --:--</p>";

                            }
                            if ($tuesday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Tuesday&nbsp</b> " . substr($tue_from[$x], 0, -3) . " - " . substr($tue_to[$x], 0, -3) . "</p>";
                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Tuesday&nbsp</b> --:-- - --:--</p>";
                            }
                            if ($wednesday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Wednesday&nbsp</b> " . substr($wed_from[$x], 0, -3) . " - " . substr($wed_to[$x], 0, -3) . "</p>";
                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Wednesday&nbsp</b> --:-- - --:--</p>";
                            }
                            if ($wednesday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Thursday&nbsp</b> " . substr($thu_from[$x], 0, -3) . " - " . substr($thu_to[$x], 0, -3) . "</p>";

                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Thursday&nbsp</b> --:-- - --:--</p>";
                            }
                            echo "</div>";
                            echo "<div class='col-6'>";
                            if ($friday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Friday&nbsp</b>" . substr($fri_from[$x], 0, -3) . " - " . substr($fri_to[$x], 0, -3) . "</p>";

                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Friday&nbsp</b> --:-- - --:--</p>";

                            }
                            if ($saturday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Saturday&nbsp</b>" . substr($sat_from[$x], 0, -3) . " - " . substr($sat_to[$x], 0, -3) . "</p>";

                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Saturday&nbsp</b> --:-- - --:--</p>";
                            }
                            if ($sunday[$x] == 1) {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Sunday&nbsp</b>" . substr($sun_from[$x], 0, -3) . " - " . substr($sun_to[$x], 0, -3) . "</p>";

                            } else {
                                echo "<p class='mb-0' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden'><b>Sunday&nbsp</b> --:-- - --:--</p>";
                            }
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='row' >";
                            echo "<div class='col-12 mt-3'>";
                            echo "<div>";
                            echo "<h6>Descripriction:</h6>";
                            echo "<div style='height:50px; overflow: auto'>";
                            echo "<p>".nl2br($description[$x])."</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "<hr>";
                            echo "</div>";
                            echo "</div>";

                  
                            echo "<div class='row mb-2' >";
                            echo "<div class='col-8 '>";
                            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM shift_assignment, users WHERE shift_assignment.id_shift='$id_shift[$x]' AND users.id=shift_assignment.id ORDER BY shift_assignment.updated_at");

                            $fetch_img = DB::select("SELECT * FROM shift_assignment, users WHERE shift_assignment.id_shift='$id_shift[$x]' AND users.id=shift_assignment.id ORDER BY shift_assignment.updated_at");
                            echo '<div class="flex-grow-1 align-items-start">
                            <div class="avatar-group float-start flex-grow-1">';
                            $img_counter = 0;
                            foreach ($fetch_img as $result_img) {
                                $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$result_img->id' ");

                                if ($fetch_img_count[0]->count > 0) {
                                    $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id='$result_img->id' ");
                                    $link_image = "";
                                    foreach ($fetch_link as $result_link) {
                                        $link_image = $result_link->image_link;
                                    }
                                    $imageUrl = Storage::url($link_image);
                                } else {
                                    $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                                }
                                if( $fetch_img_count[0]->count >6 ||  $img_counter == 5){
                                    echo '<div class="avatar-group-item" >
                                 <div class="text-light d-flex justify-content-center align-items-center rounded-circle avatar-sm" style="height:50px;width:50px; background-color: #A9A9A9">
                                 <p class=m-0>'.($fetch_img_count[0]->count -4).'+</p>
                                 </div>
                                     <!--<a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="456">
                                         <img src="" alt="" class="rounded-circle avatar-sm">
                                     </a>-->
                                 </div>';
                                 break;
                                }else{
                                    
                                
                                echo '<div class="avatar-group-item">
                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Terrell Soto">
                                <img src="' . $imageUrl . '" alt="" class="rounded-circle avatar-sm">
                            </a>
                        </div>';
                                }
                                $img_counter++;

                            
                            }
                            echo '</div></div>';
                   
                            echo "</div>";
                            echo "<div class='col-4 '>";
                            echo "<i id='edit-" . $id_encrypted . "' class='fa fa-edit bg-dark p-2 text-white' style='margin-right:5px;font-size:34px;border-radius: 50%;float: right' data-bs-toggle='modal' onclick='load_existing_data(this.id)' data-bs-target='#myModals' ></i>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "</div>";
                            echo "</div>";
                        }

                        }

                    }
                }
            }


            echo "</div>";

        }

    }
    private function doubleValue($value)
    {

        return $value * 2;
    }
    private function sub_object($searching, $dat1, $dat2, $dat4, array &$arr_obj, array &$arr_sort, $icons_obj)
    {
  
        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
                array_push($arr_obj, $dat1[$i]);
                array_push($arr_sort, $dat2[$i]);
              



                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->sub_object($sea, $dat1, $dat2, $dat4, $arr_obj, $arr_sort, $icons_obj);
                            break;
                        }
                    }
                }


            }
        }
    }
    private function sub_object_list($searching, $dat1, $dat2, $dat4, $id, $co, $object, $name, $s, array &$shi_name, array &$shi_id)
    {

        $find = 0;
        $push = 1;
        for ($i = 0; $i < count($dat1); $i++) {
            if ($searching == $dat4[$i]) {

                $fetch_shift_sub = DB::select("SELECT * FROM shift_model WHERE id_object='$dat1[$i]'  ");
                foreach ($fetch_shift_sub as $result) {

                    array_push($shi_name, $result->shift_name);
                    array_push($shi_id, $result->id_shift);
                }



       
                $row = 0;
                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->sub_object_list($sea, $dat1, $dat2, $dat4, $id, $co, $object, $name, $s, $shi_name, $shi_id);
                            break;
                        }
                    }
                }
            }
        }
    }

    private function search_shift($search, $obj_id, $obj_name, $obj_superior, $shift_id, array &$final_id, $main_obj, array &$local_id)
    {
        $shift_arr = array();
        $finding = 0;
        for ($i = 0; $i < count($obj_id); $i++) {
            if ($search == $obj_superior[$i]) {
                $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$obj_id[$i]'   ");
                foreach ($fetch_shifts as $result_shift) {

                    array_push($shift_arr, $result_shift->id_shift);
          
                }

                if (in_array($shift_id, $shift_arr) && count($shift_arr) != null) {
                    array_push($final_id, $main_obj);
                    array_push($local_id, $obj_id[$i]);
                    break;


                } else {
                    $sea = $obj_id[$i];
                    if ($obj_id[$i] != null) {
                        for ($h = 0; $h < count($obj_id); $h++) {
                            if ($sea == $obj_superior[$h]) {
                                $finding = 1;
                                $this->search_shift($obj_id[$i], $obj_id, $obj_name, $obj_superior, $shift_id, $final_id, $main_obj, $local_id);
                                break;
                     
                            }
                        }
                    }
                }


            }
        }

    }



}


function objectDropdownShift($encrytion, $sub_object)
{
    $fetch = DB::select("SELECT * FROM object_model  ORDER BY object_name");

    $names = array();
    $ids = array();
    $icc = array();

    foreach ($fetch as $result) {
        if ($result->superior_object_id == 0) {
            $ids[] = $result->id_object;
            $names[] = $result->object_name;
            $icc[] = $result->object_icon;
        }
    }
    for ($x = 0; $x < count($ids); $x++) {
        $ids[$x] = $encrytion[$ids[$x]];
    }
    for ($x = 0; $x < count($ids); $x++) {

        $id = $ids[$x];
        echo "<input id='hdrop$id' type='hidden' value='$sub_object'>";
        echo "<li><a  id='drop$id' class='dropdown-item' onclick='select_dropdown2(this.id)'><i class='$icc[$x]'></i>&nbsp;$names[$x]</a></li>";

    }

}


function sub_object_model($searching, $dat1, $dat2, $dat4, $previous, $object_sub_decrypted, $is_sub_encrypte, $icons)
{
    static $dd = 1;
    $find = 0;

    for ($i = 0; $i < count($dat2); $i++) {
        $find2 = 0;
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;

            } else {

            }

            $itemId = $previous . "-item-" . $dat1[$i];
            $dd++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {


                        echo "<div class='accordion-item w-100 mt-2'>";

                        echo "<h2 class='ccordion-header w-100 mb-0 ' id='heading$dat1[$i]'>";
                        echo "<button class='accordion-button w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$dat1[$i]' aria-expanded='false' aria-controls='$dat1[$i]' clicked='true' >";
                        echo "<div class='w-100'><i class='$icons[$i]'></i>&nbsp;$dat2[$i] <div style='float:right' style='margin-right: 35px '>";
                        if ($is_sub_encrypte == 0 && $object_sub_decrypted == Crypt::decrypt($dat1[$i])) {
                            echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label' checked>";
                        } else {
                            echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label' >";

                        }
                        echo "<labelfor='yes-button' class='button-label' style='margin-left: 15px;margin-right: 15px;  '>Select </label>
                        </div></div>";
                        echo "</button>";
                        echo "</h2>";


                        echo "<div id='collapse$dat1[$i]' class='w-100 accordion-collapse ' aria-labelledby='heading$dat1[$i]' data-bs-parent='heading$previous'>";
                        echo "<div class='accordion-body pt-0 pb-0  w-100'>";

                        sub_object_model($sea, $dat1, $dat2,/* $dat3,*/ $dat4, $dat1[$i], $object_sub_decrypted, $is_sub_encrypte, $icons);


                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $find2 = 1;
                        break;

                    }
                }
                if ($find2 == 0) {

                    echo "<button class='btn btn-light w-100 mt-3 mb-3 pt-2 pb-2' style='text-align: left;align-items: center;' ><i class='$icons[$i]'></i>&nbsp;" . $dat2[$i] . "<div style='float:right' style='margin-right: 35px '>";
                    if ($is_sub_encrypte == 0 && $object_sub_decrypted == Crypt::decrypt($dat1[$i])) {
                        echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label' checked>";
                    } else {
                        echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label'>";
                    }
                    echo "<labelfor='yes-button' class='button-label mt-0' style='margin-left: 15px;margin-right: 15px;  '>Select </label>
               </div>";
                    echo "</button>";

                } else {

                }

            }
        }


    }
  
}

?>