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
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


class AttendanceController extends Controller
{
    public function endBreak(Request $request)
    {
        // $mysqli = require("../database.php");
//$conn = new mysqli($host, $username, $password, $dbname);
        $id = Auth::id();/**id uzivatele */
        $y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
        $currentTime = date('H:i:s');/** soucasny cas */
        $td = date('Y-m-d');/** soucasny den */

        $checkfrom = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */
        /** SQL prikaz na vyhledani vcerejsich smen */
        //$fetchy = DB::select("");
        $fetchy_count = DB::select("SELECT COUNT(*) as count FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$y' AND attendance.id='$id' ");
        $fetchy = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$y' AND attendance.id='$id' ");

        $fetchtd_count = DB::select("SELECT COUNT(*) AS count FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$td' AND attendance.id='$id' ");
        $fetchtd = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$td' AND attendance.id='$id' ");

        /*$sqly = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$y' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        $fetchy = mysqli_query($conn, $sqly);
        /** SQL prikaz na vyhledani dnesnich smen */
        /*$sqltd = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$td' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        $fetchtd = mysqli_query($conn, $sqltd);
        /**vcerejsi hledani */
        if ($fetchy_count[0]->count > 0) {
            $checkfrom = 1;
            foreach ($fetchy as $row_y) {
                $id_plan_y = $row_y->id_attendance;
                $fetch_from_y = DB::select("SELECT pause_to FROM attendance WHERE id_attendance = $id_plan_y ");
                foreach ($fetch_from_y as $row_y_from) {
                    $pause_to_y = $row_y_from->pause_to;
                }
            }
            /**pokud uzivatel uz mel pauzu uzivatel, program pripise novou pauzu a oddeli je znaky || */
            if ($pause_to_y != null) {
                DB::update("UPDATE attendance SET pause_to='$pause_to_y||$currentTime' WHERE id_attendance=$id_plan_y");

            } else {
                DB::update("UPDATE attendance SET pause_to='$currentTime' WHERE id_attendance=$id_plan_y");
            }
            /*if (!mysqli_query($conn, $sqly_insert)) {
                
            }*/


        }
        /**dnesni hledani */
        if ($checkfrom == 0) {
            if ($fetchtd_count[0]->count > 0) {
                foreach ($fetchtd as $row_td) {
                    $id_plan_td = $row_td->id_attendance;
                    $fetch_from_td = DB::select("SELECT pause_to FROM attendance WHERE id_attendance = $id_plan_td ");
                    foreach ($fetch_from_td as $row_td_from) {
                        $pause_to_td = $row_td_from->pause_to;
                    }
                }
                if ($pause_to_td != null) {
                    DB::update("UPDATE attendance SET pause_to= '$pause_to_td||$currentTime' WHERE id_attendance=$id_plan_td");
                    //echo json_encode($pause_to_td);

                } else {
                    DB::update("UPDATE attendance SET pause_to='$currentTime' WHERE id_attendance=$id_plan_td");
                    //echo json_encode( $pause_to_td);

                }
                /*if (!mysqli_query($conn, $sqltd_insert)) {
                    
                }*/


            }
        }
    }
    public function startBreak(Request $request)
    {
        //$mysqli = require("../database.php");
        //$conn = new mysqli($host, $username, $password, $dbname);
        $id = Auth::id();/**id uzivatele */
        $y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
        $currentTime = date('H:i:s');/** soucasny cas */
        $td = date('Y-m-d');/** soucasny den */






        $checkfrom = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */
        /** SQL prikaz na vyhledani vcerejsich smen */
        //$fetchy = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND IN (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND shift_active_data.saved_at=attendace.saved_at AND attendace.id='$id' AND shift_active_data.id_shift=attendace.id_shift ))");
        $fetchy_count = DB::select("SELECT COUNT(*) as count FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$y' AND attendance.id='$id' ");
        $fetchy = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$y' AND attendance.id='$id' ");

        //$sqly = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$y' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        // $fetchy = mysqli_query($conn, $sqly);
        /** SQL prikaz na vyhledani dnesnich smen */
        /*$sqltd = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$td' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        $fetchtd = mysqli_query($conn, $sqltd);*/
        $fetchtd_count = DB::select("SELECT COUNT(*) AS count FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$td' AND attendance.id='$id' ");

        $fetchtd = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.saved_at='$td' AND attendance.id='$id' ");

        /**vcerejsi hledani */
        if ($fetchy_count[0]->count > 0) {
            $checkfrom = 1;
            foreach ($fetchy as $row_y) {
                $id_plan_y = $row_y->id_attendance;
                $fetch_from_y = DB::select("SELECT pause_from FROM attendance WHERE id_attendance = $id_plan_y ");
                /*while ($row_y_from = mysqli_fetch_assoc($fetch_from_y)) {
                    $pause_from_y = $row_y_from['pause_from'];
                }*/
                foreach ($fetch_from_y as $row_y_from) {
                    $pause_from_y = $row_y_from->pause_from;
                }
            }
            /**pokud uzivatel uz mel pauzu uzivatel, program pripise novou pauzu a oddeli je znaky || */
            if ($pause_from_y != null) {
                DB::update("UPDATE attendance SET pause_from='$pause_from_y||$currentTime' WHERE id_attendance=$id_plan_y");

            } else {
                DB::update("UPDATE attendance SET pause_from='$currentTime' WHERE id_attendance=$id_plan_y");
            }
            /*if (!mysqli_query($conn, $sqly_insert)) {
                
            }*/


        }
        /**dnesni hledani */
        if ($checkfrom == 0) {

            if ($fetchtd_count[0]->count > 0) {
                echo "sdsda";
                foreach ($fetchtd as $row_td) {
                    // while ($row_td = mysqli_fetch_assoc($fetchtd)) {
                    $id_plan_td = $row_td->id_attendance;
                    //$fetch_from_td = mysqli_query($conn, "SELECT pause_from FROM attendance WHERE planned_id = $id_plan_td ");
                    $fetch_from_td = DB::select("SELECT pause_from FROM attendance WHERE id_attendance = $id_plan_td ");
                    /*while ($row_td_from = mysqli_fetch_assoc($fetch_from_td)) {
                        $pause_from_td = $row_td_from['pause_from'];
                    }*/
                    foreach ($fetch_from_td as $row_td_from) {
                        $pause_from_td = $row_td_from->pause_from;
                    }
                }
                if ($pause_from_td != null) {
                    DB::update("UPDATE attendance SET pause_from= '$pause_from_td||$currentTime' WHERE id_attendance=$id_plan_td");
                    //echo json_encode($pause_from_td);

                } else {
                    DB::update("UPDATE attendance SET pause_from='$currentTime' WHERE id_attendance=$id_plan_td");
                    //echo json_encode( $pause_from_td);

                }
                /*if (!mysqli_query($conn, $sqltd_insert)) {
                    
                }*/


            }
        }
    }
    public function attendanceConditions(Request $request)
    {
        $have = 0;/** - promena, ktera udava zdali existuje smena do ktere se da pripojit (hodnota je 1) nebo ne (hodnota je 0) */
        $pause = 0;
        $pause_have = 0;
        $dd = 0;
        //$mysqli = require ("../database.php");
        //$conn = new mysqli($host, $username, $password, $dbname);
        $y = date('Y-m-d', strtotime("-1 days"));/**-zjisteni vcerejsiho dne */
        $td = date('Y-m-d');/**-zjisteni dnesniho dne */
        $tm = date('Y-m-d', strtotime("1 days"));/**-zjisteni zitrejsiho dne */
        $u = Auth::id();
        $sqly = "SELECT * FROM shift_active_data WHERE saved_date='$y' AND id_user='$u' ORDER BY saved_from";/**-SQl dotaz - vybere vcerejsi smeny */
        $sqltd = "SELECT * FROM shift_active_data WHERE saved_date='$td' AND id_user='$u' ORDER BY saved_from ";/**-SQl dotaz - vybere dnesni smeny */
        $sqltm = "SELECT * FROM shift_active_data WHERE saved_date='$tm' AND id_user='$u' ORDER BY saved_from "; /**-SQl dotaz - vybere zitrejsi smeny  */
        $sqlcl = "SELECT * FROM shift_active_data, create_shift WHERE id_user='$u' AND saved_date >= DATE('$td') AND create_shift.id_shift = shift_active_data.id_of_shift ORDER BY saved_from DESC "; /**-SQL dotaz - co vyhledava nejblizsi nasledujici smenu */
        /**-prikazy, ktere ziskavaji predchozi vysledky z SQL dotazu  */
        /* $fetchy = mysqli_query($conn, $sqly);
         $fetchtd = mysqli_query($conn, $sqltd);
         $fetchtm = mysqli_query($conn, $sqltm);
         $fetchcl = mysqli_query($conn, $sqlcl);*/
        $checkfrom = 0;/**promena, podle ktere se nacita tlacitko budto na prihlaseni do smeny (promena je 0) nebo na odhlaseni ze smeny (promena je 1) */
        /** - SQL dotaz, ktery vyhledava vcerejsi smeny u kterych se uzivatel nezaregistroval a nebo se jeste neodlasil */
        //return "SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y')) OR (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y') ";

        $fetchfryy = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y')) OR (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y')) ");

        $fetchypf = DB::select(" SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND shift_active_data.id IN (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL ))");
        $fetchtdpf = DB::select(" SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND shift_active_data.id IN (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL ))");

        /** - SQL dotaz, ktery vyhledava dnesni smeny u kterych se uzivatel nezaregistroval a nebo se jeste neodlasil */

        $fetchfrtdtd = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td')) OR (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td'))");

        $fetchfryy_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y')) OR (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y'))");

        $fetchypf_count = DB::select(" SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND shift_active_data.id AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL ))");
        $fetchtdpf_count = DB::select(" SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND shift_active_data.id AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL ))");

        /** - SQL dotaz, ktery vyhledava dnesni smeny u kterych se uzivatel nezaregistroval a nebo se jeste neodlasil */
        $fetchfrtdtd_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td')) OR (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td')) ");

        /**-prikazy, ktere ziskavaji predchozi vysledky z SQL dotazu  */
        /*$fetchfryy = mysqli_query($conn, $sqlfry);
        $fetchfrtdtd = mysqli_query($conn, $sqlfrtd);
        $fetchypf = mysqli_query($conn, $sqlypf);
        $fetchtdpf = mysqli_query($conn, $sqltdpf);


        /** tato cast zjistuje zda-li existuji nejake vysledky z dotatzu pro vcerejsi den */
        //return "SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y'))";
       // return "SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y')) OR (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y'))";
       if ($fetchfryy_count[0]->count > 0) {
           
            $fetchfryych_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y'))");
            $fetchfryych = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$y'))");

            /* $fetchfryych = mysqli_query($conn, $sqlfrych);*/
         
            foreach ($fetchfryy as $row_y) {
                
                //return 1;
                $st = $row_y->p_from;
                $en = $row_y->p_to;
                //return 1;
                /**podminka zkontroluje zda-li je jeste moznost se prihlasit do smeny - soucasny cas v timestapu je mensi nez timestamp kdy smena konci */
                if (strtotime($st) >= strtotime($en)) {
                    if (strtotime(date('H:i:s')) < strtotime($en)) {

                        $have = 1;
                    }
                }
            }
            
            if ($fetchfryych_count[0]->count > 0) {
                //return 1;
                foreach ($fetchfryych as $row_y2) {
                    //$id2 = $row_y2->id_saved;
                    $st2 = $row_y2->saved_from;
                    $en2 = $row_y2->saved_to;
                    /**podminka zkontroluje zda-li je jeste moznost se z smeny ohlasit - jeste neuplynulo 24 hodin od zacatku naplanovane smeny */
                    //$att_log = "SELECT * FROM attendance WHERE planned_id=$id2";
                    if (strtotime($st2) >= strtotime($en2)) {
                        if (strtotime(date('H:i:s')) < strtotime($st2)) {

                            $have = 1;
                            $checkfrom = 1;
                        }
                    }
                }
            }

        }
        /** tato cast zjistuje zda-li existuji nejake vysledky z dotatzu pro vcerejsi den */
        if ($have != 1) {

            if ($fetchfrtdtd_count[0]->count > 0) {
                $dd = 1;
               
                //$fetchfrtdch_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND shift_active_data.id_active IN (SELECT id_planned FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))");
                //$fetchfrtdch = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND shift_active_data.id_active IN (SELECT id_planned FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))");
                $fetchfrtdch_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td'))");
                $fetchfrtdch = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$u' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id_shift=shift_active_data.id_shift AND attendance.id='$u' AND attendance.saved_at='$td'))");
                //$fetchfrtdch = mysqli_query($conn, $sqlfrtdch);
                foreach ($fetchfrtdtd as $row_td) {
                    $st3 = $row_td->saved_from;
                    $en3 = $row_td->saved_to;
                    /**podminka kontroluje jestli smena neprechazi pres dva dny- kontroluje to tim, ze porovna timestampy
                     * 
                     */
                    if (strtotime($st3) >= strtotime($en3)) {
                        $have = 1;
                        /**podminka zkontroluje zda-li je jeste moznost se prihlasit do smeny - soucasny cas v timestapu je mensi nez timestamp kdy  smena konci */
                    } else if (strtotime($en3) > strtotime(date('H:i:s'))) {
                        $have = 1;
                    }
                }
               
                /**podminka kontroluje kontroluji zda-li se uzivatel uz na smenu prihlasil */
                if ($fetchfrtdch_count[0]->count > 0) {
                    
                    $have = 1;
                    $checkfrom = 1;
                }
            }
        }
      
        if ($fetchtdpf_count[0]->count > 0) {
            $pause_have = 1;
            foreach ($fetchtdpf as $row_id_td) {
                $td_id = $row_id_td->id_active;
            }
            $fetchtdpf2 = DB::select("SELECT * FROM attendance WHERE id_planned = $td_id ");
            //$fetchtdpf2 = mysqli_query($conn, $sqltdpf2);
            foreach ($fetchtdpf2 as $row_pause_td) {
                $pfrom_td = $row_pause_td->pause_from;
                $pto_td = $row_pause_td->pause_to;
            }
            if (strlen($pfrom_td) != strlen($pto_td)) {
                $pause = 1;

            }


        }
        if ($pause_have == 0) {
            if ($fetchypf_count[0]->count > 0) {
                $pause_have = 1;
                foreach ($fetchypf as $row_id_y) {
                    $y_id = $row_id_y->id_active;
                }
                $fetchypf2 = DB::select("SELECT * FROM attendance WHERE id_planned = $y_id ");
                //$fetchypf2 = mysqli_query($conn, $sqlypf2);
                foreach ($fetchypf2 as $row_pause_y) {
                    $pfrom_y = $row_pause_y->pause_from;
                    $pto_y = $row_pause_y->pause_to;
                }
                if (strlen($pfrom_y) != strlen($pto_y)) {
                    $pause = 1;

                }


            }
        }
        return response()->json([
            'pause' => $pause,
            'checkform' => $checkfrom,
            'log_exists' => $have,
            'dd' => $dd
        ]);
    }
    public function confirmDeparture(Request $request)
    {
        //$mysqli = require ("../database.php");
//$conn = new mysqli($host, $username, $password, $dbname);
$id = Auth::id();/** id uzivatele*/
//$ip_address = $_POST['ip_address'];/** ip addressa pouzivaneho zarizeni */
//$cookie = $_POST['cookie'];
        $y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
        $text = $request->input('text');/** text z komentare */
        $currentTime = date('H:i:s');/** soucasny cas */
        $td = date('Y-m-d');/** soucasny den */
        $status[] = array();/**vraceni zpatecnich dat */
        /**Vracene hodnoty
         * status[0] = 0 - vse v poradku 
         * status[0] = 1 - chybi komentar k pozdnimu odchodu 
         * status[0] = 2 - chybi komentar k brzkemu odchodu 
         * status[0] = 4 - ip zarizeni neni v databazi
         * status[0] = 5 - kod neprosel do databaze
         * 
         * status[1] = 0 - je pridany komentar
         * status[1] = 1 - neni pridany komentar
         */

         $cookie_checker = 0;
         $encryptedCookie = $request->cookie('secure_device');
 
         if (!$encryptedCookie) {
             $status[0] = 4;
         }
 
         $data = decrypt($encryptedCookie); // Dešifrujeme cookie
         $currentFingerprint = hash('sha256', $request->userAgent() . $request->ip());
 
         if ($data['fingerprint'] !== $currentFingerprint) {
             $status[0] = 4;
         } else {
             $device_id = $data['device_id'];
             $fetch_cookie = DB::select("SELECT COUNT(*) FROM devices WHERE device_token = '$device_id' ");
             if ($fetch_cookie[0]->count == 0) {
                 $status[0] = 4;
                 $cookie_checker = 1;
 
             }
         }

        $ip_list = array();/**list na ip v databazi */

        /**kontroluje zda-li je komentar dostatecne dlouhy */
        if (strlen($text) > 2) {
            $status[1] = 0;
        } else {
            $status[1] = 1;
            $text = "";
        }
        /** Ziskani IP adres z databaze */
        /*$sqlip = "SELECT * FROM IPS";
        $fetchip = mysqli_query($conn, $sqlip);
        while ($rowip = mysqli_fetch_assoc($fetchip)) {
            array_push($ip_list, $rowip['ip_address']);
        }
        $cookie_list = array();
        $sqlcookie = "SELECT * FROM cookie_list";
        $fetchcookie = mysqli_query($conn, $sqlcookie);
        while ($rowcookie = mysqli_fetch_assoc($fetchcookie)) {
            array_push($cookie_list, $rowcookie['cookie_code']);
        }*/

        $checkfrom = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */
        /** SQL prikaz na vyhledani vcerejsich smen */
        $fetchy_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$y' AND attendance.id_shift=shift_active_data.id_shift )");
        $fetchy = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to FROM shift_active_data WHERE shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$y' AND attendance.id_shift=shift_active_data.id_shift )");

        $fetchtd_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$td' AND attendance.id_shift=shift_active_data.id_shift )");
        $fetchtd = DB::select("SELECT *, shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to FROM shift_active_data WHERE shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND EXISTS (SELECT 1 FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$td' AND attendance.id_shift=shift_active_data.id_shift )");

        //$sqly = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$y' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        /** SQL prikaz na vyhledani dnesnich smen */
        /*$fetchy = mysqli_query($conn, $sqly);
        $sqltd = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$td' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
        $fetchtd = mysqli_query($conn, $sqltd);*/
      
        if ($fetchy_count[0]->count > 0) {
            $fetch_attendence_y = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$y'");
          
            foreach ($fetch_attendence_y as $row_tduy ) {
                $id_plan_y = $row_tduy->id_attendance;
            }
            foreach ($fetchy as $row_y) {
               // $id_plan = $row_y->id_attendance;
                $st = $row_y->saved_from;
                $en = $row_y->saved_to;
            }
            if (strtotime($st) >= strtotime($en)) {
                if (strtotime(date('H:i:s')) < strtotime($st)) {

                    $checkfrom = 1;

                    if (strtotime($en) < strtotime($currentTime)) {
                        $status[0] = 1;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            //$sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                            if ($cookie_checker != 1) {
                            DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE id_attendance=$id_plan_y");
                            }
                            /*checkip($ip_address,$cookie);
                            if ($status[0] != 4) {
                                if (!mysqli_query($conn, $sqlupdate)) {
                                    $status[0] = 5;
                                }
                            }*/

                        }
                       // echo json_encode($status);
                       return response()->json(['left' => $status[0], 'comment' => $status[1]]);


                    } else if (strtotime($en) > strtotime($currentTime) && strtotime($en) - 600 > strtotime($currentTime)) {
                        $status[0] = 2;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            if ($cookie_checker != 1) {
                             DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE id_attendance=$id_plan_y");

                            }
                           // $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                            /*checkip($ip_address,$cookie);
                            if ($status[0] != 4) {
                                if (!mysqli_query($conn, $sqlupdate)) {
                                    $status[0] = 5;
                                }
                            }*/

                        }
                        //echo json_encode($status);
                        return response()->json(['left' => $status[0], 'comment' => $status[1]]);


                    } else {
                        $status[0] = 0;
                        if ($cookie_checker != 1) {
                            DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE id_attendance=$id_plan_y");

                        }
                        //$sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                        /*checkip($ip_address,$cookie);
                        if ($status[0] != 4) {
                            if (!mysqli_query($conn, $sqlupdate)) {
                                $status[0] = 5;
                            }
                        }
                        echo json_encode($status);*/
                        return response()->json(['left' => $status[0], 'comment' => $status[1]]);

                    }





                }
            }


        }
        if ($checkfrom == 0) {
            if ($fetchtd_count[0]->count > 0) {
                $fetch_attendence = DB::select("SELECT * FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL AND attendance.id='$id' AND attendance.saved_at='$td'");
                foreach ($fetch_attendence as $row_tdu ) {
                    $id_plan_td = $row_tdu->id_attendance;
                }
                foreach ($fetchtd as $row_td ) {
                    //$id_plan_td = $row_td->id_attendance;
                    $st_td = $row_td->p_from;
                    $en_td = $row_td->p_to;
                }
                if (strtotime($st_td) >= strtotime($en_td)) {
                    $status[0] = 2;
                    if ($status[1] == 0) {
                        $status[0] = 0;
                        if ($cookie_checker != 1) {
                            DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE id_attendance=$id_plan_td ");
                        }
                        //checkip($ip_address,$cookie);
                        /*if ($status[0] != 4) {
                            if (!mysqli_query($conn, $sqlupdate_td)) {
                                $status[0] = 5;
                            }
                        }*/

                    }
                    return response()->json(['left' => $status[0], 'comment' => $status[1]]);

                    //return response()->json(['status' => $status[0], 'comment' => $status[1]]);
 
                    //echo json_encode($status);

                }else{
            
                
                if (strtotime($en_td) < strtotime($currentTime)) {
                    $status[0] = strtotime($st_td)."--".strtotime($en_td);
                    if ($status[1] == 0) {
                        $status[0] = 0;
                        if ($cookie_checker != 1) {
                        DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE id_attendance=$id_plan_td  ");
                        }
                        /*checkip($ip_address,$cookie);
                        if ($status[0] != 4) {
                            if (!mysqli_query($conn, $sqlupdate_td)) {
                                $status[0] = 5;

                            }
                        }*/

                    }
                    return response()->json(['left' => $status[0], 'comment' => $status[1]]);

                    //return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                    /*$status[0] = strtotime($st_td)."--".strtotime($en_td);
                    if ($status[1] == 0) {
                        $status[0] = 0;
                        $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
                        checkip($ip_address,$cookie);
                        if ($status[0] != 4) {
                            if (!mysqli_query($conn, $sqlupdate_td)) {
                                $status[0] = 5;

                            }
                        }

                    }
                    echo json_encode($status);*/

                } else if (strtotime($en_td) > strtotime($currentTime) && strtotime($en_td) - 600 > strtotime($currentTime)) {
                    $status[0] = 2;
                    if ($status[1] == 0) {
                        $status[0] = 0;
                        if ($cookie_checker != 1) {
                        DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE id_attendance=$id_plan_td  ");
                        }
                        /*checkip($ip_address,$cookie);
                        if ($status[0] != 4) {
                            if (!mysqli_query($conn, $sqlupdate_td)) {
                                $status[0] = 5;
                            }
                        }*/

                    }
                    return response()->json(['left' => $status[0], 'comment' => $status[1]]);

                    //return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                    //echo json_encode($status);

                } else {
                    $status[0] = 0;
                    if ($cookie_checker != 1) {
                    DB::update("UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE id_attendance=$id_plan_td ");
                    }
                    /*checkip($ip_address,$cookie);
                    if ($status[0] != 4) {
                        if (!mysqli_query($conn, $sqlupdate_td)) {
                            $status[0] = 5;
                        }
                    }*/
                    return response()->json(['left' => $status[0], 'comment' => $status[1]]);

                    //return response()->json(['status' => $status[0], 'comment' => $status[1]]);
                    //echo json_encode($status);

                }
            }
            

            }

        }

    }

    public function confirmArrival(Request $request)
    {
        /**tento soubor slouzi pro zaznamenavani prichodu na smenu */
        //$mysqli = require ("../database.php");

        //$conn = new mysqli($host, $username, $password, $dbname);
        $id = Auth::id(); /** id uzivatele*/
        //$ip_address = $_POST['ip_address']; /** ip addressa pouzivaneho zarizeni */
//$cookie = $_POST['cookie'];
        $y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
        $text = $request->input('text'); /** text z komentare */
        $currentTime = date('H:i:s');/** soucasny cas */
        $td = date('Y-m-d');/** soucasny den */
        $ip_list = array(); /**list na ip v databazi */
        $status[] = array();/**vraceni zpatecnich dat */
        /**Vracene hodnoty
         * status[0] = 0 - vse v poradku 
         * status[0] = 1 - chybi komentar k pozdnimu prichodu 
         * status[0] = 2 - chybi komentar k brzkemu prichodu 
         * status[0] = 4 - ip zarizeni neni v databazi
         * status[0] = 5 - kod neprosel do databaze
         * 
         * status[1] = 0 - je pridany komentar
         * status[1] = 1 - neni pridany komentar
         */
        $cookie_checker = 0;
        $encryptedCookie = $request->cookie('secure_device');

        if (!$encryptedCookie) {
            $status[0] = 4;
        }

        $data = decrypt($encryptedCookie); // Dešifrujeme cookie
        $currentFingerprint = hash('sha256', $request->userAgent() . $request->ip());

        if ($data['fingerprint'] !== $currentFingerprint) {
            $status[0] = 4;
        } else {
            $device_id = $data['device_id'];
            $fetch_cookie = DB::select("SELECT COUNT(*) FROM devices WHERE device_token = '$device_id' ");
            if ($fetch_cookie[0]->count == 0) {
                $status[0] = 4;
                $cookie_checker = 1;

            }
        }

        //

        // DB::select("SELECT * FROM ")

        //return 1;


        $id_plan_arr = array();/**arr pro id vcerejsi smeny   */
        $st_arr = array();/**arr pro casy zacatku vcerejsich smen   */
        $en_arr = array();/**arr pro casy koncu vcerejsich smen   */
        $id_plan_arr_td = array();/**arr pro id dnesni smeny   */
        $st_arr_td = array();/**arr pro casy zacatku dnesnich smen   */
        $en_arr_td = array();/**arr pro casy koncu dnesnich smen   */
        $p_from = array();/**arr pro casy koncu dnesnich smen   */
        $p_to = array();
        $com = array();
        $shi = array();
        $dates = array();
        $p_froms = "";
        $p_tos = "";
        $coms = "";
        $shis = "";
        $datess = "";


        /**kontroluje zda-li je komentar dostatecne dlouhy */
        if (strlen($text) > 2) {
            $status[1] = 0;
        } else {
            $status[1] = 1;
        }


        $have = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */

        /** Ziskani IP adres z databaze */
        /*$sqlip = "SELECT * FROM IPS";
        $fetchip = mysqli_query($conn, $sqlip);
        while ($rowip = mysqli_fetch_assoc($fetchip)) {
            array_push($ip_list, $rowip['ip_address']);
        }
        $cookie_list = array();
        $sqlcookie = "SELECT * FROM cookie_list";
        $fetchcookie = mysqli_query($conn, $sqlcookie);
        while ($rowcookie = mysqli_fetch_assoc($fetchcookie)) {
            array_push($cookie_list, $rowcookie['cookie_code']);
        }*/

        /** SQL prikaz na vyhledani vcerejsich smen */
        //$fetchy_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND shift_active_data.id_active NOT IN (SELECT id_planned FROM attendance ))");

        $fetchy_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$id' AND attendance.saved_at='$y'))");

        //$fetchy = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND shift_active_data.id_active NOT IN (SELECT id_planned FROM attendance ))");

        $fetchy = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$y' AND shift_active_data.id='$id' AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$id' AND attendance.saved_at='$y'))");

        //$sqly = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$y' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved NOT IN (SELECT planned_id FROM attendance /*WHERE log_from IS NULL*/))";
/*$fetchy = mysqli_query($conn, $sqly);
/** SQL prikaz na vyhledani dnesnich smen */
        //$sqltd = "SELECT * FROM shift_active_data WHERE (shift_active_data.saved_date='$td' AND shift_active_data.id_user='$id' AND shift_active_data.id_saved NOT IN (SELECT planned_id FROM attendance /*WHERE log_from IS NULL*///))";
        //$fetchtd_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND shift_active_data.id_active NOT IN (SELECT id_planned FROM attendance ))");
        $fetchtd_count = DB::select("SELECT COUNT(*) AS count FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$id') AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$id' AND attendance.saved_at='$td')");
        // DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='2025-02-07' AND shift_active_data.id=1) AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id=1 AND attendance.saved_at='2025-02-07')");

        $fetchtd = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$id') AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$id' AND attendance.saved_at='$td')");
        // $fetchtd = DB::select("SELECT * FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$id' AND shift_active_data.id_active NOT IN (SELECT id_planned FROM attendance ))");
        // $fetchtd = DB::select("SELECT * , shift_active_data.saved_from AS p_from, shift_active_data.saved_to AS p_to, shift_active_data.comments AS com, shift_active_data.id_shift AS shi, shift_active_data.saved_at AS dates FROM shift_active_data WHERE (shift_active_data.saved_at='$td' AND shift_active_data.id='$id') AND NOT EXISTS (SELECT 1 FROM attendance WHERE attendance.id_shift=shift_active_data.id_shift AND attendance.id='$id' AND attendance.saved_at='$td')");
        /*$fetchtd = mysqli_query($conn, $sqltd);

        /** nalezeni pouze jedne validni vcerejsi smeny */

        if ($fetchy_count[0]->count > 0 && $fetchy_count[0]->count == 1) {
            foreach ($fetchy as $row_y) {
                $id_plan = $row_y->id_active;
                $st = $row_y->saved_from;
                $en = $row_y->saved_to;

                $p_froms = $row_y->p_from;
                $p_tos = $row_y->p_to;
                $coms = $row_y->com;
                $shis = $row_y->shi;
                $datess = $row_y->dates;
                if (strtotime($st) >= strtotime($en)) {

                    if (strtotime(date('H:i:s')) < strtotime($en)) {
                        $have = 1;
                    }
                } else {
                    $have = 0;
                }
            }

            if ($have == 1) {
                if ($status[1] == 0) {
                    $status[0] = 0;
                    //$sqlinsert = "INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr) VALUES ($id_plan,'$currentTime',$id,'$text',1)";
                    // checkip($ip_address,$cookie);
                    //checkcookie($cookie);
                    if ($cookie_checker != 1) {
                        DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at ) VALUES ($id_plan,'$currentTime',$id,'$text',1, '$p_froms', '$p_tos', '$coms', '$shis', '$datess')");

                        /*if (!mysqli_query($conn, $sqlinsert)) {
                            $status[0] = 5;
                        }*/
                    }
                    return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                    //echo json_encode($status);
                } else {
                    $status[0] = 1;
                    //checkip($ip_address,$cookie);
                    //checkcookie($cookie);

                    //echo json_encode($status);
                    return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                }
            }
            /** nalezeni vicero validni vcerejsi smeny */
        } else if ($fetchy_count[0]->count > 1) {
            foreach ($fetchy as $row_y2) {
                $id_plan = $row_y2->id_active;
                $st = $row_y2->saved_from;
                $en = $row_y2->saved_to;


                $p_froms = $row_y2->p_from;
                $p_tos = $row_y2->p_to;
                $coms = $row_y2->com;
                $shis = $row_y2->shi;
                $datess = $row_y2->dates;
                if (strtotime($st) >= strtotime($en)) {

                    if (strtotime(date('H:i:s')) < strtotime($en)) {
                        array_push($id_plan_arr, $id_plan);
                        $st = strtotime($st) - 86400;
                        array_push($st_arr, $st);
                        $have = 1;
                    }
                }
            }
            if ($have == 1) {
                array_multisort($st_arr, $id_plan_arr);
                $n = sizeof($st_arr);
                $closest = $this->findClosest($st_arr, $n, strtotime(date('H:i:s')));
                for ($i = 0; $i < count($id_plan_arr); $i++) {
                    if ($st_arr[$i] == $closest) {
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            //$sqlinsert_arr = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr[$i],'$currentTime',$id,'$text',1)";
                            if ($cookie_checker != 1) {
                                DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at ) VALUES ($id_plan_arr[$i],'$currentTime',$id,'$text',1, '$p_froms', '$p_tos', '$coms', '$shis', '$datess')");
                            }
                            // checkip($ip_address,$cookie);
                            //checkcookie($cookie);
                            /* if($status[0] != 4){
                             if (!mysqli_query($conn, $sqlinsert_arr)) {
                                 $status[0] = 5;
                             }
                         }
                             echo json_encode($status);*/
                            return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                        } else {
                            $status[0] = 1;
                            //checkip($ip_address,$cookie);
                            //checkcookie($cookie);
                            //echo json_encode($status);
                            return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                        }
                        break;
                    }

                }
            }


        }

        if ($have == 0) {

            /** nalezeni pouze jedne validni dnesni smeny */
            if ($fetchtd_count[0]->count > 0 && $fetchtd_count[0]->count == 1) {

                foreach ($fetchtd as $row_td) {
                    $id_plan_td = $row_td->id_active;
                    $st_td = $row_td->saved_from;
                    $en_td = $row_td->saved_to;

                    $p_froms = $row_td->p_from;
                    $p_tos = $row_td->p_to;
                    $coms = $row_td->com;
                    $shis = $row_td->shi;
                    $datess = $row_td->dates;
                    if (strtotime($st_td) >= strtotime($en_td)) {
                        $have = 1;
                    } else if (strtotime($en_td) > strtotime(date('H:i:s'))) {
                        $have = 1;
                    }
                }
                if ($have == 1) {

                    if (strtotime($st_td) < strtotime($currentTime)) {
                        $status[0] = 1;

                        if ($status[1] == 0) {
                            $status[0] = 0;
                            //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                            if ($cookie_checker != 1) {
                                DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at ) VALUES ($id_plan_td,'$currentTime',$id,'$text',0, '$p_froms', '$p_tos', '$coms', '$shis', '$datess')");
                            }
                            //return response()->json([ 'cookie' => "INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)"]); 
                            /*checkip($ip_address,$cookie);
                            //checkcookie($cookie);
                            if($status[0] != 4){
                            if (!mysqli_query($conn, $sqlinsert_td)) {
                                $status[0] = 5;

                            }*/
                        }

                    }
                    return response()->json(['status' => $status[0], 'comment' => $status[1]]);


                    // echo json_encode($status);

                } else if (strtotime($st_td) > strtotime($currentTime) && strtotime($st_td) - 600 > strtotime($currentTime)) {
                    $status[0] = 2;
                    if ($status[1] == 0) {
                        $status[0] = 0;
                        //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                        if ($cookie_checker != 1) {
                            DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at) VALUES ($id_plan_td,'$currentTime',$id,'$text',0, '$p_froms', '$p_tos', '$coms', '$shis', '$datess')");
                        }

                        /*checkip($ip_address,$cookie);
                        //checkcookie($cookie);
                        if($status[0] != 4){
                        if (!mysqli_query($conn, $sqlinsert_td)) {
                            $status[0] = 5;
                        }
                    }*/

                    }
                    return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                    // echo json_encode($status);

                } else {
                    $status[0] = 0;
                    //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                    if ($cookie_checker != 1) {
                        DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at) VALUES ($id_plan_td,'$currentTime',$id,'$text',0 ,'$p_froms', '$p_tos', '$coms', '$shis', '$datess')");
                    }
                    // checkip($ip_address,$cookie);
                    //checkcookie($cookie);
                    /* if($status[0] != 4){
                     if (!mysqli_query($conn, $sqlinsert_td)) {
                         $status[0] = 5;
                     }
                 }*/
                    return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                    //echo json_encode($status);

                }

            }
            /** nalezeni vicero validnich dnesnich smen */ else if ($fetchtd_count[0]->count > 1) {

                //return response()->json([ 'cookie' => $data['device_id']]);
                foreach ($fetchtd as $row_td2) {
                    $id_plan_td2 = $row_td2->id_active;
                    $st_td2 = $row_td2->saved_from;
                    $en_td2 = $row_td2->saved_to;

                    if (strtotime($st_td2) >= strtotime($en_td2) || strtotime($en_td2) > strtotime(date('H:i:s'))) {

                        array_push($id_plan_arr_td, $id_plan_td2);
                        $st_td2 = strtotime($st_td2);
                        array_push($st_arr_td, $st_td2);

                        array_push($p_from, $row_td2->p_from);
                        array_push($p_to, $row_td2->p_to);
                        array_push($com, $row_td2->com);
                        array_push($shi, $row_td2->shi);
                        array_push($dates, $row_td2->dates);
                        $have = 1;
                    }
                }
                if ($have == 1) {
                    array_multisort($st_arr_td, $id_plan_arr_td, $p_from, $p_to, $com, $shi, $dates);

                    $n_td = sizeof($st_arr_td);
                    $closest_td = $this->findClosest($st_arr_td, $n_td, strtotime(date('H:i:s')));
                    for ($i = 0; $i < count($id_plan_arr_td); $i++) {
                        // echo " dsa";
                        if ($st_arr_td[$i] == $closest_td) {
                            if ($st_arr_td[$i] < strtotime($currentTime)) {
                                $status[0] = 1;
                                if ($status[1] == 0) {
                                    $status[0] = 0;
                                    //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                                    if ($cookie_checker != 1) {
                                        DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0, '$p_from[$i]', '$p_to[$i]', '$com[$i]', '$shi[$i]', '$dates[$i]' )");
                                    }
                                    //checkip($ip_address,$cookie);
                                    //checkcookie($cookie);
                                    /* if($status[0] != 4){
                                     if (!mysqli_query($conn, $sqlinsert_td)) {
                                         $status[0] = 5;
                                     }
                                 }*/

                                }
                                return response()->json(['status' => $status[0], 'comment' => $status[1]]);

                                // echo json_encode($status);

                            } else if ($st_arr_td[$i] > strtotime($currentTime) && $st_arr_td[$i] - 600 > strtotime($currentTime)) {
                                $status[0] = 2;
                                if ($status[1] == 0) {
                                    $status[0] = 0;
                                    //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                                    if ($cookie_checker != 1) {
                                        DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0, '$p_from[$i]', '$p_to[$i]', '$com[$i]', '$shi[$i]', '$dates[$i]' )");
                                    }
                                    //checkip($ip_address,$cookie);
                                    //checkcookie($cookie);
                                    /* if($status[0] != 4){
                                     if (!mysqli_query($conn, $sqlinsert_td)) {
                                         $status[0] = 5;
                                     }
                                 }*/

                                }
                                // echo json_encode($status);
                                return response()->json(['status' => $status[0], 'comment' => $status[1]]);


                            } else {
                                $status[0] = 0;
                                //$sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                                if ($cookie_checker != 1) {
                                    DB::insert("INSERT INTO attendance (id_planned,log_from,id,com_from,delay_arr, planned_from, planned_to, comment_on, id_shift, saved_at) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0, '$p_from[$i]', '$p_to[$i]', '$com[$i]', '$shi[$i]', '$dates[$i]' )");
                                }
                                //checkip($ip_address,$cookie);
                                //checkcookie($cookie);
                                /* if($status[0] != 4){
                                 if (!mysqli_query($conn, $sqlinsert_td)) {
                                     $status[0] = 5;
                                 }
                             }*/
                                //  echo json_encode($status);
                                return response()->json(['status' => $status[0], 'comment' => $status[1]]);


                            }


                        }
                    }
                }
            }


        }
    }





    /**nachazi nejblizsi volnou smenu */
    function findClosest($arr, $n, $target)
    {
        if ($target <= $arr[0])
            return $arr[0];
        if ($target >= $arr[$n - 1])
            return $arr[$n - 1];

        $i = 0;
        $j = $n;
        $mid = 0;
        while ($i < $j) {
            $mid = ($i + $j) / 2;

            if ($arr[$mid] == $target)
                return $arr[$mid];

            /* If target is less than array element, 
                then search in left */
            if ($target < $arr[$mid]) {

                // If target is greater than previous 
                // to mid, return closest of two 
                if ($mid > 0 && $target > $arr[$mid - 1])
                    return $this->getClosest(
                        $arr[$mid - 1],
                        $arr[$mid],
                        $target
                    );

                /* Repeat for left half */
                $j = $mid;
            }

            // If target is greater than mid 
            else {
                if (
                    $mid < $n - 1 &&
                    $target < $arr[$mid + 1]
                )
                    return $this->getClosest(
                        $arr[$mid],
                        $arr[$mid + 1],
                        $target
                    );

                // update i 
                $i = $mid + 1;
            }
        }

        // Only single element left after search 
        return $arr[$mid]; //$arr[$mid]; 
    }
    //}

    // Method to compare which one is the more close. 
// We find the closest by taking the difference 
// between the target and both values. It assumes 
// that val2 is greater than val1 and target lies 
// between these two. 
    function getClosest($val1, $val2, $target)
    {
        if ($target - $val1 >= $val2 - $target)
            return $val2;
        else
            return $val1;
    }


    /*array_multisort($st_arr, $id_plan_arr);
    $n = sizeof($st_arr);*/



    /**funkce kontroluje ip adresu zarizeni */
    function checkip($ip_search, $cookie_search)
    {
        global $ip_list;
        global $cookie_list;
        global $status;
        if (in_array($ip_search, $ip_list) || in_array($cookie_search, $cookie_list)) {
        } else {
            $status[0] = 4;
        }
    }
    /*function checkcookie($cookie_search)
    {
        global $cookie_list;
        global $status;
        if (in_array($cookie_search, $cookie_list)) {
        } else {
            $status[0] = 4;
        }
    }*/

}
function validateSecureCookie(Request $request)
{
    $encryptedCookie = $request->cookie('secure_device');

    if (!$encryptedCookie) {
        return 0;
    }

    $data = decrypt($encryptedCookie); // Dešifrujeme cookie
    $currentFingerprint = hash('sha256', $request->userAgent() . $request->ip());

    if ($data['fingerprint'] !== $currentFingerprint) {
        return 0;
    }
    // DB::select("SELECT * FROM ")

    return 1;
}

?>