<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Image;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $apartment = Apartment::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'street' => $request->input('street'),
            'home' => $request->input('home'),
            'apartment' => $request->input('apartment'),
        ]);

        $files = $request->file('image');

        foreach($files as $file)
        {
            $path = $file->store('images');

            $image = new Image;

            $image->path = $path;

            $apartment->images()->save($image);
        }

        $apartment->save();

        return response()->json([
            $apartment
        ], 201);
    }
}
