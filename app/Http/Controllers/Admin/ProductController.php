<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.products.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:male,female,children,unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', 'add_product']);
        $imgName = Str::snake($request->name) . '.' . $request->image->extension();
        $request->image->move(public_path('products/'), $imgName);
        $requestData['image'] = $imgName;
        $product = Product::create($requestData);
        return redirect()->route('products.index', [], 301)->with('success', 'Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        return view('admin.products.edit', compact('brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:male,female,children,unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500',
        ]);
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->sale_price = $request->sale_price ?? $product->sale_price;
        $product->color = $request->color ?? $product->color;
        $product->brand_id = $request->brand_id ?? $product->brand_id;
        $product->product_code = $request->product_code ?? $product->product_code;
        $product->gender = $request->gender ?? $product->gender;
        $product->function = $request->function ?? $product->function;
        $product->stock = $request->stock ?? $product->stock;
        $product->description = $request->description ?? $product->description;
        $product->save();
        return redirect()->route('products.index', [], 301)->with('success', 'Product updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productImage(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        $product = Product::find($id);
        if (!empty($product)) {
            $imgName = Str::snake($product->name) . '.' . $request->image->extension();
            $request->image->move(public_path('products/'), $imgName);
            $requestData['image'] = Str::snake($imgName);
            $existingImage = $product->image;
            $imageExists = public_path("products/$existingImage");
            if (file_exists($imageExists)) {
                unlink("products/$existingImage");
            }
            $product->update($requestData);
            return redirect()->route('products.index')->with('success', 'Product Image Updated Successfully!');
        } else {
            return redirect()->route('products.index')->with('danger', 'Something went wrong.');
        }
    }

    public function productStatus(Request $request, $id, $status = 1)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->is_active = $status;
            $product->save();
            return redirect()->route('products.index')->with('success', 'Product status Updated Successfully!');
        } else {
            return redirect()->route('products.index')->with('danger', 'Something went wrong.');
        }
    }
}
