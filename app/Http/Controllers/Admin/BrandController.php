<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
            'name' => 'required|min:2|max:10|string',
            'description' => 'nullable|string|max:100',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', 'add']);
        $imgName = Str::snake($request->name) . '.' . $request->image->extension();
        $request->image->move(public_path('brands/'), $imgName);
        $requestData['image'] = $imgName;
        $brand = Brand::create($requestData);
        if (!empty($brand)) {
            $brand->update($requestData);
            return redirect()->route('brands.index')->with('success', 'Brand has been added Successfully!');
        } else {
            return redirect()->route('brands.index')->with('danger', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:20|string',
            'description' => 'nullable|string|max:100',
        ]);
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand has been updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

    public function brandImage(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        $brand = Brand::find($id);
        if (!empty($brand)) {
            $imgName = Str::snake($brand->name) . '.' . $request->image->extension();
            $request->image->move(public_path('brands/'), $imgName);
            $requestData['image'] = Str::snake($imgName);
            $brand->update($requestData);
            return redirect()->route('brands.index')->with('success', 'Brand Image Updated Successfully!');
        } else {
            return redirect()->route('brands.index')->with('danger', 'Something went wrong.');
        }
    }

    public function brandStatus(Request $request, $id, $status = 1)
    {
        $brands = Brand::find($id);
        if (!empty($brands)) {
            $brands->is_active = $status;
            $brands->save();
            return redirect()->route('brands.index')->with('success', 'Brand status Updated Successfully!');
        } else {
            return redirect()->route('brands.index')->with('danger', 'Something went wrong.');
        }
    }
}
