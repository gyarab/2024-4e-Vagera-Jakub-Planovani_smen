<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class VerificationController extends Controller
{

    public function verification_action(Request $request)
    {
        $code = $request->input('code');
        $fetch = DB::select("SELECT COUNT(*) AS count FROM verification_codes WHERE verification_code = '$code'");
        $counter = $fetch[0]->count;
        if ($counter == 1) {
            $fetch_id = DB::select("SELECT id FROM verification_codes WHERE verification_code = '$code'");
            $id_user = 0;
            foreach ($fetch_id as $result) {
                $id_user = $result->id;
            }
            DB::update("UPDATE users SET email_verified_at = CURRENT_TIMESTAMP WHERE id='$id_user' ");
            DB::delete("DELETE FROM verification_codes WHERE id='$id_user' AND verification_code = '$code' ");
            return "success";
        } else {
            return "error";
        }
    }
    public function verificationLoad(Request $request)
    {
        $id = $request->input('id');
        $fetch = DB::select("SELECT email_verified_at FROM users WHERE  id='$id' ");
        $code = "";
        $status = true;
        foreach ($fetch as $result) {

            if ($result->email_verified_at == null) {
                $fetch_codes = DB::select("SELECT * FROM verification_codes WHERE  id='$id' ");
                foreach ($fetch_codes as $result_codes) {
                    $code = $result_codes->verification_code;
                }
                $status = false;

            }
        }

        return response()->json([
            'verification_code' => $code,
            'status' => $status

        ]);
    }
    public function verificationNew(Request $request)
    {
        $verification_code = generateRandomStringV();
        $id_client = $request->input('id');
        $id_creator = Auth::id();

        $success = 0;
        $fetch_existence = DB::select("SELECT COUNT(*) AS count FROM verification_codes WHERE id='$id_client' ");
        if ($fetch_existence[0]->count == 0) {
            $fetch_users = DB::select("SELECT COUNT(*) AS count FROM users WHERE id='$id_client' AND email_verified_at IS NULL ");
            if ($fetch_users[0]->count > 0) {
                DB::insert("INSERT INTO verification_codes (id, verification_code, created_at, updated_at, created_by) VALUES ('$id_client', '$verification_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$id_creator') ");
                $success = 1;
            }

        } else {
            DB::update("UPDATE verification_codes SET verification_code = '$verification_code' WHERE id='$id_client' ");
            $success = 1;
        }
 
        if ($success == 1) {
            $fetch_email = DB::select("SELECT * FROM users WHERE id='$id_client' ");
            $email = "";

            foreach ($fetch_email as $result) {
                $details = [
                    'name' => $result->first_name . " " . $result->middle_name . " " . $result->last_name,
                    'body' => '',
                    'verify' => $verification_code
                ];
                $email = $result->email;
                Mail::to($email)->send(new VerificationEmail($details));


            }

        }

    }
    public function verifyUser(Request $request)
    {
        $id = $request->input('id');

        DB::update("UPDATE users SET email_verified_at = CURRENT_TIMESTAMP WHERE id='$id' ");
        DB::delete("DELETE FROM verification_codes WHERE id='$id' ");

    }
}
function generateRandomStringV($length = 6)
{

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}


?>