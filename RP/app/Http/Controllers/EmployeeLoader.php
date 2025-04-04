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

class EmployeeLoader extends Controller
{
  function LoadNumberAll()
  {

    $fetch = DB::select("SELECT COUNT(*) AS count FROM users");
    $count = $fetch[0]->count;
    return $count;
  }
  public function showProfile($id)
  {
   
    $user = User::find($id);
    return view('admin/employee-list-personal', compact('user'));
  }
  public function showProfileManager($id)
  {
   
    $user = User::find($id);
    return view('manager/employee-list-personal', compact('user'));
  }
  public function showProfileEmployee($id)
  {
   
    $user = User::find($id);
    $user_sender = User::find(Auth::id());
    if($user_sender->role == "parttime"){
      return view('part_time/employee-list-personal', compact('user'));

    }else{
      return view('full_time/employee-list-personal', compact('user'));
    }
  }
  public function showChatify ($id){
    
    $user = User::find($id);
  }
  function loadEmployee(Request $request)
  {

    $input = $request->input('input');
    $admin = $request->admin;
    $manager = $request->manager;
    $fullTime = $request->full;
    $partTime = $request->part;
    $id = Auth::id();
    $fetch_position = DB::select("SELECT role AS r FROM  users WHERE id='$id'");
    $role = $fetch_position[0]->r;

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
    $arr = array();
    $arr_filter = array();
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
      echo "<ul class='list-group overflow-auto'>";
      echo "<li class='list-group-item bg-light list-group-item-action '>";
      echo '<div class="row">
      <div class="col-6 col-sm-3">
          <h5>Name</h5>
      </div>
      <div class="col-0 col-sm-2 d-none d-sm-inline">
          <h5>Position</h5>
      </div>
      <div class="col-0 col-sm-3 d-none d-sm-inline">
          <h5>Email</h5>
      </div>
      <div class="col-0 col-sm-2 d-none d-sm-inline">
          <h5>Status</h5>
      </div>
      <div class="col-6 col-sm-2">
          <center><h5>Action</h5></center>
      </div>
  </div>';
  echo '</li>';
  echo "<li class='list-group-item list-group-item-action '>";

      echo "<h5> No data found</h5>";
      echo '</li>';

      echo '</ul>';
    } else {
     echo "<ul class='list-group overflow-auto'>";
     echo "<li class='list-group-item bg-light list-group-item-action '>";
     echo '<div class="row">
     <div class="col-6 col-sm-3">
         <h5>Name</h5>
     </div>
     <div class="col-0 col-sm-2 d-none d-sm-inline">
         <h5>Position</h5>
     </div>
     <div class="col-0 col-sm-3 d-none d-sm-inline">
         <h5>Email</h5>
     </div>
     <div class="col-0 col-sm-2 d-none d-sm-inline">
         <h5>Status</h5>
     </div>
     <div class="col-6 col-sm-2">
         <center><h5>Action</h5></center>
     </div>
 </div>';
 echo '</li>';
      for ($d = 0; $d < count($id_arr); $d++) {
        if (in_array($position_arr[$d], $allowed_positions) || count($allowed_positions) == 0) {
        echo "<li class='list-group-item list-group-item-action '>";
        

        echo '<div class="row" style="height: 45px; align-items: center;">';
        $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $id_arr[$d]");
        if ($fetch_count[0]->count > 0) {
          $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $id_arr[$d]");
          $link_image = "";
          foreach ($fetch_link as $result_link) {
            $link_image = $result_link->image_link;
          }
          $imageUrl = Storage::url($link_image);
          echo ' <div class="col-6 col-sm-3"><img src="' . $imageUrl . '"';
        } else {
          $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
          echo ' <div class="col-6 col-sm-3"><img src="' . $imageUrl . '"';
        }

        echo '      alt="" class="avatar-sm rounded-circle me-2 d-none d-sm-inline"  style="height: 25px; width: 25px" />';
        echo '<a      href="#" class="text-body">' . $firstname_arr[$d] . ' ' . $middlename_arr[$d] . ' ' . $lastname_arr[$d] . '</a></div>';
        if ($position_arr[$d] == 'admin') {
          echo '  <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="p-1 rounded text-bg-dark">Administrator</span>
</div>';
        } else if ($position_arr[$d] == 'manager') {
          echo '  <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="p-1 rounded text-bg-danger">Manager</span></div>';
        } else if ($position_arr[$d] == 'fulltime') {
          echo '  <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="p-1 rounded text-bg-primary">Full-Time</span></div>';

        } else if ($position_arr[$d] == 'parttime') {
          echo '  <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="p-1 rounded text-bg-success">Part-Time</span></div>';

        }

        echo '  <div class="col-0 col-sm-3 d-none d-sm-inline">' . $email_arr[$d] . '</div>';
        if ($status_arr[$d] == 1) {
          echo ' <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="border border-success text-success p-1 rounded">Active</span></div>';
        } else {
          echo ' <div class="col-0 col-sm-2 d-none d-sm-inline"><span class="border border-warning text-warning p-1 rounded">Suspended</span></div>';

        }
        echo ' <div class="col-6 col-sm-2">';


        echo '     <ul class="list-inline mb-0"><center>';

 
        echo '   <li class="list-inline-item dropdown"><center>';
        echo '        <a class="text-muted dropdown-toggle font-size-18 px-2"';
        if ($role == 'fulltime' || $role == 'parttime') {
          echo ' href="' . route('profileEmployee', ['id' => $id_arr[$d]]) .'" ';
          echo' role="button" ';

        }else{
          echo ' href="#"';
          echo' role="button" data-bs-toggle="dropdown"';


        }            
        echo '           aria-haspopup="true"><i';
        echo '              class="bx bx-dots-vertical-rounded"></i></a>';
    
        if($role == "admin"){
          echo '     <div class="dropdown-menu dropdown-menu-end">';
          echo '         <a class="dropdown-item " href="' . route('profile', ['id' => $id_arr[$d]]) . '"><i';
          echo '             class="bx bx-pencil text-primary font-size-18"></i>&nbsp;Edit</a><a';
          echo '             class="dropdown-item" href="/chatify/'. $id_arr[$d].   '"><i class="bi bi-chat-dots"></i>&nbsp;Message';
          echo '</a><a class="dropdown-item"';
          echo '              href="' . route('showCertainStatistics', ['id' => $id_arr[$d]]) . '"><i class="bi bi-bar-chart-line"></i>&nbsp;Stats</a>';
          echo '      </div>';
        }else if($role == "manager"){
          echo '     <div class="dropdown-menu dropdown-menu-end">';
          echo '         <a class="dropdown-item " href="' . route('profileManager', ['id' => $id_arr[$d]]) . '"><i';
          echo '             class="bx bx-pencil text-primary font-size-18"></i>&nbsp;Edit</a><a';
          echo '             class="dropdown-item" href="/chatify/'. $id_arr[$d].   '"><i class="bi bi-chat-dots"></i>&nbsp;Message';
          echo '</a>';
          echo '      </div>';

     
        }
  
        echo '       </center></li>';
        echo '      </ul> </center>';
        echo '</div>';

        echo '</div>';
        echo '</li>';
      }
      }
      echo '</ul>';
      
    }
  }
  public function calendarEmployeeSearch(Request $request)
  {
    $roles = $request->input('roles');
    $shift = $request->input('shift');
    $search_text = $request->input('search_text');


    $arr = array();
    $arr_filter = array();
    trim($search_text);

    $arr = explode(" ", $search_text);



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

          if ((in_array($result_users->role, $roles) || in_array("|--ALL--|", $roles)) && $result_users->status == 1) {
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



    }
    $all_response = "";
    if (count($id_arr) == 0) {
      $all_response .= "<h6> No data found</h6>";
    } else {
      $all_response .= "<ul class='list-group overflow-auto' style='max-height: 350px;'>";


      for ($d = 0; $d < count($id_arr); $d++) {
        $all_response .= "<li id='a_a-$id_arr[$d]' onclick='pickUser(this.id)' class='list-group-item list-group-item-action d-flex justify-content-between'>";
        $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $id_arr[$d]");
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
        $all_response .= '<div class="text-body mx-2" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">' . $firstname_arr[$d] . ' ' . $middlename_arr[$d] . ' ' . $lastname_arr[$d] . '</div>';
        if ($position_arr[$d] == 'admin') {
          $all_response .= '  <div><span class="py-1 px-2 rounded-circle text-bg-dark">A</span></div>';
        } else if ($position_arr[$d] == 'manager') {
          $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-danger">M</span></div>';
        } else if ($position_arr[$d] == 'fulltime') {
          $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-primary">F</span></div>';

        } else if ($position_arr[$d] == 'parttime') {
          $all_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-success">P</span></div>';

        }
        $all_response .= "</li>";
        //echo "</div>";
      }
      $all_response .= "</ul>";



    }
    $asign_response = "";
    if (count($id_arr) == 0) {
      $asign_response .= "<h6> No data found</h6>";

    } else {
      $asign_response .= "<ul class='list-group overflow-auto' style='max-height: 350px;'>";

      for ($d = 0; $d < count($id_arr); $d++) {

        $counter_assignment = 0;
        $fetch_assignment = DB::select("SELECT COUNT(*) as count FROM shift_assignment WHERE id='$id_arr[$d]' AND id_shift='$shift' ");
        $counter_assignment = $fetch_assignment[0]->count;
        if ($counter_assignment == 1) {
          $asign_response .= "<li id='a_s-$id_arr[$d]' onclick='pickUser(this.id)' class='list-group-item list-group-item-action d-flex justify-content-between'>";

          $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $id_arr[$d]");
          if ($fetch_count[0]->count > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $id_arr[$d]");
            $link_image = "";
            foreach ($fetch_link as $result_link) {
              $link_image = $result_link->image_link;
            }
            $imageUrl = Storage::url($link_image);
            $asign_response .= ' <img src="' . $imageUrl . '"';
          } else {
            $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            $asign_response .= '<img src="' . $imageUrl . '"';
          }

          $asign_response .= '      alt="" class="avatar-sm rounded-circle"  style="height: 25px; width: 25px" />';
          $asign_response .= '<div class="text-body mx-2" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">' . $firstname_arr[$d] . ' ' . $middlename_arr[$d] . ' ' . $lastname_arr[$d] . '</div>';
          if ($position_arr[$d] == 'admin') {
            $asign_response .= '  <div><span class="py-1 px-2 rounded-circle text-bg-dark">A</span></div>';
          } else if ($position_arr[$d] == 'manager') {
            $asign_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-danger">M</span></div>';
          } else if ($position_arr[$d] == 'fulltime') {
            $asign_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-primary">F</span></div>';

          } else if ($position_arr[$d] == 'parttime') {
            $asign_response .= '  <div><span class="py-1 px-2 rounded-circle rounded text-bg-success">P</span></div>';

          }
          $asign_response .= "</li>";
        }
      }
      $asign_response .= "</ul>";
    }
    return response()->json([
      'all_response' => $all_response,
      'asign_response' => $asign_response,
    ]);
  }

  public function getNameRole(Request $request){
    $id = $request->input('id');
    $full_name = "";
    $role = "";
    $fetch = DB::select("SELECT first_name, middle_name, last_name, role FROM users WHERE id='$id'");
    foreach ($fetch as $result) {
      $full_name = $result->first_name. " ".$result->middle_name. " ". $result->last_name;
      $role = $result->role;
    }
    if ( $role  == 'admin') {
      $role  = '  <span class="p-1 rounded text-bg-dark">Administrator</span>';
    } else if ( $role == 'manager') {
      $role  = '  <span class="p-1 rounded text-bg-danger">Management</span>';
    } else if ( $role == 'fulltime') {
      $role  = '  <span class="p-1 rounded text-bg-primary">Full-Time</span>';

    } else if ( $role  == 'parttime') {
      $role  = '<span class="p-1 rounded text-bg-success">Part-Time</span>';

    }
    return response()->json([
      'name' => $full_name,
      'role' => $role,
    ]);

  }

}



?>