<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class DeviceController extends Controller{
public function registerDevice(Request $request)
{
    $deviceToken = Str::random(60); // Generate a unique API token
    $name = $request->input('description');
    $icon = $request->input('icon');
    $id = Auth::id();
    /*$device = Device::create([
        'name' => $request->input('name', 'Unnamed Device'),
        'device_token' => $deviceToken,
        'user_agent' => $request->header('User-Agent'),
        'ip_address' => $request->ip(),
    ]);*/
   // $response = setSecureCookie($deviceToken);

    $deviceFingerprint = hash('sha256', $request->userAgent() . $request->ip());

    $data = [
        'device_id' => $deviceToken,
        'fingerprint' => $deviceFingerprint,
    ];

    $encryptedCookie = cookie(
        'secure_device',
        encrypt($data), 
        60 * 24 * 365,
        null,
        null,
        true,
        true,
        false,
        'strict'
    );
    $userAgent =  $request->userAgent();
    $ip = $request->ip();
    $status = 1;
 
    //DB::insert("INSERT INTO devices (description_name, device_token, user_agent, ip_address, icon, created_at, creadted_by) VALUES ('$name ','$deviceToken', '$request->userAgent()', '$request->ip()', '$icon', CURRENT_TIMESTAMP, '$id') ");
//DB::insert("INSERT INTO devices (description_name, device_token, user_agent, ip_address, icon, created_at, created_by) VALUES ('$name','$deviceToken', '$userAgent ', '$ip', '$icon', CURRENT_TIMESTAMP, '$id') ");
$encryptedCookieCheck = $request->cookie('secure_device');

    if (!$encryptedCookieCheck) {
        DB::insert("INSERT INTO devices (description_name, device_token, user_agent, ip_address, icon, created_at, created_by, status) VALUES ('$name','$deviceToken', '$userAgent ', '$ip', '$icon', CURRENT_TIMESTAMP, '$id', '$status') ");

        return response()->json(['status' => "Created succefully "])->cookie($encryptedCookie);
    }else{
        $data_check = decrypt($encryptedCookieCheck); // Dešifrujeme cookie
        $currentFingerprint = hash('sha256', $request->userAgent() . $request->ip());
        $device_token = $data_check['device_id'];
        if ($data_check['fingerprint'] == $currentFingerprint) {
          $fetch = DB::select("SELECT * FROM devices WHERE device_token='$device_token' ");
          foreach($fetch as $result){
            DB::update("UPDATE devices set device_token='$deviceToken' , description_name='$name', icon='$icon', updated_at=CURRENT_TIMESTAMP WHERE device_token='$device_token' ");
           // return response()->json(['device_token' => "SELECT * FROM devices WHERE id_device='$device_id"]);
           return response()->json(['status' => "Updated succefully"])->cookie($encryptedCookie);


          }
          //return response()->json(['device_token' => $device_id ]);

          //return response()->json(['device_token' => $device_id ]);

            //return response('Cookie fingerprint does not match. Possible tampering detected.', 403);
       }
       // return response()->json(['device_token' => "SELECT * FROM devices WHERE id_device='$device_id'"]);

    }
    
}
public function validateSecureCookie(Request $request)
{
    $encryptedCookie = $request->cookie('secure_device');

    if (!$encryptedCookie) {
        return response('Cookie not found.', 404);
    }

    $data = decrypt($encryptedCookie); // Dešifrujeme cookie
    $currentFingerprint = hash('sha256', $request->userAgent() . $request->ip());

    if ($data['fingerprint'] !== $currentFingerprint) {
        return response('Cookie fingerprint does not match. Possible tampering detected.', 403);
    }
   // DB::select("SELECT * FROM ")

    return response()->json([ 'status' => 'Success']);
}

public function loadDevices(){
    $fetch = DB::select("SELECT * FROM devices ");
    foreach($fetch as $result){
    echo "<div class='row'>";
    echo "<div class='col-md-2' style='display: flex; justify-content: center; align-items: center;'>";
    if ($result->icon == "btnComputer"){
        echo "<p style='font-size: 25px;' ><i class='bi bi-pc-display'></i></p>";

    } else if($result->icon == "btnLaptop"){
        echo "<p style='font-size: 25px;'><i class='bi bi-laptop'></i></p>";

    }else{
        echo "<p style='font-size: 25px;'><i class='bi bi-phone'></i></p>";

    }
    echo "</div>";
    echo "<div class='col-md-6 d-flex align-items-center'>";
    echo "<p class='mt-2' style='text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>$result->description_name</p>";
    echo "</div>";
    echo "<div class='col-md-4'>";
    echo "<div class='row'>";
    echo "<div class='col-md-6'>";
    echo "<div style='display: flex; justify-content: start; align-items: start;'>";
    if($result->status == 1){
    echo '<i class="bi bi-check2-circle text-success fs-3"></i><p></p>';
    }else{
        echo '<i class="bi bi-dash-circle text-warning fs-3"></i><p></p>';

    }
    echo "</div>";
    echo "</div>";
    echo "<div class='col-md-6'>";
    echo "<div style='display: flex; justify-content: end; align-items: end;'>";
    $hash_id = Crypt::encrypt($result->id_device);
    if($result->status == 1){
    echo "<button class='btn btn-primary btn-sm mt-2' onclick='changeDeviceStatusSuspend(this.value)' value='$hash_id'>Supspend</button>";
    }else{
        echo "<button class='btn btn-primary btn-sm mt-2' onclick='changeDeviceStatusActive(this.value)' value='$hash_id'>Activate</button>";

    }
    echo "</div>";
    echo "</div>";

    echo "</div>";

    echo "</div>";

    echo "</div>";

    }
}
public function changeDeviceStatusActive(Request $request){
    $device = Crypt::decrypt($request->id_device);
    DB::update("UPDATE devices SET status='1' WHERE id_device='$device' ");

}
public function changeDeviceStatusSuspend(Request $request){
    $device = Crypt::decrypt($request->id_device);
    DB::update("UPDATE devices SET status='0' WHERE id_device='$device' ");
}

}
function setSecureCookie($deviceToken)
{
    $secureCookie = cookie(
        'secure_device', // Název cookie
        $deviceToken,           // Hodnota cookie
        60 * 24 * 365 * 3,   // Platnost cookie v minutách (1 rok)
        null,            // Cesta (necháme výchozí "/")
        null,            // Doména (necháme výchozí)
        true,            // Secure - cookie je dostupná jen přes HTTPS
        true,            // HttpOnly - cookie není přístupná přes JavaScript
        false,           // Raw
        'strict'        
    );
    return response('1')->cookie($secureCookie);
   // return response('Secure cookie has been set.')->cookie($secureCookie);
}
/*function setSecureCookieWithFingerprint(Request $request)
{
    $deviceFingerprint = hash('sha256', $request->userAgent() . $request->ip());

    $data = [
        'device_id' => 'unique_device_id_12345',
        'fingerprint' => $deviceFingerprint,
    ];

    $encryptedCookie = cookie(
        'secure_device',
        encrypt($data), // Šifrujeme data
        60 * 24 * 365,
        null,
        null,
        true,
        true,
        false,
        'strict'
    );

    return response('Secure cookie with fingerprint has been set.')->cookie($encryptedCookie);
}*/
?>