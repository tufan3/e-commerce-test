<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = Subcategory::all();
        return view('subcategory.index', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('subcategory.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required',
        ]);
        $category = Category::find($request->category_id);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = Str::slug($category->category_name . ' ' . $request->subcategory_name);

        $subcategory->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
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
        $subcategory = Subcategory::where('subcategory_slug', $slug)->first();
        $category = Category::all();
        return view('subcategory.edit', compact('subcategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ]);

        $subcategory = Subcategory::where('subcategory_slug', $slug)->first();

        if ($subcategory->subcategory_name !== $request->subcategory_name) {
            $existing_sub_name = Subcategory::where('subcategory_name', $request->subcategory_name)->first();
            if ($existing_sub_name) {
                return redirect()->back()->withErrors(['subcategory_name' => '"' . $existing_sub_name->subcategory_name . '" this name is already used.']);
            }
            $subcategory->subcategory_name = $request->subcategory_name;
        }

        $category = Category::find($request->category_id);
        $subcategory->subcategory_slug = Str::slug($category->category_name . ' ' . $request->subcategory_name);

        $subcategory->category_id = $request->category_id;

        $subcategory->save();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $subcategory = Subcategory::where('subcategory_slug', $slug)->first();
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
