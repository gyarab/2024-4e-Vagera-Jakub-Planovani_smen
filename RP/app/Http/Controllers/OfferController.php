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
use App\Models\User;


class OfferController extends Controller
{
    public function showOffer($id)
    {
     
      $offer_shift = DB::select(" SELECT * FROM shift_offer, shift_model, object_model, shift_active_data, users WHERE shift_active_data.id_shift = shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_offer.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object AND users.id=shift_offer.created_by  AND shift_offer.id_offer='$id' ");
      $id_user = Auth::id();
        $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id_user'");
        $role = $fetch_position[0]->r;
        if($role == "admin"){
            return view('admin/detail-offer', compact('offer_shift'));
        }
    }
    public function showOfferManager($id)
    {
     
      $offer_shift = DB::select(" SELECT * FROM shift_offer, shift_model, object_model, shift_active_data, users WHERE shift_active_data.id_shift = shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_offer.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object AND users.id=shift_offer.created_by  AND shift_offer.id_offer='$id' ");
      $id_user = Auth::id();
        $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id_user'");
        $role = $fetch_position[0]->r;
            return view('manager/detail-offer', compact('offer_shift'));
     
        
    }
    public function adminGetAllOffer(Request $request)
    {
        $get_offer = array();
        $get_main = array();
        $tooltip_arr = array();
        $tooltip_arr_user = array();
        $comments_arr = array();
        $tooltip_comments = array();
        $shift_month = array();
        $creation = array();


        $main_icon = array();

        $fetch_object = DB::select("SELECT * FROM object_model");
        $object_id = array();
        $object_name = array();
        $icons = array();

        $object_superior = array();

        foreach ($fetch_object as $result_object) {
            $object_id[] = $result_object->id_object;
            $object_name[] = $result_object->object_name;
            $object_superior[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
        }
        array_multisort($object_id, $object_name, $object_superior, $icons);

        $id = Auth::id();
        $admin = false;
        $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id'");
        $rights = array();
        
        $role = $fetch_position[0]->r;
        if($role == "admin"){
            $admin = true;
        }
        $fetch_rights = DB::select("SELECT * FROM shift_assignment WHERE id='$id' ");
        foreach ($fetch_rights as $result_rights) {
            array_push($rights, $result_rights->id_shift);

        } 
        $td = $request->input('date');

        for ($i = 1; $i < 32; $i++) {
            if ($i < 9) {
                $day = "0" . ($i);
            } else {
                $day = ($i);
            }
            $date = $td . "-" . $day;
            $today_offer = DB::select("SELECT *, shift_assignment.id_shift AS assignment, shift_offer.id_offer AS offer FROM users, shift_active_data, shift_model, object_model, shift_assignment, shift_offer LEFT JOIN shift_request ON shift_request.id_offer=shift_offer.id_offer AND shift_request.id='$id' WHERE shift_assignment.id='$id' AND shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$date' AND users.id=shift_offer.created_by ");

            $counter = 0;
            $get_offer[$i - 1] = "<div class='row'>";
            $request_count = DB::select("SELECT *, object_model.id_object AS id_obj, shift_offer.created_at AS creation_at FROM users, shift_active_data, shift_model, object_model, shift_offer, shift_assignment WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$date' AND users.id=shift_offer.created_by LIMIT 1");

            foreach ($today_offer as $result) {
                $number_assignment = $result->assignment;
               if ($admin == true || in_array($number_assignment, $rights) == true) {

             
                $counter++;
                $id_offer =$result->offer;
                $request_count = DB::select("SELECT COUNT(*) AS count FROM shift_request WHERE id_offer='$id_offer' ");
                $counter = $request_count[0]->count;

                $id_encrypt = Crypt::encrypt($id_offer);
                $get_offer[$i - 1] = $get_offer[$i - 1] . "<div class='col-12 col-md-4'>";
                $get_offer[$i - 1] = $get_offer[$i - 1] . '
                <div class="mb-1 p-2 pb-2">
            <div class="card_shift radius-10 border-top border-bottom border-end pb-2"
                style="border:10px solid ' . $result->color . '">
                <p class="mb-0 mx-2 my-2 text-secondary">' . $result->object_name . ' - ' . $result->shift_name . '</p>
                <p class="mb-0 mx-2 my-1"
                    style="display:inline;margin-bottom: 15px"><strong>' . substr(($result->saved_from), 0, 5) . '  -
                        ' . substr(($result->saved_to), 0, 5) . '</strong></p>';
                $get_offer[$i - 1] = $get_offer[$i - 1] . "<i id='c-" . $id_encrypt . "' class='bi bi-info-circle mx-2' style='float: right' ></i>";
                $get_offer[$i - 1] = $get_offer[$i - 1] . '<br>
                

                <hr class="m-0 mt-1 mb-1 p-0">';
                $search_object = $result->id_object;
                for ($x = 0; $x < count($object_name); $x++) {

                    if ("0" == $object_superior[$x]) {

                        if($search_object == $object_id[$x]){
                            array_push($get_main, $object_name[$x]);
                            array_push($main_icon, $icons[$x]);

                            break;

                        }

                        for ($h = 0; $h < count($object_name); $h++) {
                            if ($object_id[$x] == $object_superior[$h]) {
                                $this->subObject($object_id[$x], $object_id, $object_name, $object_superior, $icons, $search_object, $get_main, $object_name[$x], $main_icon, $icons[$x] );
                                break;
                            }
                        }
                    }
                }
                array_push($tooltip_arr, $id_encrypt);
                
                    array_push($creation, $result->created_at);
             
                array_push($tooltip_arr_user, $result->last_name . " " . $result->middle_name . " " . $result->first_name);
                if ($result->comments == null || $result->comments == "") {

                    $get_offer[$i - 1] = $get_offer[$i - 1] . '<i id="cm-' . $id_encrypt . '" class="bi bi-chat-fill mx-2" style="font-size: 20px; margin-top: 15px; "></i>';
                } else {
                    array_push($comments_arr, $id_encrypt);

                    array_push($tooltip_comments, $result->comments);
                    $get_offer[$i - 1] = $get_offer[$i - 1] . '<i id="cm-' . $id_encrypt . '" class="bi bi-chat-fill mx-2" style="font-size: 20px; margin-top: 15px;color:#0d6efd ; "></i>';
                }

                if (strtotime($date) >= strtotime('-1 days')) {
                    if($counter == 0){  
                    $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-outline-primary"
                    style="float:right" onclick="requestShift(this.id)"> <span id="s-' . $id_encrypt . '" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>Request</button>';
                    }else{
                        $request_atributes = DB::select("SELECT request_status AS sta FROM shift_request WHERE id_offer='$id_offer' ");
                        $current_status = $request_atributes[0]->sta; 
                        if($current_status == 1){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-warning"
                            style="float:right" onclick="changeRequest(this.id)"><i class="bi bi-question-lg"></i>Waiting</button>';
                        }else if($current_status == 0){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-success"
                            style="float:right" ><i class="bi bi-calendar2-check" style="margin-right: 5px"></i>Granted</button>';
                        }else if($current_status == 2){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-danger"
                            style="float:right" ><i class="bi bi-calendar2-x" style="margin-right: 5px"></i>Denied</button>';
                        }
                    }
                
                }else {
                    if($counter != 0){  
                        $request_atributes = DB::select("SELECT request_status AS sta FROM shift_request WHERE id_offer='$id_offer' ");
                        $current_status = $request_atributes[0]->sta; 
                        if($current_status == 1){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-secondary"
                            style="float:right" disabled><i class="bi bi-calendar-minus"  style="margin-right: 5px"></i>Unconfirmed</button>';
                        }else if($current_status == 0){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-success"
                            style="float:right" ><i class="bi bi-calendar2-check" style="margin-right: 5px"></i>Granted</button>';
                        }else if($current_status == 2){
                            $get_offer[$i - 1] = $get_offer[$i - 1] . '<button id="b-' . $id_encrypt . '" class="mt-1 mx-2 btn btn-sm btn-danger"
                            style="float:right" ><i class="bi bi-calendar2-x" style="margin-right: 5px"></i>Denied</button>';
                        }
                    }
                }
                $get_offer[$i - 1] = $get_offer[$i - 1] . '</div>
             </div>
        </div>';
            }
            }
            $get_offer[$i - 1] = $get_offer[$i - 1] . "</div>";
        }

        for ($i = 1; $i < 32; $i++) {
            if ($i < 9) {
                $day = "0" . ($i);
            } else {
                $day = ($i);
            }
            $date = $td . "-" . $day;
            $month_shift = DB::select("SELECT * FROM shift_active_data WHERE shift_active_data.saved_at='$date' AND shift_active_data.id='$id' ");
            $counter = 0;

            foreach ($month_shift as $result_shift) {
                array_push($shift_month, $result_shift->saved_at);
            }
        }

        return response()->json([
            'offer' => $get_offer,
            'tooltip' => $tooltip_arr,
            'tooltip_user' => $tooltip_arr_user,
            'tooltip_comments' => $tooltip_comments,
            'comments_id' => $comments_arr,
            'shift_month' => $shift_month,
            'main' => $get_main,
            'icon' => $main_icon,
            'creation' => $creation,


        ]);

    }

    function sendOffer(Request $request)
    {
        $id = Auth::id();
        $my_input = $request->input('id_offer');
        $id_offer = Crypt::decrypt($my_input);
        error_log("sssad". $my_input);
        DB::insert("REPLACE INTO shift_request (id_offer, id, requested_at, request_status) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP, 1)");
    }
    function deleteOffer(Request $request)
    {
        $id = Auth::id();
        $id_offer = Crypt::decrypt($request->input('id_offer'));
       DB::delete("DELETE FROM shift_request WHERE id_offer='$id_offer' AND id='$id' ");
    }

    public function subObject($searching, $obj_id, $obj_name, $obj_superior, $icons, $search_object,array &$get_main, $main, array &$main_icon, $icon)
    {

        for ($i = 0; $i < count($obj_name); $i++) {
            if ($searching == $obj_superior[$i]) {   
                if ($obj_id[$i]  != null) {

                    if($search_object == $obj_id[$i]){
                        array_push($get_main, $main);
                        array_push($main_icon, $icon);
                        break;

                    }
                   for ($h = 0; $h < count($obj_name); $h++) {
                        if ($obj_id[$i]  == $obj_superior[$h]) {
                            $this->subObject($obj_id[$i] , $obj_id, $obj_name, $obj_superior, $icons, $search_object, $get_main, $main, $main_icon, $icon);
                            break;
                        }
                    }
                }
            }
        }


    }
}
?>