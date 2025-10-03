<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

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
        
        $current_product = Product::create([
            'user_id' => $current_user->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $image_url,
            'image_public_id' => $image_public_id,
        ]);

        if ($request->filled('filters')) {
            $filters = explode(',', $request->filters);
            foreach($filters as $filter) {
                Filter::create([
                    'user_id' => $current_user->id,
                    'product_id' => $current_product->id,
                    'filter_name' => $filter
                ]);
            }
        }

        activity('product')
            ->causedBy($current_user)
            ->performedOn($current_product)
            ->withProperties([
                'username' => $current_user->username,
                'email' => $current_user->email,
                'product_name' => $current_product->name,
                'product_description' => $current_product->description,
                'product_price' => $current_product->price,
                'product_img_url' => $current_product->image_url,
            ])
        ->log('The user has successfully listed new product.');
        return redirect()->route('profile.edit-profile')->with('success', 'Your product was successfully listed.');
    }

    public function delete($id) {
        Product::find($id)->delete();
        return back()->with('success', 'The product was successfully deleted.');
    }
}
