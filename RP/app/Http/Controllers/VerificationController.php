<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


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
            //$status = $result->email_verified_at;

            if( $result->email_verified_at == null){
                $fetch_codes = DB::select("SELECT * FROM verification_codes WHERE  id='$id' ");
                foreach ($fetch_codes as $result_codes) {  
                    $code = $result_codes->verification_code;
                }
                $status = false;

            }
        }

        //$id = $request->input('id');
        return response()->json([
            'verification_code' => $code,
            'status' => $status

            //'path' => $imagePath
        ]);
    }
    public function verificationNew(Request $request)
    {
        $verification_code = generateRandomString();
        $id = $request->input('id');
        $details = [
            'title' => 'Hello from Laravel!',
            'body' => 'This is a test email sent using Mailtrap.',
            'verify' => $verification_code
        ];
       DB::update("UPDATE verification_codes SET verification_code = '$verification_code' WHERE id='$id' ");
       //echo ("UPDATE verification_codes SET verification_code = '$verification_code' WHERE id='$id' ");
        /*$fetch_email = DB::select("SELECT email FROM users WHERE id='$id'");
        $email = '';
        foreach ($fetch_email as $result) {  
            $email = $result->email;
        }

        Mail::to( $email)->send(new VerificationEmail($details));*/
        //
        
        //Mail::to('vageja5zs@gmail.com')->send(new VerificationEmail($details));
    }
        public function verifyUser(Request $request)
    {
        $id = $request->input('id');

        DB::update("UPDATE users SET email_verified_at = CURRENT_TIMESTAMP WHERE id='$id' ");
        DB::delete("DELETE FROM verification_codes WHERE id='$id' ");

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


?>