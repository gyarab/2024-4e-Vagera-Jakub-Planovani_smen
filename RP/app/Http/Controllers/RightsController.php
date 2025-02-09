<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class RightsController extends Controller
{
    public function showRights($id){
        $user = User::find($id);
        return view('admin/manager-rights', compact('user'));
    }
    public function loadRightsList(Request $request){
        $obj = $request->input('id_object');
  
        $id_decrypted_obj = Crypt::decrypt($obj);
        $id = $request->input('id');
        $fetch_rights = DB::select("SELECT * FROM management_rights, object_model WHERE management_rights.id='$id' AND management_rights.id='$id' AND object_model.id_object=management_rights.id_object ");
       /*echo '<ul class="list-group list-group-flush">';
        foreach ($fetch_rights as $result) {
            echo '<li class="list-group-item mr-0 p-0 d-flex justify-content-between align-items-center flex-wrap">';
            echo "<h6>$result->object_name</h6>";
            echo "</li>";
        }
        echo '</ul>';*/
       
        $id_obj = array();
        $name_obj = array();
        $superior_obj = array();
        $arr_obj = array();
        $fetch_objects = DB::select("SELECT * FROM object_model");
        foreach ($fetch_objects as $result_objects) {

            $id_obj[] = $result_objects->id_object;
            $name_obj[] = $result_objects->object_name;
            $superior_obj[] = $result_objects->superior_object_id;

        }
        array_multisort($id_obj, $name_obj, $superior_obj);
        for ($x = 0; $x < count($name_obj); $x++) {
            if ( $id_obj[$x] == $id_decrypted_obj ) {
                static $dd = 1;


                array_push($arr_obj, $id_obj[$x]);

                $row = 0;
                $search = $id_obj[$x] . "";
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($search == $superior_obj[$h]) {
                        $this->subObjectInsert($search, $id_obj, $name_obj, $superior_obj, $arr_obj);
                        $row++;
                        break;
                    }
                }
                break;

            }

        }
        //echo $arr_obj[0];
        //echo $arr_obj;
        echo "<div class='row mt-2 '>";
        //echo '<ul class="list-group list-group-flush">';
        foreach ($arr_obj as $result) {
            $fetch_rights = DB::select("SELECT * FROM management_rights, object_model WHERE management_rights.id='$id' AND management_rights.id_object='$result' AND object_model.id_object=management_rights.id_object ");
            foreach ($fetch_rights as $result_rights) {
                //echo '<li class="list-group-item mr-0 p-0 d-flex justify-content-between align-items-center flex-wrap">';
               echo "<div class='col-6'>";
                echo "<h6 class='mt-2'>$result_rights->object_name</h6>";
                echo "<hr>";
                echo "</div>";
                //echo "</li>";
            }
        }
        echo "</div>";
        //echo '</ul>';
    }
    public function insertRights(Request $request){
        $arr = $request->input('obj_arr');
        $id = $request->input('id');
        $obj = Crypt::decrypt($request->input('main_obj'));
        $id_creator = Auth::id();
        $t=date("Y-m-d H:i:s");
        DB::insert("INSERT INTO management_rights_logs (id, timestamp_at, made_by) VALUES ('$id','$t', '$id_creator')");
        if($arr > 0){
        foreach ( $arr as $result) {
           $result_decrypt = Crypt::decrypt($result) ;
            $fetch = DB::select("SELECT COUNT(*) AS count FROM management_rights WHERE id='$id' AND id_object='$result_decrypt' ");
            //echo "SELECT COUNT(*) AS count FROM management_rights WHERE id='$id' AND id_object='$result_decrypt' ";
            $counter = $fetch[0]->count;

            if($counter == 0){
                 DB::insert("INSERT INTO management_rights (id, id_object, updated_at, updated_by) VALUES ('$id', '$result_decrypt','$t', '$id_creator')");
                //echo ("INSERT INTO management_rights (id, id_object, updated_at, updated_by) VALUES ('$id', '$result_decrypt','$t', '$id_creator')");

            }else{
                DB::update("UPDATE management_rights SET updated_at = '$t', updated_by = '$id_creator' WHERE id='$id' AND id_object='$result_decrypt' ");
            }
        }
    }


        $id_obj = array();
        $name_obj = array();
        $superior_obj = array();
        $arr_obj = array();
        $arr_shi = array();

        //$fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $fetch_objects = DB::select("SELECT * FROM object_model");
        foreach ($fetch_objects as $result_objects) {

            $id_obj[] = $result_objects->id_object;
            $name_obj[] = $result_objects->object_name;
            $superior_obj[] = $result_objects->superior_object_id;

        }
        array_multisort($id_obj, $name_obj, $superior_obj);
        for ($x = 0; $x < count($name_obj); $x++) {
            if ( $id_obj[$x] == $obj ) {
                static $dd = 1;


                array_push($arr_obj, $id_obj[$x]);

                $row = 0;
                $search = $id_obj[$x] . "";
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($search == $superior_obj[$h]) {
                        $this->subObjectInsert($search, $id_obj, $name_obj, $superior_obj, $arr_obj);
                        $row++;
                        break;
                    }
                }
                break;

            }

        }
        /*foreach ($arr_obj as $value) {
            $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$value' ");
            foreach ($fetch_shifts as $result_shifts) {
                echo $result_shifts->id_shift;
                array_push($arr_shi, $result_shifts->id_shift);

            }
        }*/
        foreach ($arr_obj as $objr) {
            DB::delete("DELETE FROM management_rights WHERE id='$id' AND id_object='$objr' AND updated_at != '$t'");

        }
    

    }
    public function loadRightstTimeline(Request $request){
        $id = $request->input('id');
        $id_creator = Auth::id();
        $number = $request->input('number');
        $fetch = DB::select("SELECT * FROM management_rights_logs, users WHERE management_rights_logs.id='$id' AND management_rights_logs.made_by='$id_creator' AND management_rights_logs.made_by=users.id  ORDER BY management_rights_logs.timestamp_at DESC; ");
        echo "<ul class='sessions px-0'>";
        $counter = 0;
        foreach ($fetch as $result) {
            if( $counter == $number){
                break;
                 }
            echo '<li>';
            echo '<div class="time">'.$result->timestamp_at.'</div>';
            echo '<p class="mr-2" style="display:inline">Edited by: '.$result->first_name.' '.$result->middle_name.' '.$result->last_name.'&nbsp;&nbsp;</p>';
                   $fetch_img = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id_creator'");
        $supress = $fetch_img[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id_creator'");
            $link_image = "";
            foreach ($fetch_link as $result_link) {
                $link_image = $result_link->image_link;
            }
            $imageUrl = Storage::url($link_image);
        } else {
            $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
        }
       echo '<img id="imagePersoanl" src="'.$imageUrl.'" alt="editor profile" class="rounded-circle object-fit-cover ml-2" style="height: 25px; width: 25px;display:inline">';
            echo '</li>';
            $counter++;
        }
        echo "</ul>";
        if( $counter >= $number){
            echo "<center><button onclick='loadTimeline(5)' class='btn btn-outline-secondary' >Load more&nbsp;<i class='bi bi-arrow-down'></i></button></center>";
        }

    }
    private function subObjectInsert($searching, $dat1, $dat2, $dat4, array &$arr_obj)
    {
        /*global $arr_obj;
        global $arr_sort;*/
        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
                array_push($arr_obj, $dat1[$i]);
                //echo "dddd";



                $sea = $dat1[$i] . "";
                if ($sea != null) {
                    for ($h = 0; $h < count($dat2); $h++) {
                        if ($sea == $dat4[$h]) {
                            $this->subObjectInsert($sea, $dat1, $dat2, $dat4, $arr_obj);
                            break;
                        }
                    }
                }


            }
        }
    }
    public function structureRightsGet(Request $request)
    {
        $object = $request->input('object');
       $id = $request->input('id');
        $is_encrypte = 0;


        if ($object == "0") {
            $is_encrypte = 1;
        } else {
            $object_decrypted = Crypt::decrypt($object);
        }

      // Example ID (could be a UUID or other identifier)

        $encryptedId = Crypt::encrypt($id);
        $data_name = array();
        $search_main = "";
        $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $data1 = array();
        $data2 = array();
        $data4 = array();
        $ddd = array();
        $ppp = array();
        $encrytion = array();
        $previous = 0;
        $numberval = array();
        $rr = sizeof($fetch);
        $i = 0;
        foreach ($fetch as $result) {
            $ddd[] = $result->id_object;
            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            $ppp[] = $result->superior_object_id;
            $data4[] = $result->superior_object_id;
        }
        $encrytion = array();
        foreach ($data1 as $d) {
            $encrytion[$d] = Crypt::encrypt($d);
        }
        for ($x = 0; $x < count($data1); $x++) {
            $ddd[$x] = $encrytion[$ddd[$x]];
            $data1[$x] = $encrytion[$data1[$x]];
            if ($ppp[$x] == 0) {
                $ppp[$x] = 0;
                $data4[$x] = 0;
            } else {
                $ppp[$x] = $encrytion[$ppp[$x]];
                $data4[$x] = $encrytion[$data4[$x]];
            }
        }
        if ($is_encrypte == 0) {
            $search_main = $encrytion[$object_decrypted];
        }

        array_multisort($data2, $data1/*, $data3*/ , $data4);
        $search = "";
        $count = 0;


        $nm = "box";

        $dd = 1;

        for ($x = 0; $x < count($data2); $x++) {

            if (($data4[$x] == 0 && $is_encrypte == 1) || ($data1[$x] == $search_main && $is_encrypte == 0)) {
                static $dd = 1;

                $search = $data1[$x] . "";
                $numberval[$count] = $data1[$x] . "";
                $count = 1;

                echo "<div class='accordion w-100' id='$data1[$x]'>";

                echo "<p style='display: inline'>";
                echo $data2[$x];
                echo "</p>";
                echo "<div style='float: right; display: inline' class='mt-2'><input id='" . $data1[$x] . "' value='$data1[$x]' type='checkbox' name='ch_rights' class='hidden radio-label' ";
               $rr = Crypt::decrypt($data1[$x]);
                $fetch_assignment = DB::select("SELECT COUNT(*) AS count FROM management_rights WHERE id_object='$rr' AND id='$id' ");
                $counter = $fetch_assignment[0]->count;
                if($counter > 0){
                    echo "checked";
                }
                echo " >";
                echo "<label for='yes-button' class='button-label mt-0' style='margin-left: 15px;margin-right: 15px;  '>Select </label> </div><hr>";

                $dd++;

                $row = 0;

                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        sub_object($search, $data1, $data2, /*$data3,*/ $data4, $previous, $id );
                        $row++;
                        break;
                    }
                }


                echo "</div>";




                break;

            }


        }



        $t = $data1[0];


    }
}
function sub_object($searching, $dat1, $dat2, /*$dat3,*/ $dat4, $previous, $id)
{
    static $dd = 1;
    $find = 0;

    for ($i = 0; $i < count($dat2); $i++) {
        $find2 = 0;
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;
                //echo "<ul>";
                //echo "<hr>";
            } else {

            }
            // echo "<div class='accordion-item w-100'>";

            //echo "<li>";
            //echo "<input id='hid" . $dd . "' type='hidden' name='hid' value='" . $dat1[$i] . "'>";
            //echo "<button class='btn btn-light w-100' style='text-align: left;'>" . $searching . "</button>";

            //echo "<input id='box" . $dd . "' type='button' onclick='Helal(this.id)' name='box' value='" . $dat2[$i] . "'>";
            //echo "<div class='accordion-body w-100' id='$previous'>";
            $itemId = $previous . "-item-" . $dat1[$i];
            $dd++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        /*echo "<div class='accordion-body'>";
                        echo "<div class='accordion mt-3 w-100' id='accordionExampleNested" . $previous . "'>";
                        echo "<div class='accordion-item w-100'>";

                        echo "<h2 class='accordion-header' id='headingNestedOne" . $previous . "'>";
                        echo "<button class='accordion-button btn btn-light w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapseNestedOne" . $previous . "' aria-expanded='true' aria-controls='collapseNestedOne" . $previous . "'>";
                        echo " $dat2[$i] ";
                        echo "</button>";
                        echo "</h2>";*/
                        //$id_decrypted_obj = Crypt::decrypt(payload: $id_obj);

                        echo "<div class='accordion-item w-100 mt-2'>";

                        echo "<h2 class='ccordion-header w-100 mb-0 ' id='heading$dat1[$i]'>";
                        echo "<button class='accordion-button collapsed w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$dat1[$i]' aria-expanded='false' aria-controls='$dat1[$i]'>";
                        echo " $dat2[$i]  <div class='w-100'><div style='float:right' style='margin-right: 35px '>";

                        echo "<input id='" . $dat1[$i] . "' value='$dat1[$i]' type='checkbox' name='ch_rights' class='hidden radio-label' ";
                        $ee = Crypt::decrypt($dat1[$i]);
                        $fetch_assignment = DB::select("SELECT COUNT(*) AS count FROM management_rights WHERE id_object='$ee' AND id='$id' ");
                        $counter = $fetch_assignment[0]->count;
                        if($counter > 0){
                            echo "checked";
                        }
                        echo " >";
                        echo "<labelfor='yes-button' class='button-label' style='margin-left: 15px;margin-right: 15px;  '>Select </label>
                        </div></div>";
                        echo "</button>";
                        echo "</h2>";


                        echo "<div id='collapse$dat1[$i]' class='w-100 accordion-collapse collapse' aria-labelledby='heading$dat1[$i]' data-bs-parent='heading$previous'>";
                        echo "<div class='accordion-body pt-0 pb-0  w-100'>";

                        //echo "<div id='collapseOne' class='accordion-collapse collapse w-100' aria-labelledby='headingOne' data-bs-parent='#accordionExampleNested" . $previous . "'>";
                        sub_object($sea, $dat1, $dat2,/* $dat3,*/ $dat4, $dat1[$i], $id);
                        /*echo "</div>";
                        echo "</div>";*/

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $find2 = 1;
                        break;

                    }/*else{
                  /*echo "<h2 class='accordion-header w-100' id='headingTwo' >";
                  echo  "<button class='accordion-button w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapseTwo' aria-expanded='true' aria-controls='collapseTwo' >";
                  echo   $dat2[$i] ;
                  echo "</button>";
                  echo "</h2>";*/
                    //echo "<button class='btn btn-light w-100' style='text-align: left;'>" . $dat2[$i] . "</button>";
                    /*break;
                    }*/
                }
            }
            if ($find2 == 0) {
                /*echo " <div id='collapseNestedOne" . $previous  . "' class='accordion-collapse collapse w-100' aria-labelledby='headingNestedOne" . $previous . "' data-bs-parent='#accordionExampleNested" . $previous . "'>";
                echo " <div class='accordion-body'>";
                echo "<button class='btn btn-light w-100' style='text-align: left;'>" . $dat2[$i] . "</button>";
                echo "</div>";
                echo "</div>";*/


                /*echo "<div id='collapse$dat1[$i]' class='accordion-collapse collapse' aria-labelledby='heading$dat1[$i]' data-bs-parent='heading$previous'>";
                echo "<div class='accordion-body'>";*/
                echo "<button class='btn btn-light w-100 mt-3 mb-3 pt-2 pb-2' style='text-align: left;align-items: center;'>" . $dat2[$i] . "<div style='float:right' style='margin-right: 35px '>";
                echo "<input id='" . $dat1[$i] . "' value='$dat1[$i]' type='checkbox' name='ch_rights' class='hidden radio-label' ";
                $yy = Crypt::decrypt($dat1[$i]);
                $fetch_assignment2 = DB::select("SELECT COUNT(*) AS count FROM management_rights WHERE id_object='$yy' AND id='$id' ");
                $counter2 = $fetch_assignment2[0]->count;
                if($counter2 > 0){
                    echo "checked";
                } 
                echo " >";
                echo "<labelfor='yes-button' class='button-label mt-0' style='margin-left: 15px;margin-right: 15px;  '>Select </label>
               </div>";
                echo "</button>";
                /* ${item.content}
                 ${item.children.length > 0 ? generateAccordion(item.children, `${parentId}-${index}`) : ''}*/
                /*echo "</div>";
                 echo "</div>";*/
            } else {

            }
            //echo "</div>";

            //echo "</li>";
            // echo "</div>";
        }
    }
    //echo "<h6>. $find.</h6>";
    if ($find == 0) {
        
        echo "<h6>dsa</h6>";
    }

}

function objectDropdown($encrytion)
{
    $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");

    $names = array();
    $ids = array();

    foreach ($fetch as $result) {
        if ($result->superior_object_id == 0) {
            $ids[] = $result->id_object;
            $names[] = $result->object_name;
        }
    }
    for ($x = 0; $x < count($ids); $x++) {
        $ids[$x] = $encrytion[$ids[$x]];
    }
    for ($x = 0; $x < count($ids); $x++) {

        $id = $ids[$x];
        echo "<li><a  id='drop$id' class='dropdown-item' onclick='select_dropdown(this.id)'>$names[$x]</a></li>";

    }

}

?>