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
class AuthManager extends Controller
{
    function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validate->faills()) {
            return response()->json(["status" => "error", "message" => $validate->errors()], 200);
        }
        $validated = $validate->validated();

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        if ($user->save()) {
            return response()->json(["status" => "success", "message" => "Success register"], 200);
        }
        return response()->json(["status" => "error", "message" => "Unknown Error Validation"], 200);
    }
    function login_mobile(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);


        if (($request->email != "" && $request->email != NULL) || ($request->password != "" && $request->password != NULL)) {
            $fetch = DB::select("SELECT password, id FROM users WHERE (username='$request->email' OR email='$request->email') ");
            $fetch_counter = DB::select("SELECT COUNT(*) FROM users WHERE (username='$request->email' OR email='$request->email') ");
            foreach($fetch as $result){
                $user = User::find($result->id);
                $fetch_count = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = $user->id");
                if ($fetch_count[0]->count > 0) {
                  $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = $user->id");
                  $link_image = "";
                  foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                  }
                  $imageUrl = Storage::url($link_image);
                } else {
                  $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
                }
                
                if(Hash::check($request->password, $user->password)){
                    $token = $user->createToken("mobile_token");
                    return response()->json(
                        [
                            "status" => "success",
                            "data" => [
                                'user' => [
                                    'id' => $user->id,
                                    'username' => $user->username,
                                    'email' => $user->email,
                                    'role' => $user->role,
                                    'firstname' => $user->first_name,
                                    'middlename' => $user->middle_name,
                                    'lastname' => $user->last_name,
                                    'profile_url' => $imageUrl,

                                ],
                                'token' => $token
                            ],
                            "message" => "Successfull verification"
                        ],
                        200
                    );     
                }

           }
          
            return response()->json(
                [
                    "status" => "success",
                    "message" => "User not found"
                ],
                400
            );
        } else {
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Validation failled"
                ],
                400
            );
        }

    }
}
?>