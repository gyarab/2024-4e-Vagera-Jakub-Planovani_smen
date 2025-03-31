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
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\JsonResponse;


class ApiBoardController extends Controller
{
    public function boardLoader(Request $request):JsonResponse
    {
        $role = $request->id;
        $jsonArray = [];
        if($role == "admin"){
            $board = DB::select("SELECT users.first_name, users.middle_name, users.last_name, board.content, board.caption, board.color AS board_color, id_board, board.created_at AS board_creation, board.image_link AS board_link, users.id AS user_id FROM board, users, profile_pictures WHERE users.id=board.created_by AND profile_pictures.id=board.created_by ");

        }else if($role == "manager"){
            $board = DB::select("SELECT users.first_name, users.middle_name, users.last_name, board.content, board.caption, board.color AS board_color, id_board, board.created_at AS board_creation, board.image_link AS board_link, users.id AS user_id FROM board, users, profile_pictures WHERE users.id=board.created_by AND profile_pictures.id=board.created_by AND board.management=1 ");

        }else if($role == "fulltime"){
            $board = DB::select("SELECT users.first_name, users.middle_name, users.last_name, board.content, board.caption, board.color AS board_color, id_board, board.created_at AS board_creation, board.image_link AS board_link, users.id AS user_id FROM board, users, profile_pictures WHERE users.id=board.created_by AND profile_pictures.id=board.created_by AND board.employee_full=1 ");

        }else if($role == "parttime"){
            $board = DB::select("SELECT users.first_name, users.middle_name, users.last_name, board.content, board.caption, board.color AS board_color, id_board, board.created_at AS board_creation, board.image_link AS board_link, users.id AS user_id FROM board, users, profile_pictures WHERE users.id=board.created_by AND profile_pictures.id=board.created_by AND board.employee_part=1 ");

        }

        foreach ($board as $result) {
            $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $result->user_id");
            if ($fetch_count[0]->count > 0) {
                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $result->user_id");
                $link_image = "";
                foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                }
                $imageUrl = Storage::url($link_image);
            } else {
                $imageUrl = Storage::url('/profile-images/avatar_blank2.jpg');
            }
            if ($result->board_link != null) {
                $boardUrl = Storage::url($result->board_link);
            } else {
                $boardUrl = '';
            }
            array_push($jsonArray, [
                "content" => $result->content,
                "caption" => $result->caption,
                "color" => $result->board_color,
                "id_board" => $result->id_board,
                "board_creation" => $result->board_creation,
                "board_link" => $boardUrl,
                "profile_link" => $imageUrl,
                "name" => $result->last_name . " ". $result->middle_name . " " .  $result->first_name,

            ]);  
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
}


?>