<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function session_id(){
        $id = Auth::id();
 
        return $id;
        //return view('admin.dashboard2',['id'=>$id]);
    }
    public function session_parameters(){
        $id = Auth::id();
        $parametrs = DB::select("SELECT * FROM users WHERE id='$id'");
 
        return $parametrs;
        //return view('admin.dashboard2',['id'=>$id]);
      
    }
    public function parameters(){
        $id = Auth::id();
        $parameters = DB::select("SELECT * FROM users WHERE id='$id'");
        foreach ($parameters as $result) {
            $first_name = $result->first_name;
            $middle_name = $result->middle_name;
            $last_name = $result->last_name;
        }
        return response()->json([
            'id' => $id,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
        ]);
        //return view('admin.dashboard2',['id'=>$id]);
      
    }
    public function insertUser(Request $request){
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $bio = $request->input('bio');
        $new_password = $request->input('new_password');
        $repeat_password = $request->input('repeat_password');
        $phone_code = $request->input('phone_code');
        $phone_number = $request->input('phone_number');
        $role = $request->input('role');
        $email_valid = 0;
        $username_valid = 1;
        $password_valid = 1;
        $phone_valid = 0;
        $password_check_valid = 1;
        $status =0;
        $id_return = 0;
        $ttt =0;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_valid = 0;
        } else {
            $fetch_email = DB::select("SELECT COUNT(*) AS count FROM users WHERE email = '$email'");
            $supress_email = $fetch_email[0]->count;
            if ($supress_email > 0) {
                $email_valid = 0;
            }else{
                $email_valid = 1;

            }
        }
        if ($username != "") {
            $fetch = DB::select("SELECT COUNT(*) AS count FROM users WHERE username = '$username' ");
        
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $username_valid = 0;
        }else{
            $username_valid = 1;
    }
}
    if (is_numeric($phone_number) || $phone_number == "") {
        $phone_valid = 1;
    }

    if ($new_password != $repeat_password  ) {
        $password_valid = 0;

    }else{

        $password_valid = 1;
        if (!preg_match("/[a-z]/i", $new_password)) {
            $password_valid = 2;
        }
    
    
        if (!preg_match("/[0-9]/", $new_password)) {
            $password_valid = 3;
        }
    
        if (!preg_match("/[A-Z]/", $new_password)) {
            $password_valid = 4;
        }
        if (strlen($new_password) < 7 ) {
            $password_valid = 5;

        }
    
        
    }
    $verification_code = generateRandomString();
    $details = [
        'name' => $first_name. " ". $middle_name. " ". $last_name,
        'body' => '',
        'verify' => $verification_code
    ];

    //
 
    
    if( $username_valid == 1 && $email_valid == 1 && $password_valid == 1 && $password_valid == 1){
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        if($phone_number == ""){
            DB::insert("INSERT INTO users (first_name, middle_name, last_name, username, email, password, created_at, role, bio, status, phone_code, phone_number ) VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$email', '$password_hash', CURRENT_TIMESTAMP, '$role', '$bio', 1 , '$phone_code', NULL)");
            $status =1;
            Mail::to($email)->send(new VerificationEmail($details));
        }else{
              DB::insert("INSERT INTO users (first_name, middle_name, last_name, username, email, password, created_at, role, bio, status, phone_code, phone_number ) VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$email', '$password_hash', CURRENT_TIMESTAMP, '$role', '$bio', 1 , '$phone_code', '$phone_number')");
              $status =1;
              Mail::to($email)->send(new VerificationEmail($details));
            }

        //DB::insert("INSERT INTO users (first_name, middle_name, last_name, username, email, password, created_at, role, bio, status, phone_code, phone_number ) VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$email', '$password_hash', '$role', '$bio', 1 , '$phone_code', '$phone_number')");
    //DB::insert("INSERT INTO object_model (object_name, superior_object_id) VALUES ('$name',0)");
    $fetch = DB::select("SELECT id FROM users WHERE email='$email' ");
    foreach ($fetch as $result) {
        $id_return = $result->id;
    }
    $id_create = Auth::id();
    DB::insert("INSERT INTO verification_codes (id, verification_code, created_at, updated_at, created_by) VALUES ('$id_return', '$verification_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$id_create') ");
    }
    return response()->json([
        'email' => $email_valid,
        'username' => $username_valid,
        'password' => $password_valid,
        'phone' => $phone_valid,
        'status' => $status,
        'id_return' => $id_return,
        'rrr' => $ttt,
    ]);
        
    }
    public function storeImageInsert(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image in the 'public' disk (local storage)
        $imagePath = $request->file('image')->store('profile-images', 'public');
        $id = $request->input('id');
        $counter = 0;
        DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");

        /*$fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id'");
            $link_image = "";
            foreach ($fetch_link as $result) {
                $link_image = $result->image_link;
            }
            //$link_image = Str::substr($link_image, 14);
            /*$fullPath = Storage::path($link_image);
            Storage::delete(asset('/storage/' .$link_image));
           Storage::delete($fullPath);*/
         /*   Storage::disk('public')->delete($link_image);
            DB::update("UPDATE profile_pictures SET image_link='$imagePath' WHERE id='$id' ");



        } else {
            DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");
        }*/
        //DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");
        // Optionally, you can return the path or URL of the uploaded file

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully!',
            'path' => asset('storage/' . $imagePath),
            't' =>  $id,
            //'path' => $imagePath
        ]);
    }
   
}
function generateRandomString($length = 6) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}