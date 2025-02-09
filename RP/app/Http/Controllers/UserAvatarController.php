<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Date;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
class UserAvatarController extends Controller
{
    /**
     * Update the avatar for the user.
     */
    public function loadEditTimeline(Request $request)
    {
        $id = $request->input('id');
        $id_creator = Auth::id();
        $number = $request->input('number');
        $fetch = DB::select("SELECT * FROM edit_logs, users WHERE edit_logs.id='$id' AND edit_logs.made_by='$id_creator' AND edit_logs.made_by=users.id  ORDER BY edit_logs.timestamp_at DESC; ");
        echo "<ul class='sessions px-0'>";
        $counter = 0;
        foreach ($fetch as $result) {
            if( $counter == $number){
                break;
                 }
            echo '<li>';
            echo '<div class="time">'.$result->timestamp_at.'</div>';
            echo '<p class="mr-2" style="display:inline">Edited by: '.$result->first_name.' '.$result->middle_name.' '.$result->last_name.'&nbsp;&nbsp;</p>';
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
       echo '<img id="imagePersoanl" src="'.$imageUrl.'" alt="editor profile" class="rounded-circle object-fit-cover ml-2" style="height: 25px; width: 25px;display:inline">';
            echo '</li>';
            $counter++;
        }
        echo "</ul>";
        if( $counter >= $number){
            echo "<center><button onclick='loadTimeline(5)' class='btn btn-outline-secondary' >Load more&nbsp;<i class='bi bi-arrow-down'></i></button></center>";
        }
    }
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image in the 'public' disk (local storage)
        $imagePath = $request->file('image')->store('profile-images', 'public');
        $id = Auth::id();
        $counter = 0;
        $fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
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
            Storage::disk('public')->delete($link_image);
            DB::update("UPDATE profile_pictures SET image_link='$imagePath' WHERE id='$id' ");



        } else {
            DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");
        }
        //DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");
        // Optionally, you can return the path or URL of the uploaded file

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully!',
            'messages' => $link_image,
            'path' => asset('storage/' . $imagePath)
            //'path' => $imagePath
        ]);
    }
    public function showImagePersonal(Request $request)
    {
        $id = $request->input('id');
        $fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id'");
            $link_image = "";
            foreach ($fetch_link as $result) {
                $link_image = $result->image_link;
            }
            $imageUrl = Storage::url($link_image);
        } else {
            $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
        }
        // Generate the URL for the image using the public disk
        //$imageUrl = Storage::url($imagePath);

        // Return the image URL as a JSON response
        return response()->json(['url' => $imageUrl]);
    }

    public function showProfileImage(Request $request)
    {
        //$imagePath = $request->input('imageFilename'); // Assuming image path is sent via AJAX
        $id = Auth::id();
        $fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id'");
            $link_image = "";
            foreach ($fetch_link as $result) {
                $link_image = $result->image_link;
            }
            $imageUrl = Storage::url($link_image);
        } else {
            $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
        }
        // Generate the URL for the image using the public disk
        //$imageUrl = Storage::url($imagePath);

        // Return the image URL as a JSON response
        return response()->json(['url' => $imageUrl]);
    }
    public function showProfileImageChat(Request $request)
    {
        //$imagePath = $request->input('imageFilename'); // Assuming image path is sent via AJAX
        $id = $request->input('id');
        $fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id'");
            $link_image = "";
            foreach ($fetch_link as $result) {
                $link_image = $result->image_link;
            }
            $imageUrl = Storage::url($link_image);
        } else {
            $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
        }
        // Generate the URL for the image using the public disk
        //$imageUrl = Storage::url($imagePath);

        // Return the image URL as a JSON response
        return response()->json(['url' => $imageUrl]);
    }
    public function updateProfilePersonal(Request $request)
    {
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $phone_code = $request->input('phone_code');
        $phone_number = $request->input('phone_number');
        $role = $request->input('role');
        $status_active = $request->input('status');
        /*$bio = $request->input('bio');
        $new_password = $request->input('new_password');
        $repeat_password = $request->input('repeat_password');*/
        $email_valid = 0;
        $username_valid = 1;
        $password_valid = 1;
        $phone_valid = 0;
        $password_check_valid = 1;
        $id = $request->input('id');
        $id_creator = Auth::id();
        $yyy = "";
        $status = 0;


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_valid = 0;
        } else {
            $fetch_email = DB::select("SELECT COUNT(*) AS count FROM users WHERE email = '$email' AND id != '$id'");
            $supress_email = $fetch_email[0]->count;
            if ($supress_email > 0) {
                $email_valid = 0;
            } else {
                $email_valid = 1;

            }
        }
        if ($username != "") {
            $fetch = DB::select("SELECT COUNT(*) AS count FROM users WHERE username = '$username' AND id != '$id'");

            $supress = $fetch[0]->count;
            if ($supress > 0) {
                $username_valid = 0;
            } else {
                $username_valid = 1;
            }
        }
        if (is_numeric($phone_number) || $phone_number == "") {
            $phone_valid = 1;
        }
        if ($username_valid == 1 && $email_valid == 1 && $password_valid == 1 && $phone_valid == 1) {
            //DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', phone_code='$phone_code', phone_number='$phone_number',  updated_at = CURRENT_TIMESTAMP WHERE id='$id' ");
            if ($phone_number == "") {
                DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', phone_code='$phone_code', phone_number=NULL,  updated_at = CURRENT_TIMESTAMP, role='$role', status='$status_active' WHERE id='$id' ");
                $status = 1;
                DB::insert("INSERT INTO edit_logs (id, timestamp_at, made_by) VALUES ('$id', CURRENT_TIMESTAMP, '$id_creator')");

            } else {
                DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', phone_code='$phone_code', phone_number='$phone_number',  updated_at = CURRENT_TIMESTAMP, role='$role', status='$status_active' WHERE id='$id' ");
                $status = 1;
                DB::insert("INSERT INTO edit_logs (id, timestamp_at, made_by) VALUES ('$id', CURRENT_TIMESTAMP, '$id_creator')");

            }
        }
        return response()->json([
            'email' => $email_valid,
            'username' => $username_valid,
            'password' => $password_valid,
            'phone' => $phone_valid,
            'status' => $status,
            'yyy' => $yyy,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $bio = $request->input('bio');
        $new_password = $request->input('new_password');
        $repeat_password = $request->input('repeat_password');
        $email_valid = 0;
        $username_valid = 1;
        $password_valid = 1;
        $password_check_valid = 1;
        $id = Auth::id();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_valid = 0;
        } else {
            $fetch_email = DB::select("SELECT COUNT(*) AS count FROM users WHERE email = '$email' AND id != '$id'");
            $supress_email = $fetch_email[0]->count;
            if ($supress_email > 0) {
                $email_valid = 0;
            } else {
                $email_valid = 1;

            }
        }
        if ($username != "") {
            $fetch = DB::select("SELECT COUNT(*) AS count FROM users WHERE username = '$username' AND id != '$id'");

            $supress = $fetch[0]->count;
            if ($supress > 0) {
                $username_valid = 0;
            } else {
                $username_valid = 1;
            }
        }
        if ($new_password != $repeat_password) {
            $password_valid = 0;

        } else {

            $password_valid = 1;
            if ((strlen($new_password) != 0 && strlen($repeat_password) != 0)) {
                if (!preg_match("/[a-z]/i", $new_password)) {
                    $password_valid = 2;
                }


                if (!preg_match("/[0-9]/", $new_password)) {
                    $password_valid = 3;
                }

                if (!preg_match("/[A-Z]/", $new_password)) {
                    $password_valid = 4;
                }
                if (strlen($new_password) < 7) {
                    $password_valid = 5;

                }
            }

        }






        if ($username_valid == 1 && $email_valid == 1 && $password_valid == 1) {
            $time_stamp = time();
            if ((strlen($new_password) == 0 && strlen($repeat_password) == 0)) {
                DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', bio='$bio',  updated_at = CURRENT_TIMESTAMP WHERE id='$id' ");

            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', bio='$bio', password='$password_hash',  updated_at = CURRENT_TIMESTAMP WHERE id='$id' ");

                //DB::update("UPDATE users SET first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' , email='$email' , username='$username', bio='$bio',  updated_at = CURRENT_TIMESTAMP WHERE id='$id' ");
            }
        }
        return response()->json([
            'email' => $email_valid,
            'username' => $username_valid,
            'password' => $password_valid
        ]);

        //DB::insert("INSERT INTO users (image_link)  WHERE id='$id' ");

    }




}
?>