<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            'title' => 'Tag Management',
            'datas' => Tag::all()
        ];

        return view('tags', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = array(
            "title" => "Add New Product Tag",
        );

        return view("tag_create", $datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:tags'],
            'status' => ['required']
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Tag::create($validatedData);

        return redirect()->back()->with('success', 'A new tag named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $tag = Tag::where('slug', $slug);

        if (!$tag) {
            return redirect('tags');
        }

        $data = array(
            "title" => "tag Edit",
            "tag_data" => $tag->first()
        );

        return view("tag_edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::find(decrypt($id));

        $old_name = $tag->name;

        if (!$tag) {
            return redirect()->back()->with('error', 'tag not found.');
        }

        $validatedData = $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        if ($validatedData['name'] !== $tag->name) {
            $request->validate([
                'name' => ['unique:tags,name,' . $tag->id]
            ]);
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $tag->update($validatedData);

        return redirect('tags/' . $tag->slug . '/edit')->with('success', 'The Tag named <strong>' . $old_name . '</strong> has successfully been updated to <strong>' . $validatedData['name'] . '</strong> with the status set to <strong>' . $validatedData['status'] .'</strong>.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find(decrypt($id));

        $old_name = $tag->name;

        if (!$tag) {
            return redirect()->back()->with('error', 'tag named <strong>' . $old_name . '</strong> not found.');
        }

        Tag::destroy($tag->id);
        return back()->with('success', 'tag named <strong>' . $old_name . '</strong> has been deleted successfully!');
    }
}
