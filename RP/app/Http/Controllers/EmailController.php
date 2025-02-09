<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller{

public function sendEmail()
{
    /*$details = [
        'title' => 'Hello from Laravel!',
        'body' => 'This is a test email sent using Mailtrap.'
    ];*/
    $verification_code = generateRandomString();
    $details = [
        'title' => 'Hello from Laravel!',
        'body' => 'This is a test email sent using Mailtrap.',
        'verify' => $verification_code
    ];

    //
    $name ="das";
    
    Mail::to('vageja5zs@gmail.com')->send(new VerificationEmail($details));
    //return view('admin.email-verification');
    //return view('email-verification',['details'=>$details]);
    //return "Email sent successfully!";
}
/*function generateRandomString($length = 6) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}*/

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