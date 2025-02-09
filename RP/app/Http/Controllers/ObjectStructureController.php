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


class ObjectStructureController extends Controller
{
    public function selectMainObjects(Request $request)
    {
        $fetch = DB::select("SELECT * FROM object_model");
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
    public function index()
    {

        return view('admin.object-model.create-model-object');
    }
    public function parametrsGet(Request $request)
    {
        $encryptedId = $request->input('search');

        $originalId = Crypt::decrypt($encryptedId);
        $fetch = DB::select("SELECT * FROM object_model WHERE id_object='$originalId' ORDER BY object_name");
        foreach ($fetch as $result) {
            //return json $result->object_name;
            return response()->json(['name' => $result->object_name, 'icon' => $result->object_icon]);
        }
    }

    public function structureCreate(Request $request)
    {
        $name = $request->input('name');
        $icon =  $request->input('icon');
        DB::insert("INSERT INTO object_model (object_name, superior_object_id, object_icon) VALUES ('$name',0, '$icon')");

    }
    public function structureSubCreate(Request $request)
    {
        $name = $request->input('name');
        $name_superior = array();
        $id = $request->input('id');
        $icon = $request->input('icon');
        $id_decrypted = Crypt::decrypt($id);
        $fetch = DB::select("SELECT * FROM object_model WHERE id_object='$id_decrypted' ORDER BY object_name");
        foreach ($fetch as $result) {
            //$name_superior[] = $result->object_name;
        }
        //echo  $id_decrypted;
        DB::insert("INSERT INTO object_model (object_name, superior_object_id, object_icon) VALUES ('$name','$id_decrypted', '$icon')");

    }
    public function structureRename(Request $request)
    {
        $name = $request->input('name');
        
        $id = $request->input('id');
        $id_decrypted = Crypt::decrypt($id);
        $icon =  $request->input('icon');
        //echo  $name;
       // DB::insert("INSERT INTO object_model (object_name, superior_object_id) VALUES ('$name','$id_decrypted')");
        DB::update("UPDATE object_model SET object_name = '$name', object_icon= '$icon' WHERE id_object= $id_decrypted");
        //DB::update("");
        //DB::update("UPDATE object_model oSET superior_object_id = $rep WHERE id_object= $dat1[$i]");

    }
    public function structureDelete(Request $request)
    {
        $id = $request->input('id');
        $id_decrypted = Crypt::decrypt($id);

        $data1 = array();
        $data2 = array();
        //$data3 = array();
        $data4 = array();
        $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        foreach ($fetch as $result) {

            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            //  $data3[] = $result->superior_object_name;
            $data4[] = $result->superior_object_id;

        }
        array_multisort($data1, $data2, $data4);

        //echo $id_decrypted;
        for ($x = 0; $x < count($data2); $x++) {
            if ($data1[$x] == $id_decrypted) {
                static $dd = 1;

                $search = $data1[$x] . "";
                $replace = $data4[$x];
                //$rname = $data3[$x];

                $dd++;

                $row = 0;
                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        subDelete($search, $data1, $data2, $data4, $replace,/*$rname*/);
                        $row++;
                        break;
                    }
                }


            }

        }
        DB::delete("DELETE FROM object_model WHERE id_object= $id_decrypted");
        DB::delete("DELETE FROM shift_model WHERE id_object= $id_decrypted");
        DB::delete("DELETE FROM manager_rights WHERE id_object= $id_decrypted");

    }
    public function structureGet(Request $request)
    {
        $object = $request->input('object');
        //echo $object;
        $is_encrypte = 0;


        if ($object == "0") {
            $is_encrypte = 1;
            //echo "<h6>dsa</h6>";
        } else {
            $object_decrypted = Crypt::decrypt($object);
        }

        $id = 122341563;  // Example ID (could be a UUID or other identifier)

        // Encrypt the ID using Crypt
        $encryptedId = Crypt::encrypt($id);
        // echo "<h6>$encryptedId</h6>";
        $data_name = array();
        $search_main = "";
        $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");
        $data1 = array();
        $data2 = array();
        //$data3 = array();
        $data4 = array();
        $ddd = array();
        $ppp = array();
        $icons = array();
        $encrytion = array();
        $previous = 0;
        $numberval = array();
        $rr = sizeof($fetch);
        $i = 0;
        foreach ($fetch as $result) {
            $ddd[] = $result->id_object;
            $data1[] = $result->id_object;
            $data2[] = $result->object_name;
            //$data3[] = $result->superior_object_name;
            $ppp[] = $result->superior_object_id;
            $data4[] = $result->superior_object_id;
            $icons[] = $result->object_icon;
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
            //$ppp[$x] = $encrytion[ $ppp[$x]];
            //$data1[$x] = $encrytion[ $data1[$x]];
            //$data4[$x] = $encrytion[ $data4[$x]];
            //$data2[] = $result->object_name;
            //$data3[] = $result->superior_object_name;
            //$data4[] = $result->superior_object_id;
        }
        if ($is_encrypte == 0) {
            $search_main = $encrytion[$object_decrypted];
        }
        /*echo "<h6>$encrytion[61]</h6>";
        echo "<h6>$ddd[0]</h6>";
        echo "<h6>$ppp[0]</h6>";*/
        //array_multisort($data1, $data2, $data3, $data4);
        array_multisort($data2, $data1/*, $data3*/ , $data4,  $icons);
        $search = "";
        $count = 0;


        $nm = "box";

        $dd = 1;
        //echo "<div style='overflow:auto'>";
        //echo "<div class='accordion w-100' id='accordionExample' >";
        for ($x = 0; $x < count($data2); $x++) {

            if (($data4[$x] == 0 && $is_encrypte == 1) || ($data1[$x] == $search_main && $is_encrypte == 0)) {
                static $dd = 1;

                $search = $data1[$x] . "";
                $numberval[$count] = $data1[$x] . "";
                $count = 1;
                //echo "<div class='accordion w-100' id='accordionExample2' >";

                echo "<div class='accordion w-100' id='$data1[$x]'>";
                //echo "<ul>";
                /*if ($finder == 0) {
                    $finder = 1;
                    echo "<ul>";
                    echo "<hr>";
                } else {

                }*/
                /*echo "<li>";
                echo "<input id='hid" . $dd . "m' type='hidden' name='hid' value='" . $data1[$x] . "'>";

                echo "<input id='box" . $dd . "m' type='button' onclick='Helal(this.id)' name='box' value='" . $data2[$x] . "'>";*/
                //echo "<h5>" . $data2[$x] . "";
                echo "<button data-mdb-dropdown-init class='dropdown-toggle btn btn-primary' style='min-width:220px' id='menu' role='button' data-mdb-toggle='dropdown' data-bs-toggle='dropdown' aria-expanded='false'><i class='" . $icons[$x] .  "'></i>&nbsp;";
                echo $data2[$x];
                echo "</button><ul class='dropdown-menu' id='drop_menu' aria-labelledby='menu'>";
                echo "" . objectDropdown($encrytion) . "</ul>";
                echo "<div style='float: right' class='mt-2'><input id='" . $data1[$x] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)'  class='hidden radio-label' >";
                echo "<label for='yes-button' class='button-label mt-0' style='margin-left: 15px;margin-right: 15px;  '>Select </label> </div>";

                $dd++;

                $row = 0;

                for ($h = 0; $h < count($data2); $h++) {
                    if ($search == $data4[$h]) {
                        sub_object($search, $data1, $data2, /*$data3,*/ $data4, $previous, $icons);
                        $row++;
                        break;
                    }
                }

                /*echo "</li>";
                
                //echo "</ul>";
                echo "<br>";
                echo "<hr style='height:5px'>";
                echo "<br>";*/

                echo "</div>";




                break;

            }


        }
        //echo '</div>';


        $t = $data1[0];

        //echo $t;
    }

}

function sub_object($searching, $dat1, $dat2, /*$dat3,*/ $dat4, $previous, $icons)
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

                        echo "<div class='accordion-item w-100 mt-2'>";

                        echo "<h2 class='ccordion-header w-100 mb-0 ' id='heading$dat1[$i]'>";
                        echo "<button class='accordion-button collapsed w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$dat1[$i]' aria-expanded='false' aria-controls='$dat1[$i]'>";
                        echo "<i class='" . $icons[$i] .  "' style='margin-right: 5px'></i> $dat2[$i]  <div class='w-100'><div style='float:right' style='margin-right: 35px '>";

                        echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label' >";
                        echo "<labelfor='yes-button' class='button-label' style='margin-left: 15px;margin-right: 15px;  '>Select </label>
                        </div></div>";
                        echo "</button>";
                        echo "</h2>";


                        echo "<div id='collapse$dat1[$i]' class='w-100 accordion-collapse collapse' aria-labelledby='heading$dat1[$i]' data-bs-parent='heading$previous'>";
                        echo "<div class='accordion-body pt-0 pb-0  w-100'>";

                        //echo "<div id='collapseOne' class='accordion-collapse collapse w-100' aria-labelledby='headingOne' data-bs-parent='#accordionExampleNested" . $previous . "'>";
                        sub_object($sea, $dat1, $dat2,/* $dat3,*/ $dat4, $dat1[$i], $icons);
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
                echo "<button class='btn btn-light w-100 mt-3 mb-3 pt-2 pb-2' style='text-align: left;align-items: center;'><i class='" . $icons[$i] .  "'></i>&nbsp;" . $dat2[$i] . "<div style='float:right' style='margin-right: 35px '>";
                echo "<input id='" . $dat1[$i] . "' type='radio' name='accept-offers' onclick='radiocheck(this.id)' class='hidden radio-label' >";
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
        /*echo "<h2 class='accordion-header w-100' id='headingTwo' >";
                    echo  "<button class='accordion-button w-100' type='button' data-bs-toggle='collapse' data-bs-target='#collapseTwo' aria-expanded='true' aria-controls='collapseTwo' >";
                    echo   $searching  ;
                    echo "</button>";
                    echo "</h2>";*/
        //echo "<button class='btn btn-light w-100' style='text-align: left;'>" . $searching . "</button>";
        echo "<h6>dsa</h6>";
    }
    //echo "</ul>";

}

function objectDropdown($encrytion)
{
    $fetch = DB::select("SELECT * FROM object_model ORDER BY object_name");

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
        echo "<li><a  id='drop$id' class='dropdown-item' onclick='select_dropdown(this.id)'><i class='" . $icc[$x] .  "'></i>&nbsp;$names[$x]</a></li>";

    }

}

function subDelete($searching, $dat1, $dat2, /*$dat3,*/ $dat4, $rep,/*$rn*/)
{
    static $dd = 1;
    $find = 0;
    global $conn;

    global $status;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;
            }

            $dd++;
            $row = 0;
            $reps = $dat4[$i];
            //$rns = $dat3[$i];
            $sea = $dat1[$i] . "";


            //$sql_update = "UPDATE list_of_objects SET superior_object_id = $rep, superior_object_name = '$rn' WHERE id_object= $dat1[$i]";
            DB::update("UPDATE object_model SET superior_object_id = $rep WHERE id_object= $dat1[$i]");
            //if (!mysqli_query($conn, $sql_update)) {
            //$status = 1;
            //}


        }
    }


}


?>