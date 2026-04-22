<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroImageController extends Controller
{
    public function index()
    {
        return response()->json(HeroImage::all()->map(function ($h) {
            $h->image_url = $h->image_path ? Storage::url($h->image_path) : null;
            return $h;
        }));
    }

    public function update(Request $request, string $slot)
    {
        $request->validate(['image' => 'required|image|max:2048']);

        $hero = HeroImage::where('slot', $slot)->firstOrFail();

        if ($hero->image_path) Storage::disk('public')->delete($hero->image_path);
        $hero->image_path = $request->file('image')->store('hero', 'public');
        $hero->save();

        $hero->image_url = Storage::url($hero->image_path);
        return response()->json($hero);
    }
}