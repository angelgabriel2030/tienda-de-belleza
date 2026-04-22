<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::orderBy('order')->get()->map(function ($c) {
            $c->image_url = $c->image_path ? Storage::url($c->image_path) : null;
            return $c;
        }));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:2048',
            'order'    => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image_path) Storage::disk('public')->delete($category->image_path);
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        unset($data['image']);
        $category->update($data);
        $category->image_url = $category->image_path ? Storage::url($category->image_path) : null;

        return response()->json($category);
    }
}
