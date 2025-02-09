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
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class AssignmentController extends Controller
{
    public function showAssignments($id){
        $user = User::find($id);
        return view('admin/assign-shifts', compact('user'));
    }
    public function loadAssignmentList(Request $request){
        $id_obj = $request->input('id_object');
        $id_decrypted_obj = Crypt::decrypt($id_obj);
        $id = $request->input('id');
        $col = $request->input('col');
         //echo "dsa";
         $id_obj = array();
         $name_obj = array();
         $superior_obj = array();
         //$fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
         $fetch = DB::select("SELECT * FROM object_model ");
         foreach ($fetch as $result) {
 
             $id_obj[] = $result->id_object;
             $name_obj[] = $result->object_name;
             $superior_obj[] = $result->superior_object_id;
 
         }
         array_multisort($id_obj, $name_obj, $superior_obj);



         for ($x = 0; $x < count($name_obj); $x++) {
            if ($id_obj[$x] == $id_decrypted_obj) {
                echo "<div class='row mt-1'>";
                $replace = $superior_obj[$x];
                //$rname = $data3[$x];
                $fetch_shift = DB::select("SELECT * FROM shift_model WHERE id_object='$id_obj[$x]' ");
                $found = 0;
                foreach ($fetch_shift as $result_shift) {
                    //echo $result_shift->id_shift;
                    $fetch_shift_assignment = DB::select("SELECT * FROM shift_assignment, shift_model WHERE shift_assignment.id='$id' AND shift_assignment.id_shift='$result_shift->id_shift' AND shift_model.id_shift=shift_assignment.id_shift ");
                    foreach ($fetch_shift_assignment as $result_shift_assignment) {
                        $found++;
                        if($found == 1 ){

                        echo "<div class='col-6 col-sm-$col mt-2'>";
                        echo "<h6 class='mx-1'>$name_obj[$x]</h6>";
                        }
                        $id_encrypted =  Crypt::encrypt($result_shift_assignment->id_shift);
                        //echo $result_shift_assignment->shift_name;
                        echo "<label for='ch_$id_encrypted' class='mx-1 px-2 py-1 text-light' id='h_shi-" . $id_encrypted . "' style='margin-top: 5px;background: " . $result_shift_assignment->color . ";border-radius: 25px;text-overflow: ellipsis;white-space: nowrap' title='" . $result_shift_assignment->shift_name . "'>" . $result_shift_assignment->shift_name . "</label>";
        
                    }
                    
                   /*$id_encrypted =  Crypt::encrypt($result_shift->id_shift);
                    echo "<input type='checkbox' class='mb-3' id='ch_$id_encrypted' name='ch_assign' "; 
                    $rr = $result_shift->id_shift;
                    $fetch_assignment = DB::select("SELECT COUNT(*) AS count FROM shift_assignment WHERE id_shift='$rr' AND id='$id' ");
                    $counter = $fetch_assignment[0]->count;
                    if($counter > 0){
                        echo "checked";
                    }*/
                    
                    //echo " value='$id_encrypted' /><label for='ch_$id_encrypted' class='mx-2 px-2 py-1 text-light' id='h_shi-" . $id_encrypted . "' style='margin-top: 10px;height: 50px;background: " . $result_shift->color . ";border-radius: 25px;display:inline;text-overflow: ellipsis;white-space: nowrap;overflow: hidden' title='" . $result_shift->shift_name . "'>" . $result_shift->shift_name . "</label>";

        
                }
                if($found > 0){
                    echo "</div>";
                }

                $row = 0;
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($id_obj[$x]  == $superior_obj[$h]) {
                       subLoadList($id_obj[$x], $id_obj, $name_obj, $superior_obj, $id, $col/*$rname*/);
                        $row++;
                        break;
                    }
                }

                echo "</div>";
            }

        }
    }
    public function loadAssignmentTimeline(Request $request){
        $id = $request->input('id');
        $id_creator = Auth::id();
        $number = $request->input('number');
        $fetch = DB::select("SELECT * FROM shift_assignment_logs, users WHERE shift_assignment_logs.id='$id' AND shift_assignment_logs.made_by='$id_creator' AND shift_assignment_logs.made_by=users.id  ORDER BY shift_assignment_logs.timestamp_at DESC; ");
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
    public function mainObjectSelect(){
       //$fetch = DB::select("SELECT * FROM object_model WHERE superior_object_id = 0 ORDER BY object_name");
        $fetch = DB::select("SELECT * FROM object_model WHERE superior_object_id = 0 ");

        foreach ($fetch as $result) {
            echo "<option value='".Crypt::encrypt($result->id_object)."' >".$result->object_name."</option>";
        }
    }

    public function loadAssignmentStructure(Request $request){
        $id_obj = $request->input('id_object');
        $id_decrypted_obj = Crypt::decrypt($id_obj);
        $id = $request->input('id');

        //echo "dsa";
        $id_obj = array();
        $name_obj = array();
        $superior_obj = array();
        //$fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $fetch = DB::select("SELECT * FROM object_model ");
        foreach ($fetch as $result) {

            $id_obj[] = $result->id_object;
            $name_obj[] = $result->object_name;
            $superior_obj[] = $result->superior_object_id;

        }
        array_multisort($id_obj, $name_obj, $superior_obj);
        for ($x = 0; $x < count($name_obj); $x++) {
            if ($id_obj[$x] == $id_decrypted_obj) {

                $replace = $superior_obj[$x];
                //$rname = $data3[$x];
                $fetch_shift = DB::select("SELECT * FROM shift_model WHERE id_object='$id_obj[$x]' ");
                foreach ($fetch_shift as $result_shift) {
                    //echo $result_shift->id_shift;
                   $id_encrypted =  Crypt::encrypt($result_shift->id_shift);
                    echo "<input type='checkbox' class='mb-3' id='ch_$id_encrypted' name='ch_assign' "; 
                    $rr = $result_shift->id_shift;
                    $fetch_assignment = DB::select("SELECT COUNT(*) AS count FROM shift_assignment WHERE id_shift='$rr' AND id='$id' ");
                    $counter = $fetch_assignment[0]->count;
                    if($counter > 0){
                        echo "checked";
                    }
                    
                    echo " value='$id_encrypted' /><label for='ch_$id_encrypted' class='mx-2 px-2 py-1 text-light' id='h_shi-" . $id_encrypted . "' style='margin-top: 10px;height: 50px;background: " . $result_shift->color . ";border-radius: 25px;display:inline;text-overflow: ellipsis;white-space: nowrap;overflow: hidden' title='" . $result_shift->shift_name . "'>" . $result_shift->shift_name . "</label>";

        
                }

                $row = 0;
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($id_obj[$x]  == $superior_obj[$h]) {
                       subLoad($id_obj[$x], $id_obj, $name_obj, $superior_obj, $id/*$rname*/);
                        $row++;
                        break;
                    }
                }


            }

        }
    }
    public function insertAssignments(Request $request){
        $arr = $request->input('shifts_arr');
        $id = $request->input('id');
        $obj = Crypt::decrypt($request->input('main_obj'));
        $id_creator = Auth::id();
        $t=date("Y-m-d H:i:s");
        DB::insert("INSERT INTO shift_assignment_logs (id, timestamp_at, made_by) VALUES ('$id','$t', '$id_creator')");

        if($arr > 0){
        foreach ( $arr as $result) {
           $result_decrypt = Crypt::decrypt($result) ;
            $fetch = DB::select("SELECT COUNT(*) AS count FROM shift_assignment WHERE id='$id' AND id_shift='$result_decrypt' ");
            $counter = $fetch[0]->count;

            if($counter == 0){
                 DB::insert("INSERT INTO shift_assignment (id, id_shift, updated_at, updated_by) VALUES ('$id', '$result_decrypt','$t', '$id_creator')");
            }else{
                DB::update("UPDATE shift_assignment SET updated_at = '$t', updated_by = '$id_creator' WHERE id='$id' AND id_shift='$result_decrypt' ");
               ///SET object_name = '$name' WHERE id_object= $id_decrypted
            }
        }
    }
        $id_obj = array();
        $name_obj = array();
        $superior_obj = array();
        $arr_obj = array();
        $arr_shi = array();

        //$fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $fetch_objects = DB::select("SELECT * FROM object_model ");
        foreach ($fetch_objects as $result_objects) {

            $id_obj[] = $result_objects->id_object;
            $name_obj[] = $result_objects->object_name;
            $superior_obj[] = $result_objects->superior_object_id;

        }
        array_multisort($id_obj, $name_obj, $superior_obj);
        for ($x = 0; $x < count($name_obj); $x++) {
            if ( $id_obj[$x] == $obj ) {
                static $dd = 1;



                //array_push($arr_obj, "asd");
                //array_push($arr_sort, $data2[$x]);
                /*$dd++;*/
                array_push($arr_obj, $id_obj[$x]);

                //$result = $this->doubleValue(10);
                $row = 0;
                $search = $id_obj[$x] . "";
                for ($h = 0; $h < count($name_obj); $h++) {
                    if ($search == $superior_obj[$h]) {
                        $this->sub_object($search, $id_obj, $name_obj, $superior_obj, $arr_obj);
                        $row++;
                        break;
                    }
                }
                break;

            }

        }
        foreach ($arr_obj as $value) {
            $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$value' ");
            foreach ($fetch_shifts as $result_shifts) {
                echo $result_shifts->id_shift;
                array_push($arr_shi, $result_shifts->id_shift);

            }
        }
        foreach ($arr_shi as $shift) {
            DB::delete("DELETE FROM shift_assignment WHERE id='$id' AND id_shift='$shift' AND updated_at != '$t'");

        /*$fetch_assignment = DB::select("SELECT * FROM shift_assignment WHERE id='$id' AND id_shift='$shift' AND updated_at != '$t'");
        foreach ( $fetch_assignment as $assignment) {
            DB::delete("DELETE FROM shift_assignment WHERE id_object= $id_decrypted");

        }*/
        }

    }
    private function sub_object($searching, $dat1, $dat2, $dat4, array &$arr_obj)
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
                            $this->sub_object($sea, $dat1, $dat2, $dat4, $arr_obj);
                            break;
                        }
                    }
                }


            }
        }
    }
}
function subLoad($searching, $dat1, $dat2, /*$dat3,*/ $dat4, $id/*$rn*/)
{
    static $dd = 1;
    $find = 0;
    echo "<div class='row'>";
    echo "<div class='col-12'>";
    echo "<div class='mx-2'>";
    for ($i = 0; $i < count($dat2); $i++) {
        $find2 = 0;
        if ($searching == $dat4[$i]) {
            $fetch_shift_sub_count = DB::select("SELECT COUNT(*) AS count FROM shift_model WHERE id_object='$dat1[$i]' ");
            $counter_sub = $fetch_shift_sub_count[0]->count;
            if($counter_sub > 0){
                echo "<div class='mx-2'>";
                echo "<h6>$dat2[$i]</h6>";

            }
            $fetch_shift_sub = DB::select("SELECT * FROM shift_model WHERE id_object='$dat1[$i]' ");
            foreach ($fetch_shift_sub as $result_shift_sub) {
                //echo $result_shift->id_shift;
                $id_encrypted_sub = Crypt::encrypt($result_shift_sub->id_shift);
                $sub_search = $result_shift_sub->id_shift;

                //echo ("<p> SELECT COUNT(*) AS count FROM shift_assignment WHERE id_shift='$sub_search' AND id='$id' </p>");

                echo "<div style='display: inline; margin-bottom: 5px'><input type='checkbox' class='mb-3' style='display: inline;' id='ch_$id_encrypted_sub' name='ch_assign' value='$id_encrypted_sub' ";
                $fetch_assignment = DB::select("SELECT COUNT(*) AS count FROM shift_assignment WHERE id_shift='$sub_search' AND id='$id' ");
                $counter = $fetch_assignment[0]->count;
                if($counter > 0){
                    echo "checked";
                }
                echo " /><label for='ch_$id_encrypted_sub' class='mx-2 my-2 px-2 py-1 text-light' id='h_shi-" . $id_encrypted_sub . "' style='display: inline;margin-top: 5px;height: 50px;background: " . $result_shift_sub->color . ";border-radius: 25px;display:inline;text-overflow: ellipsis;white-space: nowrap;overflow: hidden' title='" . $result_shift_sub->shift_name . "'>" . $result_shift_sub->shift_name . "</label></div>";

    
            }
            if($counter_sub > 0){
                echo "<hr>";
                echo "</div>";
            }
           
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        subLoad($sea, $dat1, $dat2, $dat4, $id);
                        break;
                    }
                }
            }
        }
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";


}

function subLoadList($searching, $dat1, $dat2, /*$dat3,*/ $dat4, $id, $col/*$rn*/)
{
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            $fetch_shift = DB::select("SELECT * FROM shift_model WHERE id_object='$dat1[$i]' ");
            $found = 0;
            foreach ($fetch_shift as $result_shift) {
                //echo $result_shift->id_shift;
                $fetch_shift_assignment = DB::select("SELECT * FROM shift_assignment, shift_model WHERE shift_assignment.id='$id' AND shift_assignment.id_shift='$result_shift->id_shift' AND shift_model.id_shift=shift_assignment.id_shift ");
                foreach ($fetch_shift_assignment as $result_shift_assignment) {
                    $found++;
                    if($found == 1 ){

                    echo "<div class=' col-6 col-sm-$col mt-2'>";
                    echo "<h6 class='mx-1'>$dat2[$i]</h6>";
                    }
                    $id_encrypted =  Crypt::encrypt($result_shift_assignment->id_shift);
                    //echo $result_shift_assignment->shift_name;
                    echo "<label for='ch_$id_encrypted' class='mx-1 px-2 py-1 text-light' id='h_shi-" . $id_encrypted . "' style='margin-top: 10px;background: " . $result_shift_assignment->color . ";border-radius: 25px;text-overflow: ellipsis;white-space: nowrap' title='" . $result_shift_assignment->shift_name . "'>" . $result_shift_assignment->shift_name . "</label>";
    
                }
         
    
            }
            if($found > 0){
                echo "</div>";
            }

            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        subLoadList($sea, $dat1, $dat2, $dat4, $id, $col);
                        break;
                    }
                }
            }
        }
    }
}
    ?>