<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories, 'status' => 200]);
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json(['message' => 'category added', 'status' => 200]);
    }
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        return response()->json(['message' => 'category edited', 'status' => 200]);
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'category deleted', 'status' => 200]);
    }
}
