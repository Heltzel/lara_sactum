<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($this->validateRequest());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Product $product)
    {
        $product->update($this->validateRequest());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'success' => 'Product ' . $product->id . ' deleted',
        ]);
    }

    /**
     * Search by name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search(Product $product, $name)
    {
        return $product->where('name', 'like', '%' . $name . '%')->get();
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
    }
}
