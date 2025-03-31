<?php

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\profile_pictures;
class ProfilePictures extends Controller
{
public function store(Request $request)
{
    /**
     * Stara verrze ukladani
     */
    $request->validate([
        'id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images'), $imageName);
    $product = new profile_pictures();
    $product->id = $request->id;
    $product->image = 'images/'.$imageName;
    $product->save();
}
}

?>