<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use DB;

class UserController extends Controller{
    /*function user_data(Request $request){
        $data = new User;

        $data->first_name = $request->input("first_name");
        $data->middle_name = $request->input("middle_name");
        $data->last_name = $request->input("last_name");
        $data->role = $request->input("role");
        $data->email = $request->input("email");
        $data->password = $request->input("password");
        $data->id = $request->input("id");
        $data->save();

        return back();
    }*/
    /**
     * https://bbbootstrap.com/snippets/bootstrap-5-search-bar-microphone-icon-inside-12725910#
     * https://www.bootdey.com/snippets/view/dashboard-border-cards#html
    *  https://jsfiddle.net/espriella/kvs0dqny/ 
     */
    public function index()
    {
        $users = DB::select('SELECT * FROM users');
        return view('admin.dttest',['users'=>$users]);
    }
    public function ajaxStore(Request $request)
    {
        // Validate the incoming data
       /* $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);*/

        // You can now use the validated data, e.g., save to database
        // User::create($validated);

        // Return a JSON response
        return response()->json(['message' => 'User data submitted successfully!']);
    }
}

?>