<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('orders')->get();
        if($request->by_order == 'no_orders'){
            $products = Product::with('orders')->whereDoesntHave('orders')->get();
        }
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|max:100',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|gt:0',
        ]);

        Product::create($request->all()); //sudes visus laukus, jei yra inputu tokie pat pav kaip db

        return redirect()->route('product.index')->with('success', 'Product created successfully'); // su pranesimu
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated_data = $request->validate([
            'name' => [
                'required',
                Rule::unique('products')->ignore($product->id)
            ],
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|gt:0',
        ]);
        $product->update($validated_data);
        return redirect()->route('product.index')->with('success', 'Product updated successfully'); // su pranesimu
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->orders()->count() === 0){
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted');
        }else{
            return redirect()->route('product.index')->with('danger', 'Delete failed. Product has order.');
        }

    }
}
