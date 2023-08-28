<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queries = Product::select(
            'id',
            'product_code',
            'category_id',
            'brand_id',
            'name',
            'slug',
            'gender',
            'weight',
            'actual_price',
            'final_price',
            'dealer_price',
            'discount',
            'stock',
            'status',
            'created_at',
            'updated_at'
        )->with([
            'category:id,name',
            'brand:id,name',
            'product_color:product_id,color_id',
            'product_color.color:id,name',
            'product_size:product_id,size_id',
            'product_tag:product_id,tag_id',
            'product_tag.tag:id,name'
        ])->get();

        $datas = [
            'title' => 'Product Management',
            'datas' => $queries
        ];

        return view('products', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = array(
            'title' => 'Add New Product',
            'datas' => [
                'categories' => Category::select('id', 'name')->get(),
                'brands' => Brand::select('id', 'name')->get(),
                'colors' => Color::select('id', 'name')->get(),
                'tags' => Tag::select('id', 'name')->get(),
            ],
        );

        return view("product_create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'first_image' => ['required', 'image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'second_image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'third_image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'name' => ['required', 'max:100', 'unique:products'],
            'gender' => ['required'],
            'description' => ['required'],
            'weight' => ['required'],
            'actual_price' => ['required'],
            'final_price' => ['required'],
            'dealer_price' => ['required'],
            'discount' => ['required'],
            'stock' => ['required'],
            'status' => ['required'],
            'size' => ['required'],
            'tag_id' => ['required'],
            'color_id' => ['required'],
        ]);

        $validatedData['product_code'] = 'PRO-' . Str::random(10);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $first_image = $request->file('first_image');
        $first_image_name = Str::uuid() . '.' . $first_image->getClientOriginalExtension();
        $first_image->move(public_path('assets/images/products'), $first_image_name);
        $validatedData['first_image'] = $first_image_name;

        if ($second_image = $request->file('second_image')) {
            $second_image_name = Str::uuid() . '.' . $second_image->getClientOriginalExtension();
            $second_image->move(public_path('assets/images/products'), $second_image_name);
            $validatedData['second_image'] = $first_image_name;
        }

        if ($third_image = $request->file('third_image')) {
            $third_image_name = Str::uuid() . '.' . $third_image->getClientOriginalExtension();
            $third_image->move(public_path('assets/images/products'), $third_image_name);
            $validatedData['third_image'] = $first_image_name;
        }

        $product = Product::create($validatedData);

        $product->color()->attach($validatedData['color_id']);
        $product->tag()->attach($validatedData['tag_id']);
        $product->size()->attach($validatedData['size']);


        // ProductColor::create($validatedData);
        // ProductSize::create($validatedData);
        // ProductTag::create($validatedData);

        return redirect()->back()->with('success', 'A new product named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $product = Product::with([
            'category:id,name',
            'brand:id,name',
            'product_color:product_id,color_id',
            'product_color.color:id,name',
            'product_size:product_id,size_id',
            'product_tag:product_id,tag_id',
            'product_tag.tag:id,name'
        ])->where('slug', $slug)->first();

        if (!$product) {
            return redirect('products');
        }

        $datas = array(
            'title' => 'product Edit',
            'datas' => [
                'product' => $product,
                'categories' => Category::select('id', 'name')->get(),
                'brands' => Brand::select('id', 'name')->get(),
                'colors' => Color::select('id', 'name')->get(),
                'tags' => Tag::select('id', 'name')->get(),
            ]
        );

        return view("product_edit", $datas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail(decrypt($id));

        $validatedData = $request->validate([
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'first_image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'second_image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'third_image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'name' => ['required', 'max:100', Rule::unique('products')->ignore($product->id)],
            'gender' => ['required'],
            'description' => ['required'],
            'weight' => ['required'],
            'actual_price' => ['required'],
            'final_price' => ['required'],
            'dealer_price' => ['required'],
            'discount' => ['required'],
            'stock' => ['required'],
            'status' => ['required'],
            'size' => ['required'],
            'tag_id' => ['required'],
            'color_id' => ['required'],
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        foreach (['first_image', 'second_image', 'third_image'] as $image_field) {
            if ($request->hasFile($image_field)) {
                $new_image = $request->file($image_field);
                $new_image_name = Str::uuid() . '.' . $new_image->getClientOriginalExtension();
                $new_image->move(public_path('assets/images/products'), $new_image_name);

                if ($product->$image_field && file_exists(public_path('assets/images/products/' . $product->$image_field))) {
                    unlink(public_path('assets/images/products/' . $product->$image_field));
                }

                $validatedData[$image_field] = $new_image_name;
            }
        }

        $product->update($validatedData);

        $product->color()->sync($validatedData['color_id']);
        $product->tag()->sync($validatedData['tag_id']);
        $product->size()->sync($validatedData['size']);

        return redirect('products/' . $product->slug . '/edit')->with('success', 'Product with code <strong>' . $product->product_code . '</strong> has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find(decrypt($id));

        $old_code = $product->product_code;

        if (!$product) {
            return redirect()->back()->with('error', 'Product with code <strong>' . $old_code . '</strong> not found.');
        }

        Product::destroy($product->id);
        return back()->with('success', 'Product with code <strong>' . $old_code . '</strong> has been deleted successfully!');
    }

    public function delete_selected_rows(Request $request)
    {
        $selectedRows = $request->input('selected_rows');
        $productIds = explode(',', $selectedRows[0]);

        foreach ($productIds as $productId) {
            $productId = decrypt($productId);

            $product = Product::find($productId);

            if ($product) {
                $product->delete();
            }
        }

        return redirect()->back()->with('success', 'Selected rows have been deleted successfully.');
    }
}
