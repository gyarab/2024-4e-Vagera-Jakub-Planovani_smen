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
use Illuminate\Support\Js;
use Illuminate\Http\JsonResponse;


class ApiOffersController extends Controller
{
    function getOffers(Request $request): JsonResponse
    {
        $get_offer = array();
        $id_arr = array();
        $object_arr = array();
        $color_arr = array();
        $from_arr = array();
        $to_arr = array();
        $shift_arr = array();



        $get_main = array();
        $tooltip_arr = array();
        $tooltip_arr_user = array();
        $comments_arr = array();
        $comments_arr = array();
        $visibility_arr = array();
        $status_arr = array();
        $search_object = array();


        $tooltip_comments = array();
        $shift_month = array();
        $assignment_shift = array();
        $creation = array();
        $from = array();
        $to = array();
        $jsonArray = [];

        $main_icon = array();
        $id = $request->id;

        $fetch_object = DB::select("SELECT * FROM object_model");
        $fetch_assignment = DB::select("SELECT * FROM shift_assignment WHERE id='$id' "); 

        $object_id = array();
        $object_name = array();
        $icons = array();

        $object_superior = array();

        foreach($fetch_assignment as $result_assignment){
            $assignment_shift[] = $result_assignment->id_shift;
        }

        foreach ($fetch_object as $result_object) {
            $object_id[] = $result_object->id_object;
            $object_name[] = $result_object->object_name;
            $object_superior[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
        }
        array_multisort($object_id, $object_name, $object_superior, $icons);

        $id = $request->id;
        $object = $request->object;


        $date = $request->date;
        for ($x = 0; $x < count($object_name); $x++) {

            if ($object == $object_id[$x]) {

                array_push($search_object, $object_id[$x]);
                for ($h = 0; $h < count($object_name); $h++) {
                    if ($object_id[$x] == $object_superior[$h]) {
                        $this->subObject($object_id[$x], $object_id, $object_name, $object_superior,  $search_object );
                        break;
                    }
                }
                break;
            }
        }

            $today_offer = DB::select("SELECT DISTINCT *, object_model.id_object AS id_obj FROM users, shift_active_data, shift_model, object_model, shift_offer WHERE shift_offer.date='$date' AND shift_offer.id_shift = shift_model.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$date' AND users.id=shift_offer.created_by ");

            $counter = 0;

            foreach ($today_offer as $result) {
                $counter++;
                if(in_array($result->id_shift, $assignment_shift) && in_array($result->id_obj, $search_object)){
                $id_offer = $result->id_offer;
                $request_count = DB::select("SELECT COUNT(*) AS count FROM shift_request WHERE id_offer='$id_offer' ");
                $counter = $request_count[0]->count;

                $id_encrypt = Crypt::encrypt($result->id_offer);
                array_push($id_arr, $result->id_offer);
                array_push($object_arr, $result->object_name);
                array_push($color_arr, $result->color);
                array_push($shift_arr, $result->shift_name);
                array_push($from_arr, substr($result->saved_from, 0, 5));
                array_push($to_arr, substr($result->saved_to, 0, 5));
           
                array_push($tooltip_arr, $id_encrypt);
                    array_push($creation, date('m/d/Y',$result->created_at));
                array_push($tooltip_arr_user, $result->last_name . " " . $result->middle_name . " " . $result->first_name);
                if ($result->comments == null || $result->comments == "") {
                    array_push($tooltip_comments, "");

                } else {
                    array_push($comments_arr, $id_encrypt);

                    array_push($tooltip_comments, $result->comments);
                }

                if (strtotime($date) >= strtotime('-1 days')) {
                    if($counter == 0){  
                   array_push($visibility_arr, 1 );
                   array_push($status_arr, 0 );
                }else{
                    array_push($visibility_arr, 1 );

                        $request_atributes = DB::select("SELECT request_status AS sta FROM shift_request WHERE id_offer='$id_offer' ");
                        $current_status = $request_atributes[0]->sta; 
                        if($current_status == 1){
                            array_push($status_arr, 1 );

                        }else if($current_status == 0){
                            array_push($status_arr, 2 );

                        }else if($current_status == 2){
                            array_push($status_arr, 3 );

                        }
                    }
                
                }else {
                    if($counter != 0){  
                        array_push($visibility_arr, 1 );

                        $request_atributes = DB::select("SELECT request_status AS sta FROM shift_request WHERE id_offer='$id_offer' ");
                        $current_status = $request_atributes[0]->sta; 
                        if($current_status == 1){
                            array_push($status_arr, 4 );

                        }else if($current_status == 0){
                            array_push($status_arr, 2 );

                        }else if($current_status == 2){
                            array_push($status_arr, 3 );

                        }
                    }else{
                        array_push($visibility_arr, 0 );
                        array_push($status_arr, 0 );

                    }
                }
 
                }
            }

        if (!empty($id_arr)) {
            for ($i = 0; $i < count($id_arr); $i++) {
                array_push($jsonArray, [
                    "id" => $id_arr[$i],
                    "object" => $object_arr[$i],
                    "color" => $color_arr[$i],
                    "shift" => $shift_arr[$i],
                    "from" => $from_arr[$i],
                    "to" => $to_arr[$i],
                    "creation" => $creation[$i],
                    "comments" => $tooltip_comments[$i],
                    "name" => $tooltip_arr_user[$i],
                    "status" => $status_arr[$i],
                    "visibility" => $visibility_arr[$i],
                ]);
            }
            
        }
        return response()->json(
            [
                "status" => "success",
                "data" => $jsonArray,
                "message" => "Offers fetched successfully",
            ],
        200
        );
    }
    public function subObject($searching, $obj_id, $obj_name, $obj_superior, array &$search_object)
    {

        for ($i = 0; $i < count($obj_name); $i++) {
            if ($searching == $obj_superior[$i]) {   
                if ($obj_id[$i]  != null) {
                    array_push($search_object, $obj_id[$i]);

                   for ($h = 0; $h < count($obj_name); $h++) {
                        if ($obj_id[$i]  == $obj_superior[$h]) {
                            $this->subObject($obj_id[$i] , $obj_id, $obj_name, $obj_superior, $search_object);
                            break;
                        }
                    }
                }
            }
        }


    }

    function updateOffer(Request $request): JsonResponse
    {
        $id = $request->id;
        $id_offer = $request->id_offer;
        DB::insert("REPLACE INTO shift_request (id_offer, id, requested_at, request_status) VALUES ('$id_offer', '$id' , CURRENT_TIMESTAMP, 1)");
        return response()->json(
            [
                "status" => "success",
                "message" => "Offers fetched successfully",
            ],
        200
        );
    }
    function deleteOffer(Request $request): JsonResponse
    {
        $id = $request->id;
        $id_offer = $request->id_offer;
       DB::delete("DELETE FROM shift_request WHERE id_offer='$id_offer' AND id='$id' ");
       return response()->json(
        [
            "status" => "success",
            "message" => "Offers fetched successfully",
        ],
    200
    );
    }

}
        
?>
