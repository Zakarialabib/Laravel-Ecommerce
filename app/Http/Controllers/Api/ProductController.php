<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'slug' => $request->slug,
            'category_id' => Category::create(['name' => $request->category_id])->id ?? null,
            'meta_title' => $request->name,
            'status' => false,
          ]);
    
          return new ProductResource($product);
    }

    public function bulkStore(ProductRequest $request)
    {
  
        $products = collect($request->all())->map(function($arr, $key) {
            return Arr::except($arr, ['categoryId']);
        });
    
        try {
            Product::insert($products->toArray());
            Log::info('Bulk store operation completed successfully.');
            return response()->json(['message' => 'Products uploaded successfully.']);
        } catch (\Exception $e) {
            Log::warning('Bulk store operation failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to upload products.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
          return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
