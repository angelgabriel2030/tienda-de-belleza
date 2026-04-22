<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteText;
use Illuminate\Http\Request;

class SiteTextController extends Controller
{
    public function index()
    {
        return response()->json(
            SiteText::all()->pluck('value', 'key')
        );
    }

    public function update(Request $request, string $key)
    {
        $request->validate(['value' => 'required|string']);

        $text = SiteText::where('key', $key)->firstOrFail();
        $text->update(['value' => $request->value]);

        return response()->json($text);
    }
}