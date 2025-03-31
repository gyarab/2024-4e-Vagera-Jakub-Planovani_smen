<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\JsonResponse;


class ApiMyShiftsController extends Controller
{
    public function myShifts(Request $request)
    {
        $jsonArray = [];

        $object_id = [];
        $object_name = [];
        $icons = [];
        $search_object = [];
        $search_icon = [];

        $object_superior = [];
        $fetch_object = DB::select("SELECT * FROM object_model");

        foreach ($fetch_object as $result_object) {
            $object_id[] = $result_object->id_object;
            $object_name[] = $result_object->object_name;
            $object_superior[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
        }
        array_multisort($object_id, $object_name, $object_superior, $icons);

        $id = $request->object;
        $date = $request->date;
        $fetch = DB::select("SELECT *, users.id as main_id FROM users, shift_active_data, object_model, shift_model WHERE shift_active_data.saved_at='$date' AND shift_active_data.id_shift=shift_model.id_shift AND shift_active_data.id='$id' AND users.id=shift_active_data.id AND object_model.id_object=shift_model.id_object");

        foreach ($fetch as $result) {
            $fetch_img_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id='$result->main_id'");

            if ($fetch_img_count[0]->count > 0) {
                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id='$result->main_id'");
                $link_image = "";
                foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                }
                $imageUrl = Storage::url($link_image);
            } else {
                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            }

            for ($x = 0; $x < count($object_name); $x++) {
                if (0 == $object_superior[$x]) {
                    if ($result->id_object == $object_id[$x]) {
                        $search_object[0] = $object_name[$x];
                        $search_icon[0] = $icons[$x];
                        error_log($object_name[$x]);
                    }

                    for ($h = 0; $h < count($object_name); $h++) {
                        if ($object_id[$x] == $object_superior[$h]) {
                            $fg = $result->id_object;
                            $this->subObject($object_id[$x], $object_id, $object_name, $object_superior, $search_object, $search_icon, $fg, $object_name[$x], $icons[$x]);
                            break;
                        }
                    }
                }
            }

            array_push($jsonArray, [
                "id" => $result->id_active,
                "name" => $result->last_name . " " . $result->middle_name . " " . $result->first_name,
                "color" => $result->color,
                "shift" => $result->shift_name,
                "object" => $result->object_name,
                "icon" => $result->object_icon,
                "comment" => $result->comments,
                "from" => substr($result->saved_from, 0, -3),
                "to" => substr($result->saved_to, 0, -3),
                "image" => $imageUrl,
                "main_object" => $search_object[0] ?? null,
                "main_icon" => $search_icon[0] ?? null,
            ]);
        }

        return response()->json([
            "status" => "success",
            "data" => $jsonArray,
            "message" => "OK",
        ], 200);
    }

    public function subObject($searching, $obj_id, $obj_name, $obj_superior, array &$search_object, array &$search_icon, $search_id, $main_name, $main_icon)
    {
        for ($i = 0; $i < count($obj_name); $i++) {
            if ($searching == $obj_superior[$i]) {
                if ($obj_id[$i] != null) {
                    error_log($main_name);
                    if ($obj_id[$i] == $search_id) {
                        $search_object[0] = $main_name;
                        $search_icon[0] = $main_icon;
                        return; // Exit the function once the search_id is found
                    }
                    for ($h = 0; $h < count($obj_name); $h++) {
                        if ($obj_id[$i] == $obj_superior[$h]) {
                            $this->subObject($obj_id[$i], $obj_id, $obj_name, $obj_superior, $search_object, $search_icon, $search_id, $main_name, $main_icon);
                            break;
                        }
                    }
                }
            }
        }
    }
}


?>