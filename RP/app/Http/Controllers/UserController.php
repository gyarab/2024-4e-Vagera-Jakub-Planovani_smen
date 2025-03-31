<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use DB;

class UserController extends Controller{

    /**Sources: 
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

        // Return a JSON response
        return response()->json(['message' => 'User data submitted successfully!']);
    }
    
}

?>