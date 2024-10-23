<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            ]);
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $category = Category::where('category_slug', $slug)->first();
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'category_name' => 'required',
            ]);
            $category = Category::where('category_slug', $slug)->first();

            if ($category->category_name !== $request->category_name) {
                $existing_cat_name = Category::where('category_name', $request->category_name)->first();

                if ($existing_cat_name) {
                    return redirect()->back()->withErrors(['category_name' => '"' . $existing_cat_name->category_name . '" this name is already used.']);
                }

                    $category->category_name = $request->category_name;
                    $category->category_slug = Str::slug($request->category_name);
            }

            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category = Category::where('category_slug',$slug)->first();
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
