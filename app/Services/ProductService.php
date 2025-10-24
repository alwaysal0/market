<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

use App\Models\Filter;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class ProductService {

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function upload(array $validated_data, User $user) : void {
        $filepath = $validated_data['image']->getRealPath();

        $cloudinary = new Cloudinary();
        $cloudinaryImage = $cloudinary->uploadApi()->upload($filepath);
        $image_url = $cloudinaryImage['secure_url'];
        $image_public_id = $cloudinaryImage['public_id'];

        $current_product = Product::create([
            'user_id' => $user->id,
            'name' => $validated_data['name'],
            'description' => $validated_data['description'],
            'price' => $validated_data['price'],
            'image_url' => $image_url,
            'image_public_id' => $image_public_id,
        ]);

        if(isset($validated_data['filters'])) {
            $filters = explode(',', $validated_data['filters']);
            foreach($filters as $filter) {
                Filter::create([
                    'user_id' => $user->id,
                    'product_id' => $current_product->id,
                    'filter_name' => $filter
                ]);
            }
        }

        activity('product')
            ->causedBy($user)
            ->performedOn($current_product)
            ->withProperties([
                'username' => $user->username,
                'email' => $user->email,
                'product_name' => $current_product->name,
                'product_description' => $current_product->description,
                'product_price' => $current_product->price,
                'product_img_url' => $current_product->image_url,
            ])
        ->log('The user has successfully listed new product.');
    }

    public function sameProducts(int $id) {
        $product = Product::find($id);
        $filterNames = $product->filters->pluck('filter_name');

        $same_products_id = Filter::whereIn('filter_name', $filterNames)
        ->where('product_id', '!=', $id)
        ->distinct()
        ->pluck('product_id');

        $same_products = Product::whereIn('id', $same_products_id)->limit(5)->get();

        return $same_products;
    }

    public function getProductViewData(Product $product, bool $isAdmin = false) : array {
        $filters = Filter::where('product_id', $product->id)->get();
        $same_products = collect();

        if($filters) {
            $same_products = $this->sameProducts($product->id);
        }

        $reviews = Review::where('product_id', $product->id)->get();

        return [
            'product' => $product,
            'same_products' => $same_products,
            'filters' => $filters,
            'reviews' => $reviews,
            'user' => $this->user ?? null,
            'admin' => $isAdmin,
        ];
    }
}
