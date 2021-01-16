<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $apartment = new Apartment([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'street' => $request->input('street'),
            'home' => $request->input('home'),
            'apartment' => $request->input('apartment'),
        ]);

        $user = auth()->user();

        $user->apartments()->save($apartment);

        $files = $request->file('image');

        foreach($files as $file)
        {
            $path = $file->store('images');

            $url = Storage::url($path);

            $image = new Image;

            $image->path = $url;

            $apartment->images()->save($image);
        }

        return response()->json($apartment, 201);
    }

    public function apartments(Request $request)
    {
        return Apartment::with('images')->get();
    }
}
