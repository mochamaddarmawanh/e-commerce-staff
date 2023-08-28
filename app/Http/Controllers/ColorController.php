<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Color Management',
            'datas' => Color::all()
        ];

        return view('colors', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = array(
            "title" => "Add New Product Color",
        );

        return view("color_create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:colors'],
            'status' => ['required']
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Color::create($validatedData);

        return redirect()->back()->with('success', 'A new color named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $color = Color::where('slug', $slug);

        if (!$color) {
            return redirect('colors');
        }

        $data = array(
            "title" => "color Edit",
            "color_data" => $color->first()
        );

        return view("color_edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Color::find(decrypt($id));

        $old_name = $color->name;

        if (!$color) {
            return redirect()->back()->with('error', 'Color not found.');
        }

        $validatedData = $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        if ($validatedData['name'] !== $color->name) {
            $request->validate([
                'name' => ['unique:colors,name,' . $color->id]
            ]);
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $color->update($validatedData);

        return redirect('colors/' . $color->slug . '/edit')->with('success', 'The color named <strong>' . $old_name . '</strong> has successfully been updated to <strong>' . $validatedData['name'] . '</strong> with the status set to <strong>' . $validatedData['status'] .'</strong>.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find(decrypt($id));

        $old_name = $color->name;

        if (!$color) {
            return redirect()->back()->with('error', 'Color named <strong>' . $old_name . '</strong> not found.');
        }

        Color::destroy($color->id);
        return back()->with('success', 'Color named <strong>' . $old_name . '</strong> has been deleted successfully!');
    }
}
