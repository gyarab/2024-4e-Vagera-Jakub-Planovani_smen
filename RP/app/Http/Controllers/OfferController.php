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
      //$user = DB::select("SELECT * FROM users WHERE id='$id'"); // Fetch user from database
      //$user = 5;
      $offer_shift = DB::select(" SELECT * FROM shift_offer, shift_model, object_model, shift_active_data, users WHERE shift_active_data.id_shift = shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_offer.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object AND users.id=shift_offer.created_by  AND shift_offer.id_offer='$id' ");
      $usera = User::find($id);
      return view('admin/detail-offer', compact('offer_shift'));
    }
    function adminGetAllOffer(Request $request)
    {
        $get_offer = array();
        $tooltip_arr = array();
        $tooltip_arr_user = array();
        $comments_arr = array();
        $tooltip_comments = array();
        $shift_month = array();
        $id = Auth::id();
        //tooltip_arr_user
        $td = $request->input('date');

        for ($i = 1; $i < 32; $i++) {
            if ($i < 9) {
                $day = "0" . ($i);
            } else {
                $day = ($i);
            }
            $date = $td . "-" . $day;
            // echo ("SELECT * FROM shift_active_data, shift_model, object_model, shift_offer, shift_assignment WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at='$date' ORDER BY shift_active_data.saved_from");
            $today_offer = DB::select("SELECT * FROM users, shift_active_data, shift_model, object_model, shift_offer, shift_assignment WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$date' AND users.id=shift_offer.created_by LIMIT 1");
            $counter = 0;
            $get_offer[$i - 1] = "<div class='row'>";
            $request_count = DB::select("SELECT * FROM users, shift_active_data, shift_model, object_model, shift_offer, shift_assignment WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$date' AND users.id=shift_offer.created_by LIMIT 1");

            foreach ($today_offer as $result) {
                $counter++;
                $id_offer = $result->id_offer;
                $request_count = DB::select("SELECT COUNT(*) AS count FROM shift_request WHERE id_offer='$id_offer' ");
                $counter = $request_count[0]->count;

                $id_encrypt = Crypt::encrypt($result->id_offer);
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
                array_push($tooltip_arr, $id_encrypt);
                array_push($tooltip_arr_user, $result->last_name . " " . $result->middle_name . " " . $result->first_name);
                if ($result->comments == null || $result->comments == "") {

                    $get_offer[$i - 1] = $get_offer[$i - 1] . '<i id="cm-' . $id_encrypt . '" class="bi bi-chat-fill mx-2" style="font-size: 20px; margin-top: 15px; "></i>';
                } else {
                    array_push($comments_arr, $id_encrypt);

                    array_push($tooltip_comments, $result->comments);
                    $get_offer[$i - 1] = $get_offer[$i - 1] . '<i id="cm-' . $id_encrypt . '" class="bi bi-chat-fill mx-2" style="font-size: 20px; margin-top: 15px;color:#0d6efd ; "></i>';
                }
               // $request_personal = DB::select("SELECT COUNT(*) AS count FROM shift_request WHERE id_offer='$id_offer' ");

                if (strtotime($date) >= strtotime('-1 days')) {
                    // this is true
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
            $get_offer[$i - 1] = $get_offer[$i - 1] . "</div>";
        }

        for ($i = 1; $i < 32; $i++) {
            if ($i < 9) {
                $day = "0" . ($i);
            } else {
                $day = ($i);
            }
            $date = $td . "-" . $day;
            // echo ("SELECT * FROM shift_active_data, shift_model, object_model, shift_offer, shift_assignment WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at='$date' ORDER BY shift_active_data.saved_from");
            $month_shift = DB::select("SELECT * FROM shift_active_data WHERE shift_active_data.saved_at='$date' AND shift_active_data.id='$id' ");
            $counter = 0;

            foreach ($month_shift as $result_shift) {
                array_push($shift_month, $result_shift->saved_at);
                //shift_month 
            }
        }

        return response()->json([
            'offer' => $get_offer,
            'tooltip' => $tooltip_arr,
            'tooltip_user' => $tooltip_arr_user,
            'tooltip_comments' => $tooltip_comments,
            'comments_id' => $comments_arr,
            'shift_month' => $shift_month


        ]);
        //return $today_offer;

    }

    function sendOffer(Request $request)
    {
        $id = Auth::id();
        $id_offer = Crypt::decrypt($request->input('id_offer'));
        DB::insert("REPLACE INTO shift_request (id_offer, id, requested_at, request_status) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP, 1)");
        //echo "REPLACE INTO id_request (id_offer, id, requested_at) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP)";
    }
    function deleteOffer(Request $request)
    {
        $id = Auth::id();
        $id_offer = Crypt::decrypt($request->input('id_offer'));
       // DB::delete("REPLACE INTO shift_request (id_offer, id, requested_at, request_status) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP, 1)");
        //echo "REPLACE INTO id_request (id_offer, id, requested_at) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP)";
       DB::delete("DELETE FROM shift_request WHERE id_offer='$id_offer' AND id='$id' ");
    }
}
?>