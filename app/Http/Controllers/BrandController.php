<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Brand Management',
            'datas' => Brand::all()
        ];

        return view('brands', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = array(
            "title" => "Add New Product Brand",
        );

        return view("brand_create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:brands'],
            'status' => ['required']
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Brand::create($validatedData);

        return redirect()->back()->with('success', 'A new brand named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $brand = Brand::where('slug', $slug);

        if (!$brand) {
            return redirect('brands');
        }

        $data = array(
            "title" => "Brand Edit",
            "brand_data" => $brand->first()
        );

        return view("brand_edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find(decrypt($id));

        $old_name = $brand->name;

        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        $validatedData = $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        if ($validatedData['name'] !== $brand->name) {
            $request->validate([
                'name' => ['unique:brands,name,' . $brand->id]
            ]);
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $brand->update($validatedData);

        return redirect('brands/' . $brand->slug . '/edit')->with('success', 'The brand named <strong>' . $old_name . '</strong> has successfully been updated to <strong>' . $validatedData['name'] . '</strong> with the status set to <strong>' . $validatedData['status'] .'</strong>.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find(decrypt($id));

        $old_name = $brand->name;

        if (!$brand) {
            return redirect()->back()->with('error', 'Brand named ' . $old_name . ' not found.');
        }

        Brand::destroy($brand->id);
        return back()->with('success', 'Brand named <strong>' . $old_name . '</strong> has been deleted successfully!');
    }
}
