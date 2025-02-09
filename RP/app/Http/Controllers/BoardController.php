<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BoardController extends Controller
{
    public function saveBoard(Request $request)
    {
        $text = $request->text;/** - text */
        $caption = $request->caption;/** - nadpis */
        $color = $request->color;/** - barva */


        /**indexy pro managery - $man, part-time emplyees - $part, full-time employess - $full
         * -tyto indexy udavaji, ktera pozice muze vydet muze vydet prispevek na nastence 
         * -0 znamena,ze pozice nemuze prispevek videt 
         * -1 znamena,ze pozice muze prispevek videt 
         */
        $man = $request->man;
        $part = $request->part;
        $full = $request->full;
        $t=date("Y-m-d H:i:s");
        $id = Auth::id();
        //("INSERT INTO board (caption, content, color, employee_full, employee_part, management) VALUES ('$caption','$text','$color','$full','$part','$man')");
        DB::insert("INSERT INTO board (caption, content, color, employee_full, employee_part, management, created_at, created_by) VALUES ('$caption','$text','$color','$full','$part','$man', '$t', '$id')");
        $fetch = DB::select("SELECT * FROM board WHERE created_at='$t' AND created_by='$id' ");
       $id_board = 0;
        foreach ($fetch as $result ){
            $id_board = $result->id_board;
            DB::insert("INSERT INTO board_logs (id_board, timestamp_at, made_by) VALUES ('$id_board','$t', '$id')");

        }
        return response()->json([
            'id_return' => $id_board,
            'stat' => "INSERT INTO board_logs (id_board, timestamp_at, made_by) VALUES ('$id_board','$t', '$id')",
            //'path' => $imagePath
        ]);
        //return
    }

    public function loadLargeBoard()
    {
        $fetch = DB::select("SELECT * FROM board, users WHERE users.id=board.created_by ");
        $type = 1;
        echo "<div class='row'>";
        foreach ($fetch as $result) {
            $positions = "<span class='p-1 rounded text-bg-dark mx-1'>Administrators</span>";
            $inside = str_replace("\n", "<br>", $result->content);
            $inside = str_replace(" ", "&nbsp;", $inside);
            if ($result->management == 1) {
                $positions = $positions . "<span class='p-1 rounded text-bg-danger mx-1'>Management</span>";
            }
            if ($result->employee_full == 1) {
                $positions = $positions . "<span class='p-1 rounded text-bg-primary mx-1'>Full-time</span><br style='line-height: 40px' >";
            }
            if ($result->employee_part == 1) {
                $positions = $positions . "<span class='p-1 rounded text-bg-success'>Full-time</span>";
            }
            echo '<div class="col-12 col-md-3 mt-2">';
            echo '<div class="card">';
            echo '<div class="item" style="padding:5px; margin:5px; ">';
            echo '<div class="card">';
            echo '<div class="card-header" style="background-color: ' . $result->color . '; height: 25px">';
            echo ' </div>';
            /*$fetch_img = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$result->created_by'");
            $supress = $fetch_img[0]->count;*/
            if ($result->image_link != null) {
                /*$fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$result->created_by'");
                $link_image = "";
                foreach ($fetch_link2 as $result_link2) {
                    $link_image2 = $result_link->image_link;
                }*/
                $imageUrl2 = Storage::url($result->image_link);
            } else {
                $imageUrl2 = 'https://www.rozbehamecesko.cz/repository/layout/noimage.png';
            }
            echo '<img height="150" class="object-fit-cover img-responsive" style="aspect-ratio: auto;white-space: nowrap;" src="'.$imageUrl2.'">';
            echo '<div class="card-body">';
            echo '<center><h5 class="card-title">' . $result->caption . '</h5></center>';
            echo '<hr>';
            echo '<p class="card-text " style="overflow: hidden visible;text-overflow: ellipsis;white-space: normal; max-height: 186px;">' . $inside . '';
            echo '</p>';
            echo '<hr>';
            echo '<div class="row">';
            echo '<p style="float: left"><strong>For :  </strong>' . $positions . '</p>';
            echo '</div>';
            echo '</div>';
            echo ' <div class="card-footer">';
            echo ' <div class="row">';
            echo ' <div class="col-12">';
            echo ' <div class="" style="display: inline">';
            $fetch_img = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$result->created_by'");
            $supress = $fetch_img[0]->count;
            if ($supress > 0) {
                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$result->created_by'");
                $link_image = "";
                foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                }
                $imageUrl = Storage::url($link_image);
            } else {
                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            }
            echo "   <img src=" . $imageUrl . " alt='hugenerd' width='40'";
            echo '        height="40" class="rounded-circle object-fit-cover img-responsive mr-3"';
            echo '       style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline;float: left">';
            echo '  </div>';

            echo '  <h5 class="mt-2" style="display: inline;float: left">&nbsp; ' . $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name . '&nbsp;&nbsp;</h5>';
            $t = $result->created_at;
            echo '  <small class="mt-2" style="float:right">' . substr($t, 0, -8) . '</small>';
            $id_encrypted = Crypt::encrypt($result->id_board);


            echo ' </div>';
            echo ' </div>';
            echo ' <div class="col-12 mt-2">';
            echo '<center><button class="btn btn-primary" onclick="editLoader(this.value)"  value="'.$id_encrypted.'" data-bs-toggle="modal"
                data-bs-target="#myModals">Edit</button></center>';
            echo ' </div>';  
            echo '</div>';




            echo ' </div>';
            echo ' </div>';
            echo ' </div>';
            echo ' </div>';
        }
        echo "</div>";
    }

    public function MultiCarouselInsert()
    {
        $fetch = DB::select("SELECT * FROM board, users WHERE users.id=board.created_by ");
        $type = 1;
        //echo "<div class='row'>";
        echo '<div class="row mx-auto my-auto justify-content-center">';
        echo '<div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">';
        echo '<div class="carousel-inner" role="listbox">';
        $counter = 0;
        foreach ($fetch as $result) {
            $counter++;
            $positions = "Administrators";
            $inside = str_replace("\n", "<br>", $result->content);
            $inside = str_replace(" ", "&nbsp;", $inside);
            if ($result->management == 1) {
                $positions = $positions . ", Management";
            }
            if ($result->employee_full == 1) {
                $positions = $positions . ", Full-time";
            }
            if ($result->employee_part == 1) {
                $positions = $positions . ", Part-time";
            }
            if ($counter == 1) {
                echo '<div class="carousel-item active">';
            } else {
                echo '<div class="carousel-item">';

            }

            echo '<div class="col-md-3">';
            echo ' <div class="card p-2">';
            echo '<div class="card">';

            echo '<div class="card-header" style="background-color: ' . $result->color . '; height: 25px">';
            echo ' </div>';
            
            echo '<img height="150" class="object-fit-cover img-responsive" style="aspect-ratio: auto;white-space: nowrap;" src="https://www.rozbehamecesko.cz/repository/layout/noimage.png">';

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $result->caption . '</h5>';
            echo '<hr>';
            echo '<p class="card-text" style="overflow: hidden visible;text-overflow: ellipsis;white-space: normal; max-height: 186px">' . $inside . '';
            /*echo '</p>';
            echo '<hr>';
            echo '<p style="float: left"><strong>For :  </strong>' . $positions . '</p>';*/
            echo '</div>';

            echo ' <div class="card-footer">';
            echo ' <div class="row">';
            echo ' <div class="col-12">';

            echo ' <div class="" style="display: inline">';
            $fetch_img = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$result->created_by'");
            $supress = $fetch_img[0]->count;
            if ($supress > 0) {
                $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$result->created_by'");
                $link_image = "";
                foreach ($fetch_link as $result_link) {
                    $link_image = $result_link->image_link;
                }
                $imageUrl = Storage::url($link_image);
            } else {
                $imageUrl = Storage::url('profile-images/avatar_blank2.jpg');
            }
            echo "   <img src=" . $imageUrl . " alt='hugenerd' width='40'";
            echo '        height="40" class="rounded-circle object-fit-cover img-responsive mr-3"';
            echo '       style="aspect-ratio: auto;overflow: hidden;white-space: nowrap;display: inline;float: left">';
            echo '  </div>';

            echo '  <h5 class="mt-2" style="display: inline;float: left">&nbsp; ' . $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name . '&nbsp;&nbsp;</h5>';
            $t = $result->created_at;
            echo '  <small class="mt-2" style="float:right">' . substr($t, 0, -8) . '</small>';



            echo ' </div>';
            echo ' </div>';
            echo '</div>';




            echo ' </div>';
            echo ' </div>';
            echo ' </div>';
            echo ' </div>';

        }
        echo '  </div>';
        echo ' <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">';
        echo ' <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo ' </a>';
        echo ' <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">';
        echo '    <span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '  </a>';
        echo ' </div>';
        echo ' </div>';
    }
    public function MultiCarouselInsert2()
    {
        /*echo '<div class="row mx-auto my-auto justify-content-center">';
        echo '<div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">';
        echo '<div class="carousel-inner" role="listbox">';*/





        echo "       <div class='carousel-item active'>
                                    <div class='col-md-3'>
                                        <div class='card'>
                                            <div class='card-img'>
                                                <img src='https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2' class='img-fluid'>
                                            </div>
                                            <div class='card-img-overlay'>Slide 1</div>
                                        </div>
                                    </div>
                                </div>";
                                echo "       <div class='carousel-item'>
                                <div class='col-md-3'>
                                    <div class='card'>
                                        <div class='card-img'>
                                            <img src='https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2' class='img-fluid'>
                                        </div>
                                        <div class='card-img-overlay'>Slide 2</div>
                                    </div>
                                </div>
                            </div>";

       /* echo '       <div class="carousel-item">
<div class="col-md-3">
    <div class="card">
        <div class="card-img">
            <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2" class="img-fluid">
        </div>
        <div class="card-img-overlay">Slide 2</div>
    </div>
</div>
</div>';

        echo '       <div class="carousel-item">
<div class="col-md-3">
    <div class="card">
        <div class="card-img">
            <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2" class="img-fluid">
        </div>
        <div class="card-img-overlay">Slide 3</div>
    </div>
</div>
</div>';
        echo '       <div class="carousel-item">
<div class="col-md-3">
    <div class="card">
        <div class="card-img">
            <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2" class="img-fluid">
        </div>
        <div class="card-img-overlay">Slide 4</div>
    </div>
</div>
</div>';*/






       /* echo '  </div>';
        echo ' <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">';
        echo ' <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo ' </a>';
        echo ' <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">';
        echo '    <span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '  </a>';
        echo ' </div>';
        echo ' </div>';*/
    }
    public function boardLoader(){
        //$id = Auth::id();
        $board = DB::select("SELECT content, caption, color, id_board, board.created_at, board.image_link FROM board, users, profile_pictures WHERE users.id=board.created_by AND profile_pictures.id=board.created_by ");
        $caption = array();
        foreach ($board as $result) {
            $caption[] = $result->caption;
  
        }
        return $board;
        /*return response()->json([
            'board' => $board,
            /*'caption' => $caption*/

            //'path' => $imagePath
        /*]);*/
        //return view('admin.dashboard2',['id'=>$id]);
      
    }
    public function storeImageBoard(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('board-images', 'public');
        $id = $request->input('id');
        //$id = Auth::id();

        /*$counter = 0;
        $fetch = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$id'");
        $supress = $fetch[0]->count;
        if ($supress > 0) {
            $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id'");
            $link_image = "";
            foreach ($fetch_link as $result) {
                $link_image = $result->image_link;
            }
            Storage::disk('public')->delete($link_image);
            DB::update("UPDATE profile_pictures SET image_link='$imagePath' WHERE id='$id' ");


        } else {
            DB::insert("INSERT INTO profile_pictures (id, image_link) VALUES ('$id', '$imagePath')");
        }*/
       // Storage::disk('public')->delete($link_image);
        DB::update("UPDATE board SET image_link='$imagePath' WHERE id_board='$id' ");

        return response()->json([
            'success' =>  $id,

            //'path' => $imagePath
        ]);
    }
    public function loadBoardData(Request $request)
    {
        $id_board =  Crypt::decrypt($request->input('id'));
       $fetch = DB::select("SELECT * FROM board WHERE id_board='$id_board'");
        foreach($fetch as $result){
            $caption = $result->caption;
            $color = $result->color;
            $content = $result->content;
            $employee_full = $result->employee_full;
            $employee_part = $result->employee_part;
            $management = $result->management;
            if ($result->image_link != null) {
    
                $imageUrl = Storage::url($result->image_link);
            } else {
                $imageUrl = 'https://www.rozbehamecesko.cz/repository/layout/noimage.png';
            }
        }
        return response()->json([
            'caption' =>  $caption ,
            'color' =>  $color ,
            'content' =>  $content ,
            'employee_full' =>  $employee_full ,
            'employee_part' =>  $employee_part ,
            'management' =>  $management ,
            'imageUrl' =>  $imageUrl ,
            //'path' => $imagePath
        ]);
    }
    public function updateBoard(Request $request){

        $text = $request->text;
        $caption = $request->caption;
        $color = $request->color;
        $id_board = $request->id_board;
        $id_board_decrypted = Crypt::decrypt($id_board);

        $man = $request->man;
        $part = $request->part;
        $full = $request->full;
        $t=date("Y-m-d H:i:s");
       DB::update("UPDATE board SET caption='$caption', content='$text', color='$color', management='$man', employee_full='$full', employee_part='$part' WHERE id_board='$id_board_decrypted' ");
     //  $t=date("Y-m-d H:i:s");
       $id_creator = Auth::id();
       DB::insert("INSERT INTO board_logs (id_board, timestamp_at, made_by) VALUES ('$id_board_decrypted','$t', '$id_creator')");
       return("UPDATE board SET caption='$caption', content='$text', color='$color', management='$man', employee_full='$full', employee_part='$part',  WHERE id_board='$id_board_decrypted' ");
       // $RR =("UPDATE board SET caption='$caption', content='$text', color='$color', management='$man', employee_full='$full', employee_part='$part',  WHERE id_board='$id_board' ");
        //$RR = "13";
        /*$man = $request->man;
        $part = $request->part;
        $full = $request->full;
        $t=date("Y-m-d H:i:s");
        $id = Auth::id();
        DB::insert("INSERT INTO board (caption, content, color, employee_full, employee_part, management, created_at, created_by) VALUES ('$caption','$text','$color','$full','$part','$man', '$t', '$id')");
        $fetch = DB::select("SELECT * FROM board WHERE created_at='$t' AND created_by='$id' ");
       $id_board = 0;
        foreach ($fetch as $result ){
            $id_board = $result->id_board;
        }*/
        /*return response()->json([
            'id_return' => $$RR,
            
        ]);*/
    }

    public function updateImageBoard(Request $request){
        $id_board = $request->id;

        $id_board_decrypted = Crypt::decrypt($id_board);
        $fetch_link = DB::select("SELECT * FROM profile_pictures WHERE id = '$id_board_decrypted'");
        $link_image = "";
        foreach ($fetch_link as $result) {
            $link_image = $result->image_link;
            Storage::disk('public')->delete($link_image);
        }
        $imagePath = $request->file('image')->store('board-images', 'public');

        //$link_image = Str::substr($link_image, 14);
        /*$fullPath = Storage::path($link_image);
        Storage::delete(asset('/storage/' .$link_image));
       Storage::delete($fullPath);*/

        DB::update("UPDATE board SET image_link='$imagePath' WHERE id_board='$id_board_decrypted' ");
        $t=date("Y-m-d H:i:s");
        $id_creator = Auth::id();
        //DB::insert("INSERT INTO board_logs (id_board, timestamp_at, made_by) VALUES ('$id_board_decrypted','$t', '$id_creator')");

        return response()->json([
            'success' =>  "INSERT INTO board_logs (id_board, timestamp_at, made_by) VALUES ('$id_board_decrypted','$t', '$id_creator')",

            //'path' => $imagePath
        ]);
    }

    public function loadBoardTimeline(Request $request){
        $id_board = $request->id_board;

        $id_board_decrypted = Crypt::decrypt($id_board);
        $id_creator = Auth::id();
        $number = $request->input('number');
       // echo $number;
        $fetch = DB::select( "SELECT * FROM board_logs, users WHERE board_logs.id_board='$id_board_decrypted' AND board_logs.made_by='$id_creator' AND board_logs.made_by=users.id  ORDER BY board_logs.timestamp_at DESC; ");
        $fetch_creator = DB::select("SELECT * FROM board, users WHERE board.id_board='$id_board_decrypted' AND board.created_by=users.id  ");
        foreach ($fetch_creator as $result_create) {
         
            $fetch_img2 = DB::select("SELECT COUNT(*) AS count FROM profile_pictures WHERE id = '$result_create->created_by'");
            $supress2 = $fetch_img2[0]->count;
            if ($supress2 > 0) {
                $fetch_link2 = DB::select("SELECT * FROM profile_pictures WHERE id = '$result_create->created_by'");
                $link_image2 = "";
                foreach ($fetch_link2 as $result_link2) {
                    $link_image2 = $result_link2->image_link;
                }
                $imageUrl2 = Storage::url($link_image2);
            } else {
                $imageUrl2 = Storage::url('profile-images/avatar_blank2.jpg');
            }
           echo '<div class="time">'.$result_create->created_at.'</div>';
            echo '<p class="mr-2" style="display:inline">'.$result_create->first_name.' '.$result_create->middle_name.' '.$result_create->last_name.'&nbsp;&nbsp;</p>';
           echo '<img id="imagePersoanl" src="'.$imageUrl2.'" alt="editor profile" class="rounded-circle object-fit-cover ml-2" style="height: 25px; width: 25px;display:inline">';
           echo "<hr>";
        }
        echo "<ul class='sessions px-0'>";
        $counter = 0;
        foreach ($fetch as $result) {
           // echo "<p>-------</p>";
            if( $counter == $number){
                break;
                 }
                 //echo "<p>'.$result->first_name.' '.$result->middle_name.' '.$result->last_name.'</p>";
            echo '<li>';
            echo '<div class="time">'.$result->timestamp_at.'</div>';
            echo '<p class="mr-2" style="display:inline">'.$result->first_name.' '.$result->middle_name.' '.$result->last_name.'&nbsp;&nbsp;</p>';
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
    public function deleteBoard(Request $request){
        $id_board = $request->id_board;

        $id_board_decrypted = Crypt::decrypt($id_board);
       DB::delete("DELETE FROM board WHERE id_board='$id_board_decrypted' ");
    }
        //retu
}


?>