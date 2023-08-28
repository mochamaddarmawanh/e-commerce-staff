<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Category Management',
            'datas' => Category::all()
        ];

        return view('categories', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = array(
            "title" => "Add New Product Category",
        );

        return view("category_create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:categories'],
            'status' => ['required']
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Category::create($validatedData);

        return redirect()->back()->with('success', 'A new category named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $category = Category::where('slug', $slug);

        if (!$category) {
            return redirect('categories');
        }

        $data = array(
            "title" => "category Edit",
            "category_data" => $category->first()
        );

        return view("category_edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find(decrypt($id));

        $old_name = $category->name;

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $validatedData = $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        if ($validatedData['name'] !== $category->name) {
            $request->validate([
                'name' => ['unique:categories,name,' . $category->id]
            ]);
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $category->update($validatedData);

        return redirect('categories/' . $category->slug . '/edit')->with('success', 'The category named <strong>' . $old_name . '</strong> has successfully been updated to <strong>' . $validatedData['name'] . '</strong> with the status set to <strong>' . $validatedData['status'] . '</strong>.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find(decrypt($id));

        $old_name = $category->name;

        if (!$category) {
            return redirect()->back()->with('error', 'Category named <strong>' . $old_name . '</strong> not found.');
        }

        if ($category->product()) {
            return back()->with('error', 'Cannot delete the category named <strong>' . $category->name . '</strong> because there are associated products. Please remove all products associated with this category first.');
        }

        Category::destroy($category->id);
        return back()->with('success', 'Category named <strong>' . $old_name . '</strong> has been deleted successfully!');
    }
}
