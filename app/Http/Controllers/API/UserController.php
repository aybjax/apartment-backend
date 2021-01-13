<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /** get input fields for creating user */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            "username" => $request->input('username'),
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "password" => Hash::make($request->password),
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $path = $request->file('image')->store('images');

                $url = Storage::url($path);

                $image = new Image;

                $image->path = $url;

                $user->image()->save($image);
        }

        $user->save();

        return response()->json([
            'url' => $url
        ], 201);

        // return response()->json([
        //     $request->all()
        // ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                "message" => "user credentials are wrong",
            ], 401);
        }

        return response()->json([
            "hello" => "there"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
