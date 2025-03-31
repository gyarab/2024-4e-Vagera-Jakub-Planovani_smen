<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller{

public function sendEmail()
{
    /**
     * Testovani posilani souboru
     */
    $verification_code = generateRandomStringE();
    $details = [
        'title' => 'Hello from Laravel!',
        'body' => 'This is a test email sent using Mailtrap.',
        'verify' => $verification_code
    ];

    
    Mail::to('vageja5zs@gmail.com')->send(mailable: new VerificationEmail($details));

}


}
function generateRandomStringE($length = 6) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
?>