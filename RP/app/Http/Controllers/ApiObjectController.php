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
//use Ramsey\Uuid\Rfc4122\Validator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\JsonResponse;
class ApiObjectController extends Controller
{
    public function sideObjects(Request $request): JsonResponse{
        $input = $request->id;
        $date = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($date . ' - 1 days'));

        $data_name = array();
        $jsonArray = [];

        /**
         * 0 - neaktivni
         * 1 - wrong
         * 2 - warning
         * 3 - active  
         */
        $status = 0;
        $logFrom = "--:--";
        $logTo = "--:--";

        $finder = 0;


        $fetch_object = DB::select("SELECT * FROM object_model");
        $object_id = array();
        $object_name = array();
        $icons = array();
        $object_superior = array();
        $numberval = array();


        foreach ($fetch_object as $result_object) {
            $object_id[] = $result_object->id_object;
            $object_name[] = $result_object->object_name;
            $object_superior[] = $result_object->superior_object_id;
            $icons[] = $result_object->object_icon;
        }
        array_multisort($object_id, $object_name, $object_superior, $icons);

        for ($x = 0; $x < count($object_name); $x++) {
            if ($input == $object_id[$x]) {
                array_push($jsonArray, [
                    "id" => $object_id[$x],
                    "name" => $object_name[$x],
                    "icon" => $icons[$x],

                ]);  
                for ($h = 0; $h < count($object_name); $h++) {
                    if ($object_id[$x] == $object_superior[$h]) {
                        $this->subObject($object_id[$x], $object_id, $object_name, $object_superior, $icons, $jsonArray);
                        break;
                    }
                }
            }
        }


        return response()->json(
            [
                "status" => "success",  
                "data" => $jsonArray,
                "message" => "OK",
            ],
        200
        );

    }
    private function subObject($searching, $obj_id, $obj_name, $obj_superior, $icons,  array &$jsonArray)
    {


        for ($i = 0; $i < count($obj_name); $i++) {
            $shi_id = [];
            if ($searching == $obj_superior[$i]) {
                array_push($jsonArray, [
                    "id" => $obj_id[$i],
                    "name" => $obj_name[$i],
                    "icon" => $icons[$i],

                ]);       
                if ($obj_id[$i]  != null) {
                    for ($h = 0; $h < count($obj_name); $h++) {
                        if ($obj_id[$i]  == $obj_superior[$h]) {
                            $this->subObject($obj_id[$i] , $obj_id, $obj_name, $obj_superior, $icons, $jsonArray);
                            break;
                        }
                    }
                }


            }
        }


    }
}
?>