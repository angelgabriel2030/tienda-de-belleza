<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::orderBy('order')->get()->map(function ($p) {
            $p->image_url = $p->image_path ? Storage::url($p->image_path) : null;
            return $p;
        }));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|string|max:255',
            'image'   => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
            'visible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);
        $product = Product::create($data);
        $product->image_url = $product->image_path ? Storage::url($product->image_path) : null;

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'    => 'sometimes|string|max:255',
            'type'    => 'sometimes|string|max:255',
            'image'   => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
            'visible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) Storage::disk('public')->delete($product->image_path);
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);
        $product->update($data);
        $product->image_url = $product->image_path ? Storage::url($product->image_path) : null;

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) Storage::disk('public')->delete($product->image_path);
        $product->delete();
        return response()->json(null, 204);
    }
}
