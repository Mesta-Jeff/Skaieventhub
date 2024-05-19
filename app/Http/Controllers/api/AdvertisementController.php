<?php

namespace App\Http\Controllers\api;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortraitAdvert;
use App\Models\LandscapeAdvert;

class AdvertisementController extends Controller
{
    // Portrait Adverts
    public function viewPortraitAdvert()
    {
        $portraitAdverts = PortraitAdvert::all();
        return response()->json($portraitAdverts);
    }

    public function createPortraitAdvert(Request $request)
    {
        $portraitAdvert = PortraitAdvert::create($request->only(['title', 'content', 'image_url']));
        return response()->json($portraitAdvert, 201);
    }

    public function updatePortraitAdvert(Request $request)
    {
        $portraitAdvert = PortraitAdvert::find($request->id);
        if ($portraitAdvert) {
            $portraitAdvert->update($request->only(['title', 'content', 'image_url']));
            return response()->json($portraitAdvert);
        }
        return response()->json(['error' => 'Portrait Advert not found'], 404);
    }

    public function destroyPortraitAdvert(Request $request)
    {
        $portraitAdvert = PortraitAdvert::find($request->id);
        if ($portraitAdvert) {
            $portraitAdvert->delete();
            return response()->json(['message' => 'Portrait Advert deleted']);
        }
        return response()->json(['error' => 'Portrait Advert not found'], 404);
    }

    public function sortPortraitAdvert()
    {
        $portraitAdverts = PortraitAdvert::orderBy('title')->get();
        return response()->json($portraitAdverts);
    }

    // Landscape Adverts
    public function viewLandscapeAdvert()
    {
        $landscapeAdverts = LandscapeAdvert::all();
        return response()->json($landscapeAdverts);
    }

    public function createLandscapeAdvert(Request $request)
    {
        $landscapeAdvert = LandscapeAdvert::create($request->only(['title', 'content', 'image_url']));
        return response()->json($landscapeAdvert, 201);
    }

    public function updateLandscapeAdvert(Request $request)
    {
        $landscapeAdvert = LandscapeAdvert::find($request->id);
        if ($landscapeAdvert) {
            $landscapeAdvert->update($request->only(['title', 'content', 'image_url']));
            return response()->json($landscapeAdvert);
        }
        return response()->json(['error' => 'Landscape Advert not found'], 404);
    }

    public function destroyLandscapeAdvert(Request $request)
    {
        $landscapeAdvert = LandscapeAdvert::find($request->id);
        if ($landscapeAdvert) {
            $landscapeAdvert->delete();
            return response()->json(['message' => 'Landscape Advert deleted']);
        }
        return response()->json(['error' => 'Landscape Advert not found'], 404);
    }

    public function sortLandscapeAdvert()
    {
        $landscapeAdverts = LandscapeAdvert::orderBy('title')->get();
        return response()->json($landscapeAdverts);
    }
}
