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
use App\Models\User;

class OptionsController extends Controller
{
    public function showPermanentOption($id)
    {
        $user = User::find($id);
        return view('admin/permanent-time-options', compact('user'));
    }
    public function insertPermanenntOption(Request $request)
    {
        $mon_f = $request->input('monf');
        $mon_t = $request->input('mont');
        $mon = $request->input('mond');

        $tue_f = $request->input('tuef');
        $tue_t = $request->input('tuet');
        $tue = $request->input('tued');

        $wed_f = $request->input('wedf');
        $wed_t = $request->input('wedt');
        $wed = $request->input('wedd');

        $thu_f = $request->input('thuf');
        $thu_t = $request->input('thut');
        $thu = $request->input('thud');

        $fri_f = $request->input('frif');
        $fri_t = $request->input('frit');
        $fri = $request->input('frid');

        $sat_f = $request->input('satf');
        $sat_t = $request->input('satt');
        $sat = $request->input('satd');

        $sun_f = $request->input('sunf');
        $sun_t = $request->input('sunt');
        $sun = $request->input('sund');

        $id = $request->input('id');

        $id_creator = Auth::id();

        $t = date("Y-m-d H:i:s");
        DB::insert("INSERT INTO permanent_time_options_logs (id, timestamp_at, made_by) VALUES ('$id','$t', '$id_creator')");
        $check_unique_row = DB::select("SELECT COUNT(*) AS count FROM permanent_time_options WHERE id='$id'");
        if ($check_unique_row[0]->count == 0) {
            DB::insert("INSERT INTO permanent_time_options (monday, mon_from, mon_to, tuesday, tue_from, tue_to, wednesday, wed_from, wed_to, thursday, thu_from, thu_to, friday, fri_from, fri_to, saturday, sat_from, sat_to, sunday, sun_from, sun_to, id)
VALUES
('$mon','$mon_f','$mon_t','$tue','$tue_f','$tue_t','$wed','$wed_f','$wed_t','$thu','$thu_f','$thu_t','$fri','$fri_f','$fri_t','$sat','$sat_f','$sat_t','$sun','$sun_f','$sun_t',$id)");
        } else {
            DB::update("UPDATE permanent_time_options SET monday='$mon', mon_from='$mon_f', mon_to='$mon_t', tuesday='$tue', tue_from='$tue_f', tue_to='$tue_t', wednesday='$wed', wed_from='$wed_f', wed_to='$wed_t', thursday='$thu', thu_from='$thu_f', thu_to='$thu_t', friday='$fri', fri_from='$fri_f', fri_to='$fri_t', saturday='$sat', sat_from='$sat_f', sat_to='$sat_t', sunday='$sun', sun_from='$sun_f', sun_to='$sun_t' WHERE id='$id'");

        }
    }
    public function loadPermanentOptions(Request $request)
    {
        $id = $request->input('input');
        $fetch = DB::select("SELECT * FROM permanent_time_options WHERE id='$id'");
        $saved_data[] = array();
        foreach ($fetch as $row) {
            $saved_data[0] = $row->monday;
            $saved_data[1] = $row->mon_from;
            $saved_data[2] = $row->mon_to;
            $saved_data[3] = $row->tuesday;
            $saved_data[4] = $row->tue_from;
            $saved_data[5] = $row->tue_to;
            $saved_data[6] = $row->wednesday;
            $saved_data[7] = $row->wed_from;
            $saved_data[8] = $row->wed_to;
            $saved_data[9] = $row->thursday;
            $saved_data[10] = $row->thu_from;
            $saved_data[11] = $row->thu_to;
            $saved_data[12] = $row->friday;
            $saved_data[13] = $row->fri_from;
            $saved_data[14] = $row->fri_to;
            $saved_data[15] = $row->saturday;
            $saved_data[16] = $row->sat_from;
            $saved_data[17] = $row->sat_to;
            $saved_data[18] = $row->sunday;
            $saved_data[19] = $row->sun_from;
            $saved_data[20] = $row->sun_to;
            $saved_data[21] = $row->id;
        }
        return response()->json([
            'saved_data' => $saved_data,


        ]);
    
    }
    public function loadPermanentOptionsTimeline(Request $request)
    {
        $id = $request->input('id');
        $id_creator = Auth::id();
        $number = $request->input('number');
        $fetch = DB::select("SELECT * FROM permanent_time_options_logs, users WHERE permanent_time_options_logs.id='$id' AND permanent_time_options_logs.made_by='$id_creator' AND permanent_time_options_logs.made_by=users.id  ORDER BY permanent_time_options_logs.timestamp_at DESC; ");
        echo "<ul class='sessions px-0'>";
        $counter = 0;
        foreach ($fetch as $result) {
            if ($counter == $number) {
                break;
            }
            echo '<li>';
            echo '<div class="time">' . $result->timestamp_at . '</div>';
            echo '<p class="mr-2" style="display:inline">Edited by: ' . $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name . '&nbsp;&nbsp;</p>';
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
            echo '<img id="imagePersoanl" src="' . $imageUrl . '" alt="editor profile" class="rounded-circle object-fit-cover ml-2" style="height: 25px; width: 25px;display:inline">';
            echo '</li>';
            $counter++;
        }
        echo "</ul>";
        if ($counter >= $number) {
            echo "<center><button onclick='loadTimeline(5)' class='btn btn-outline-secondary' >Load more&nbsp;<i class='bi bi-arrow-down'></i></button></center>";
        }

    }
    public function loadTimeOptions(Request $request)
    {
        $saved_data = array();
        $shift_month = array();

        $date = $request->input('date');
        $id_user = Auth::id();

        $dt = "";

        $A = 1;
        $d = "";




        for ($i = 1; $i < 32; $i++) {
            if ($i < 10) {
                $dt = "0" . $i;
            } else {
                $dt = $i;
            }


            $t = "-";


            $d = $date . "-" . $dt;

            $sql_get = DB::select(" SELECT COUNT(*) as count FROM time_options WHERE id='$id_user' AND saved_at='$d' ");
            $RR = " SELECT COUNT(*) as count FROM time_options WHERE id='$id_user' AND saved_at='$d' ";
            if ($sql_get[0]->count == 0) {
                $saved_data[$i - 1] = "empty";
            } else {
                $fetch = DB::select(" SELECT * FROM time_options WHERE id='$id_user' AND saved_at='$d' ");
                foreach ($fetch as $result) {

                    $saved_data[$i - 1] = $result->opt_from . "//" . $result->opt_to;

                }

            }
            $month_shift = DB::select("SELECT * FROM shift_active_data WHERE shift_active_data.saved_at='$d' AND shift_active_data.id='$id_user' ");
            $counter = 0;

            foreach ($month_shift as $result_shift) {
                array_push($shift_month, $result_shift->saved_at);
            }


        }
        return response()->json([
            'saved_data' => $saved_data,
            'shifts' => $shift_month,
            'response' => $RR,

        ]);
    }
    public function insertTimeOptions(Request $request)
    {
        $fromArr = $request->input('from');
        $toArr = $request->input('to');
        $dateArr = $request->input('date');
        $id_user = Auth::id();
        $YM = $request->input('dateym');
        $time = time();


        for ($x = 0; $x < count($fromArr); $x++) {
            if (($fromArr[$x] != "" && $toArr[$x] == "") || ($fromArr[$x] == "" && $toArr[$x] != "") || ($fromArr[$x] != "" && $toArr[$x] != "")) { /*not allowing empty values and the row which has been removed.*/
                if($fromArr[$x] == ""){
                    $fromArr[$x] = "00:00";
                }
                if($toArr[$x] == ""){
                    $toArr[$x] = "00:00";
                }

                $check_unique_row = DB::select("SELECT COUNT(*) AS count FROM time_options WHERE saved_at = '$dateArr[$x]' AND id='$id_user' ");
                if ($check_unique_row[0]->count == 0) {

                    DB::insert("INSERT INTO time_options (id, saved_at, opt_from, opt_to, timestamp_update)
VALUES
($id_user,'$dateArr[$x]','$fromArr[$x]','$toArr[$x]','$time')");


                } else {
  
                    DB::update("UPDATE time_options SET opt_from='$fromArr[$x]', opt_to='$toArr[$x]' ,timestamp_update='$time' WHERE saved_at='$dateArr[$x]' AND id='$id_user'");

                }
            }
        }
        $day = "";

        for ($x = 0; $x < count($fromArr); $x++) {
            for ($z = 1; $z < 32; $z++) {
                if ($z < 10) {
                    $day = "0" . $z;
                } else {
                    $day = $z;
                }
                $date = $YM . "-" . $day;
                $fetch_up_time = DB::select("SELECT * FROM time_options WHERE saved_at = '$date' AND id = $id_user");
                foreach ($fetch_up_time as $row) {
                    $last_up = $row->timestamp_update;
                    if ($last_up < $time) {
                        DB::delete("DELETE FROM time_options WHERE saved_at = '$date' AND id = $id_user");
                    }
                }
   
            }
        }
    }
}



?>