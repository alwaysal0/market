<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;
use Carbon\Laravel\ServiceProvider;

use App\Models\Product;
use App\Models\Filter;

class GoodController extends Controller
{  
    //
    public function upload(Request $request) {
        $request->validate([
            'name' => 'required|string|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'required|string|min:10',
            'price' => 'required|integer|min:5'
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

        $current_post = Product::where('name', $request->name)->first();
        if ($request->filled('filters')) {
            $filters = explode(',', $request->filters);
            foreach($filters as $filter) {
                Filter::create([
                    'user_id' => $current_user->id,
                    'product_id' => $current_post->id,
                    'filter_name' => $filter
                ]);
            }
        }

        return redirect('/profile')->with('success', 'Your product was successfully listed.');
    }
}
