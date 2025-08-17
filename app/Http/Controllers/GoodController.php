<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;
use App\Models\Product;

class GoodController extends Controller
{
    //
    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $filepath = $request->file('image')->getRealPath();

        $cloudinary = new Cloudinary();
        $cloudinaryImage = $cloudinary->uploadApi()->upload($filepath);
        $image_url = $cloudinaryImage['secure_url'];
        $image_public_id = $cloudinaryImage['public_id'];

        $current_user = Auth::user();
        

        Product::create([
            'user_id' => $current_user->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $image_url,
            'image_public_id' => $image_public_id,
        ]);

        return redirect('/profile')->with('success', 'Your listing was successfully created.');
    }
}
