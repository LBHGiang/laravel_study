<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $products = Product::query()->where('user_id', $user_id)->get();
        return response($products, 200);
    }

    public function create(Request $request)
    {


    }

    public function store(Request $request)
    {

        Gate::authorize('product_create');

//        if (! Gate::allows('product_create')) {
//            return response([
//                'message' => 'Permission denied'
//            ], 403);
//        }


        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',
        ]);
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->user()->id,
        ]);
        if ($product) {
            return response([
                'message' => 'Product created successfully'
            ], 201);
        }
        return response([
            'message' => 'Product created failed'
        ], 444);
    }

    public function show($id)
    {
        $product = Product::query()->findOrFail($id);
        return response($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',
        ]);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response([
            'message' => 'Product updated successfully'
        ], 201);
    }

    public function destroy($id)
    {
        $product = Product::query()->where('id', $id)->delete();
        return response([
            'message' => 'Product deleted successfully'
        ], 201);
    }

}
