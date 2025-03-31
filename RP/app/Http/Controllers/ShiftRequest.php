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


class ShiftRequest extends Controller
{
    public function requestProfile(Request $request)
    {
        $input_id = $request->input('input');
        $fetch_offers = DB::select("SELECT COUNT(*) AS count FROM shift_offer WHERE shift_offer.id_offer='$input_id' AND shift_offer.accepted_at IS NOT NULL ");
        $counter = $fetch_offers[0]->count;
        $imageUrl = "";
        $name = "";
        $role = "";
        if ($counter == 0) {
            $name = "";
        } else {
            $fetch_requests = DB::select("SELECT * FROM shift_request, users WHERE shift_request.id_offer='$input_id'  AND shift_request.request_status='0' AND shift_request.id=users.id ORDER BY shift_request.requested_at");
            foreach ($fetch_requests as $result_request) {
                $name = $result_request->last_name . " ". $result_request->middle_name. " ". $result_request->first_name;
                $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$result_request->id' ");
                if ($fetch_count[0]->count > 0) {
                    $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $result_request->id");
                    $link_image = "";
                    foreach ($fetch_link as $result_link) {
                        $link_image = $result_link->image_link;
                    }
                    $imageUrl = Storage::url($link_image);
                } else {
                    $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                }
                if ( $result_request->role == 'admin') {
                    $role  = '  <span class="p-1 rounded text-bg-dark">Administrator</span>';
                  } else if ($result_request->role == 'manager') {
                    $role  = '  <span class="p-1 rounded text-bg-danger">Management</span>';
                  } else if ( $result_request->role == 'fulltime') {
                    $role  = '  <span class="p-1 rounded text-bg-primary">Full-Time</span>';
              
                  } else if ( $result_request->role  == 'parttime') {
                    $role  = '<span class="p-1 rounded text-bg-success">Part-Time</span>';
              
                  }
           }
          
        }
        return response()->json([
            'imageUrl' => $imageUrl,
            'name' => $name,
            'role' => $role,
        ]);
    }
    public function loadRequestTable(Request $request)
    {
        $input_id = $request->input('input');
        $all_response = "";
        $id_arr = array();
        $position_arr = array();
        $firstname_arr = array();
        $middlename_arr = array();
        $lastname_arr = array();
        $fetch_offers = DB::select("SELECT * FROM shift_offer WHERE shift_offer.id_offer='$input_id' ");
        foreach ($fetch_offers as $result_offer) {
            $date = $result_offer->date;
        }
        $fetch_requests = DB::select("SELECT * FROM shift_request, users WHERE shift_request.id_offer='$input_id' AND shift_request.id=users.id ORDER BY shift_request.requested_at");
        foreach ($fetch_requests as $result_request) {
            array_push($id_arr, $result_request->id);
            array_push($position_arr, $result_request->role);
            array_push($firstname_arr, $result_request->first_name);
            array_push($middlename_arr, $result_request->middle_name);
            array_push($lastname_arr, $result_request->last_name);
        }
        if (count($id_arr) == 0) {
            $all_response .= "<ul class='list-group overflow-auto' style='max-height: 350px;'>";
            $all_response .= "<li class='list-group-item list-group-item-action bg-light'>";
            $all_response .= "<div class='row'>";
            $all_response .= "<div class='col-2'>";
            $all_response .= "<h6 class='d-none d-md-block mb-0'>Order</h6>";
            $all_response .= "<h6 class='d-block d-md-none mb-0'>N</h6>";

            $all_response .= "</div>";
            $all_response .= "<div class='col-8'>";
            $all_response .= "<h6 class='mb-0'>Name</h6>";
            $all_response .= "</div>";
            $all_response .= "<div class='col-2'>";
            $all_response .= "<center><h6 class='d-none d-md-block mb-0'>Position</h6></center>";
            $all_response .= "<center><h6 class='d-block d-md-none mb-0'>P</h6></center>";
            $all_response .= "</div>";
            $all_response .= "</div>";
            $all_response .= "</li>";
            $all_response .= "</ul>";
        } else {
            $all_response .= "<ul class='list-group overflow-auto' style='max-height: 350px;'>";
            $all_response .= "<li class='list-group-item list-group-item-action bg-light'>";
            $all_response .= "<div class='row'>";
            $all_response .= "<div class='col-2'>";
            $all_response .= "<h6 class='d-none d-md-block mb-0'>Order</h6>";
            $all_response .= "<h6 class='d-block d-md-none mb-0'>N</h6>";

            $all_response .= "</div>";
            $all_response .= "<div class='col-8'>";
            $all_response .= "<h6 class='mb-0'>Name</h6>";
            $all_response .= "</div>";
            $all_response .= "<div class='col-2'>";
            $all_response .= "<center><h6 class='d-none d-md-block mb-0'>Position</h6></center>";
            $all_response .= "<center><h6 class='d-block d-md-none mb-0'>P</h6></center>";
            $all_response .= "</div>";
            $all_response .= "</div>";
            $all_response .= "</li>";
            
            $currdate = date("Y-m-d");
            for ($d = 0; $d < count($id_arr); $d++) {
                if ($date >= $currdate) {
                    $all_response .= "<li id='a_a-$id_arr[$d]' onclick='pickUser(this.id)' class='list-group-item list-group-item-action'>";
                } else {
                    $all_response .= "<li id='a_a-$id_arr[$d]' class='list-group-item list-group-item-action'>";
                }
                $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $id_arr[$d]");
                $all_response .= "<div class='row'><div class='col-2' ><p class='m-0'>";
                $all_response .= ($d + 1) . ".</p></div><div class='col-1'>";
                if ($fetch_count[0]->count > 0) {
                    $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $id_arr[$d]");
                    $link_image = "";
                    foreach ($fetch_link as $result_link) {
                        $link_image = $result_link->image_link;
                    }
                    $imageUrl = Storage::url($link_image);
                    $all_response .= ' <img src="' . $imageUrl . '"';
                } else {
                    $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                    $all_response .= '<img src="' . $imageUrl . '"';
                }
                $all_response .= '      alt="" class="avatar-sm rounded-circle"  style="height: 25px; width: 25px" />';

                $all_response .= "</div><div class='col-7'>";
                $all_response .= '<p  class="text-body mx-1 m-0" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">' . $firstname_arr[$d] . ' ' . $middlename_arr[$d] . ' ' . $lastname_arr[$d] . '</p>';
                $all_response .= "</div><div class='col-2'><center>";
                if ($position_arr[$d] == 'admin') {
                    $all_response .= '  <div><span class="py-1 px-2 rounded-circle text-bg-dark">A</span></div>';
                } else if ($position_arr[$d] == 'manager') {
                    $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-danger">M</span></div>';
                } else if ($position_arr[$d] == 'fulltime') {
                    $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-primary">F</span></div>';

                } else if ($position_arr[$d] == 'parttime') {
                    $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-success">P</span></div>';

                }
                $all_response .= "</center></div></div>";
            
            }
            $all_response .= "</ul>";




        }
        echo $all_response;
    }
    public function loadRequestWaiting(Request $request)
    {
        $obj_id = array();
        $obj_name = array();
        $obj_superior = array();
        $final_id = array();
        $local_id = array();
        $waiting_final = array();
        $returns = "";
        $returns = $returns . '<div class="row pt-2 mx-1 ">
        <div class="col-2">
            <h6>Date</h6>
        </div>
        <div class="col-5">
            <h6>Name</h6>
        </div>
        <div class="col-2">
            <center>
            <h6>Requests</h6>
   </center>
        </div>
        <div class="col-1">
            <center>
                <h6>Status</h6>
            </center>
        </div>
        <div class="col-2">
            <center>
                <h6>Action</h6>
            </center>
        </div>
    </div>';
    $id = Auth::id();
    $rights = array();
    $admin = false;
    $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id'");

        
    $role = $fetch_position[0]->r;
    if($role == "admin"){
        $admin = true;
    }
    $fetch_rights = DB::select("SELECT * FROM management_rights WHERE id='$id'");
    foreach ($fetch_rights as $result_rights) {
        array_push($rights, $result_rights->id_object);

    } 
        $main_obj = $request->input('main_obj');
        $main_obj_decrypted = Crypt::decrypt($main_obj);
        $fetch_object = DB::select("SELECT * FROM object_model");
        foreach ($fetch_object as $result_obj) {
            $obj_id[] = $result_obj->id_object;
            $obj_name[] = $result_obj->object_name;
            $obj_superior[] = $result_obj->superior_object_id;
        }
        for ($x = 0; $x < count($obj_id); $x++) {

            if ($obj_superior[$x] == 0 && $obj_id[$x] == $main_obj_decrypted) {
                $shift_arr = array();
                $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$obj_id[$x]' ");
                foreach ($fetch_shifts as $result_shift) {
                    if ($admin == true || in_array($result_shift->id_shift, $rights) == true) {
                        array_push($final_id, $result_shift->id_shift);


                    }
             
                }

                for ($h = 0; $h < count($obj_id); $h++) {
                    if ($obj_id[$x] == $obj_superior[$h]) {
                        $this->search_shift($obj_id[$x], $obj_id, $obj_name, $obj_superior, $final_id, $obj_id[$x], $local_id, $admin, $rights);
                        break;
                    }
                }

            }

        }
        if (count($final_id) != null) {


            for ($x = 0; $x < count($final_id); $x++) {
                $t = date("Y-m-d");
                $fetch_request = DB::select("SELECT COUNT(*) AS count FROM shift_offer WHERE shift_offer.id_shift='$final_id[$x]' AND shift_offer.accepted_at IS NULL AND shift_offer.date >= '$t' ");
                $counter_waiting = $fetch_request[0]->count;
                if ($counter_waiting != 0) {
                    array_push($waiting_final, $final_id[$x]);
                    $fetch_request2 = DB::select("SELECT * FROM shift_offer, shift_model, object_model WHERE shift_offer.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object AND shift_offer.id_shift='$final_id[$x]' AND shift_offer.accepted_at IS NULL AND shift_offer.date >= '$t' ");
                    foreach ($fetch_request2 as $result_request) {
                        $fetch_counter = DB::select("SELECT COUNT(*) AS count FROM shift_offer, shift_request WHERE shift_offer.id_offer=shift_request.id_offer AND shift_offer.id_shift='$final_id[$x]'  AND  shift_offer.date='$result_request->date' ");

                        $returns = $returns . '
            <li class="list-group-item p-0 m-0">
                <div class="row p-0 m-0">
          <div class="col-2 p-0 m-0">
                       <div class="card rounded-0 border-top-0 border-bottom-0 border-end-0"
                            style="border-width: 10px; border-color:' . $result_request->color . ';">
                                <strong><p class="py-2 mx-2 my-0 ">
                                ' . $result_request->date . '
                            </p></strong>
                              </div>
         </div>
                    <div class="col-5 p-0 m-0">
           
                            <p class="py-2 mx-3 my-0 ">
                                ' . $result_request->object_name . ' - ' . $result_request->shift_name . '
                            </p>
        
                    </div>
                    <div class="col-2 ">
                         <center><p class="py-2 my-0"> ' . $fetch_counter[0]->count . '</p></center>
                    </div>
                    <div class="col-1 ">
                        <center>
                            <p class="py-2 my-0"><i class="bi bi-hourglass-split" style="color: #FFBF00 "></i></p>
                        </center>
                    </div>
        
                    <div class="col-2">
                        <center>
                            <a href="' . route('showOffer', ['id' => $result_request->id_offer]) . '" style="text-decoration: none;color: black;"><p class="py-2 my-0"><i class="bi bi-three-dots-vertical"></i></p></a>
                        </center>
                    </div>
                </div>
            </li> ';
                    }
                }
            }
        }

        return response()->json([
            'returns' => $returns,

        ]);
    }
    public function loadRequestHistory(Request $request)
    {
        $obj_id = array();
        $obj_name = array();
        $obj_superior = array();
        $final_id = array();
        $local_id = array();
        $history_final = array();
        $returns = "";
        $returns = $returns . '<div class="row pt-2 mx-1 ">
        <div class="col-2">
            <h6>Date</h6>
        </div>
        <div class="col-5">
            <h6>Name</h6>
        </div>
        <div class="col-2">
         <center>
            <h6>Requests</h6>
</center>
        </div>
        <div class="col-1">
            <center>
                <h6>Status</h6>
            </center>
        </div>
        <div class="col-2">
            <center>
                <h6>Action</h6>
            </center>
        </div>
    </div>';
    $id = Auth::id();
    $rights = array();
    $admin = false;
    $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id'");

        
    $role = $fetch_position[0]->r;
    if($role == "admin"){
        $admin = true;
    }
    $fetch_rights = DB::select("SELECT * FROM management_rights WHERE id='$id'");
    foreach ($fetch_rights as $result_rights) {
        array_push($rights, $result_rights->id_object);

    } 
        $main_obj = $request->input('main_obj');
        $year = $request->input('year');
        $month = $request->input('month');
        $YM = $year . "-" . $month;
        $main_obj_decrypted = Crypt::decrypt($main_obj);
        $fetch_object = DB::select("SELECT * FROM object_model");
        foreach ($fetch_object as $result_obj) {
            $obj_id[] = $result_obj->id_object;
            $obj_name[] = $result_obj->object_name;
            $obj_superior[] = $result_obj->superior_object_id;
        }
        for ($x = 0; $x < count($obj_id); $x++) {

            if ($obj_superior[$x] == 0 && $obj_id[$x] == $main_obj_decrypted) {
       
                $shift_arr = array();
                $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$obj_id[$x]' ");
                foreach ($fetch_shifts as $result_shift) {

                   
                    array_push($final_id, $result_shift->id_shift);
                  
                }

                for ($h = 0; $h < count($obj_id); $h++) {
                    if ($obj_id[$x] == $obj_superior[$h]) {
                        $this->search_shift($obj_id[$x], $obj_id, $obj_name, $obj_superior, $final_id, $obj_id[$x], $local_id, $admin, $rights);
                        break;
                    }
                }

            }

        }
        if (count($final_id) != null) {


            for ($x = 0; $x < count($final_id); $x++) {
                $t = date("Y-m-d");
                $fetch_request = DB::select("SELECT * FROM shift_offer, shift_model, object_model WHERE shift_offer.id_shift=shift_model.id_shift AND object_model.id_object=shift_model.id_object AND shift_offer.id_shift='$final_id[$x]' AND shift_offer.date LIKE '$YM%'");
                foreach ($fetch_request as $result_request) {
                    $fetch_counter = DB::select("SELECT COUNT(*) AS count FROM shift_offer, shift_request WHERE shift_offer.id_offer=shift_request.id_offer AND shift_offer.id_shift='$final_id[$x]' AND  shift_offer.date='$result_request->date'  ");

                    $returns = $returns . '
                    <li class="list-group-item p-0 m-0">
                        <div class="row p-0 m-0">
                  <div class="col-2 p-0 m-0">
                               <div class="card rounded-0 border-top-0 border-bottom-0 border-end-0"
                                    style="border-width: 10px; border-color:' . $result_request->color . ';">
                                        <strong><p class="py-2 mx-2 my-0 ">
                                        ' . $result_request->date . '
                                    </p></strong>
                                      </div>
                 </div>
                            <div class="col-5 p-0 m-0">
                   
                                    <p class="py-2 mx-3 my-0 ">
                                        ' . $result_request->object_name . ' - ' . $result_request->shift_name . '
                                    </p>
                
                            </div>
                            <div class="col-2 ">
                                <center><p class="py-2 my-0"> ' . $fetch_counter[0]->count . '</p></center>
                            </div>
                            <div class="col-1 ">
                                <center>';
                    if ($result_request->date >= $t && $result_request->accepted_at == null) {
                        $returns = $returns . '  <p class="py-2 my-0"><i class="bi bi-hourglass-split" style="color: #FFBF00 "></i></p> ';
                    } else if ($result_request->date < $t && $result_request->accepted_at == null) {
                        $returns = $returns . '  <p class="py-2 my-0"><i class="bi bi-dash-circle"></i></p> ';
                    } else if ($result_request->date < $t && $result_request->accepted_at != null) {
                        $returns = $returns . '  <p class="py-2 my-0"><i class="bi bi-check-circle"  style="color: green "></i></p> ';
                    } else if ($result_request->date >= $t && $result_request->accepted_at != null) {
                        $returns = $returns . '  <p class="py-2 my-0"><i class="bi bi-check-circle"  style="color: green "></i></p> ';

                    }

                    $returns = $returns . ' </center>
                            </div>
                
                            <div class="col-2">
                                <center>
                                    <a href="' . route('showOffer', ['id' => $result_request->id_offer]) . '" style="text-decoration: none;color: black;"><p class="py-2 my-0"><i class="bi bi-three-dots-vertical"></i></p></a>
                                </center>
                            </div>
                        </div>
                    </li> ';

                }

            }
        }

        return response()->json([
            'returns' => $returns,

        ]);
    }

    public function confirmRequest(Request $request)
    {
        $id_user = $request->input('id_user');
        $offer_date = $request->input('offer_date');
        $id_offer = $request->input('id_offer');
        $id_client = Auth::id();
        if($id_user != null || $id_user != 0){
        $current_date = date("Y-m-d");
        DB::update("UPDATE shift_request SET request_status='2' WHERE id_offer='$id_offer' ");
        DB::update("UPDATE shift_offer SET accepted_by='$id_client', accepted_at='$current_date' WHERE id_offer='$id_offer' ");
        $fetch_shift = DB::select("SELECT * FROM shift_offer  WHERE id_offer='$id_offer' ");
        foreach($fetch_shift as $result_shift){
            DB::update("UPDATE shift_active_data SET id='$id_user' WHERE saved_at='$offer_date' AND id_shift='$result_shift->id_shift' ");
            DB::update("UPDATE shift_planned_data SET id='$id_user' WHERE saved_at='$offer_date' AND id_shift='$result_shift->id_shift' ");

        }

        DB::update("UPDATE shift_request SET request_status='0' WHERE id_offer='$id_offer' AND id='$id_user' ");
    }

    }




    private function search_shift($search, $obj_id, $obj_name, $obj_superior, array &$final_id, $main_obj, array &$local_id, $admin, $rights)
    {
        $shift_arr = array();
        $finding = 0;
        for ($i = 0; $i < count($obj_id); $i++) {
            if ($search == $obj_superior[$i]) {
                $fetch_shifts = DB::select("SELECT * FROM shift_model WHERE id_object='$obj_id[$i]' ");
                foreach ($fetch_shifts as $result_shift) {

                    array_push($final_id, $result_shift->id_shift);
        
                }


                $sea = $obj_id[$i];
                if ($obj_id[$i] != null) {
                    for ($h = 0; $h < count($obj_id); $h++) {
                        if ($sea == $obj_superior[$h]) {
                            $finding = 1;
                            $this->search_shift($obj_id[$i], $obj_id, $obj_name, $obj_superior, $final_id, $main_obj, $local_id,$admin, $rights );
                            break;
                      
                        }

                    }
                }


            }
        }

    }
}


?>