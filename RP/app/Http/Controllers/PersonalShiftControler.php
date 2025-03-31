<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class PersonalShiftControler extends Controller
{
   

 


    public function tomorrow_shift()
    {
        $id = Auth::id();
        $td = date('Y-m-d', strtotime("+1 days"));
        $today = DB::select("SELECT * FROM shift_active_data, shift_model, object_model WHERE shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND shift_model.id_shift = shift_active_data.id_shift AND shift_model.id_object = object_model.id_object ORDER BY shift_active_data.saved_from");

       return $today;
    }
    public function tomorrow_shift_next()
    {
        $id = Auth::id();
        $td = date('Y-m-d', strtotime("+2 days"));
        $today = DB::select("SELECT * FROM shift_active_data, shift_model, object_model WHERE shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND shift_model.id_shift = shift_active_data.id_shift AND shift_model.id_object = object_model.id_object ORDER BY shift_active_data.saved_from");

       return $today;
    }
    public function today_shift()
    {
        $id = Auth::id();
        $to = date('Y-m-d');
        $tommorow = DB::select("SELECT * FROM shift_active_data, shift_model, object_model WHERE shift_active_data.saved_at='$to' AND shift_active_data.id='$id' AND shift_model.id_shift = shift_active_data.id_shift AND shift_model.id_object = object_model.id_object ORDER BY shift_active_data.saved_from");

       return $tommorow;
    }
    function yesterday_shift()
    {
        
        $id = Auth::id();
        $y = date('Y-m-d', strtotime("-1 days"));
        $yesterday = DB::select("SELECT * FROM shift_active_data, shift_model, object_model WHERE shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND shift_model.id_shift = shift_active_data.id_shift AND shift_model.id_object = object_model.id_object ORDER BY shift_active_data.saved_from");

       return $yesterday;

    }
    function today_offer()
    {
        
        $id = Auth::id();
        $td = date('Y-m-d');
        
        $today_offer = DB::select("SELECT * FROM users, shift_active_data, shift_model, object_model, shift_assignment, shift_offer LEFT JOIN shift_request ON shift_request.id_offer=shift_offer.id_offer AND shift_request.id='$id' WHERE shift_assignment.id='$id' AND shift_offer.date='$td' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$td' AND users.id=shift_offer.created_by ");
       return $today_offer;

    }
    function tommorow_offer()
    {
        
        $id = Auth::id();
        $tm = date('Y-m-d', strtotime("+1 days"));
        
        $tommorow_offer = DB::select("SELECT * FROM users, shift_active_data, shift_model, object_model, shift_assignment, shift_offer LEFT JOIN shift_request ON shift_request.id_offer=shift_offer.id_offer AND shift_request.id='$id' WHERE shift_assignment.id='$id' AND shift_offer.date='$tm' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$tm' AND users.id=shift_offer.created_by LIMIT 1");
       return $tommorow_offer;

    }
    function tommorow_offer_next()
    {
        
        $id = Auth::id();
        $tm2 = date('Y-m-d', strtotime("+2 days"));
        
        $tommorow_offer2 = DB::select("SELECT * FROM users, shift_active_data, shift_model, object_model, shift_assignment, shift_offer LEFT JOIN shift_request ON shift_request.id_offer=shift_offer.id_offer AND shift_request.id='$id' WHERE shift_assignment.id='$id' AND shift_offer.date='$tm2' AND shift_offer.id_shift = shift_model.id_shift AND shift_offer.id_shift = shift_assignment.id_shift AND shift_model.id_object = object_model.id_object AND shift_active_data.id_shift=shift_offer.id_shift AND shift_active_data.saved_at=shift_offer.date AND shift_active_data.saved_at='$tm2' AND users.id=shift_offer.created_by LIMIT 1");
       return $tommorow_offer2;

    }

    public function number_planned1(){
        $id = Auth::id();
        $date = date('Y-m');
        $planned1 = DB::select("SELECT COUNT(*) FROM shift_active_data WHERE saved_at LIKE '$date%' AND id='$id' ");
     
        $supress = $planned1[0];
   
        return $supress;
    }
    public function number_planned2(){
        $id = Auth::id();
        $date = date('Y-m');
        $planned2 = DB::select("SELECT COUNT(*) FROM attendance WHERE attendance.saved_at LIKE '$date%' AND attendance.id='$id' ");
        $supress = $planned2[0];

        return $supress;
    }
    function number_worked(){
        $id = Auth::id();
        $date = date('Y-m');
        $worked = DB::select("SELECT COUNT(*) FROM attendance WHERE attendance.saved_at LIKE '$date%' AND attendance.id='$id' ");
 
        $supress = $worked[0];
        return  $supress;
    }
}

?>