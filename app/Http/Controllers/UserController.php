<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datas = [
            'title' => 'User Management',
            'datas' => User::where('status', '!=', 'off')->latest()->get()
        ];

        return view('users', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            "title" => "Add New User",
        );

        return view("user_create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'email' => ['required', 'email:dns', 'unique:users,email,NULL,id,status,active'],
            'name' => ['required', 'max:255'],
            'gender' => ['required'],
            'role' => ['required'],
            'password' => ['required', 'min:8', 'max:20'],
            'password_confirm' => ['required'],
        ]);

        if ($image = $request->file('image')) {
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/users'), $filename);
            $validatedData['image'] = $filename;
        }

        $slug = Str::slug($validatedData['name']);
        $unique_slug = $slug;
        $counter = 2;
        while (User::where('slug', $unique_slug)->first()) {
            $unique_slug = $slug . '-' . $counter;
            $counter++;
        }
        $validatedData['slug'] = $unique_slug;

        $user = User::create($validatedData);

        if ($request->has('send_verification') && $request->send_verification) {
            event(new Registered($user));
            // dispatch(new SendEmail($user));
            return redirect()->back()->with('success', 'A new user named <strong>' . $validatedData['name'] . '</strong> has been successfully created, and an email verification link for this user has also been sent.');
        }

        $user->markEmailAsVerified();
        return redirect()->back()->with('success', 'A new user named <strong>' . $validatedData['name'] . '</strong> has been successfully created.');

        // if ($request->send_verification) {
        //     dispatch(new SendEmail($validatedData));
        // } else {
        //     $validatedData['email_verified_at'] = now();
        // }

        // return str_replace('users/', '', $request->file('image')->store('users', "public"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // e.g. /users/{{ encrypt($user->id) }}
        // return User::where('id', decrypt($id))->get();

        $data = array(
            'title' => 'Add New User',
            'user_data' => User::where('slug', $slug)->first()
        );

        return view("user_show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        // $user = User::find(decrypt($id));

        $user = User::where('slug', $slug);

        if (!$user) {
            return redirect('users');
        }

        $data = array(
            "title" => "User Edit",
            "user_data" => $user->first()
        );

        return view("user_edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find(decrypt($id));

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $validatedData = $request->validate([
            'image' => ['image', 'mimes:png,jpeg,jpg', 'file', 'max:2000'],
            'name' => ['required', 'max:255'],
            'gender' => ['required'],
            'role' => ['required'],
        ]);

        if ($image = $request->file('image')) {
            if ($user->image && file_exists(public_path('assets/images/users/' . $user->image))) {
                unlink(public_path('assets/images/users/' . $user->image));
            }

            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/users'), $filename);
            $validatedData['image'] = $filename;
        }

        $user->update($validatedData);

        // Update slug if needed
        $slug = Str::slug($validatedData['name']);
        $unique_slug = $slug;
        $counter = 2;
        while (User::where('slug', $unique_slug)->where('id', '!=', $user->id)->first()) {
            $unique_slug = $slug . '-' . $counter;
            $counter++;
        }
        $user->update(['slug' => $unique_slug]);

        return redirect('users/' . $user->slug . '/edit')->with('success', 'The user with the email <strong>' . $user->email . '</strong> has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(decrypt($id));

        $old_name = $user->name;

        if (!$user) {
            return redirect()->back()->with('error', 'User named <strong>' . $old_name . '</strong> not found.');
        }

        $user->status = 'off';
        $user->save();

        return back()->with('success', 'User named <strong>' . $old_name . '</strong> has been deleted successfully!');
    }
}
