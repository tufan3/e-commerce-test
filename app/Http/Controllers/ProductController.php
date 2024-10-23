<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a all product by category and subcategory by home page
     */
    public function home()
    {
        $categories = Category::with(['subcategories.products'])->get();
        return view('product.display', compact('categories'));
    }


    /**
     * Display a all product by category and subcategory by display page
     */
    public function display_products()
    {
        $categories = Category::with(['subcategories.products'])->get();
        return view('product.display', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $product = Product::all();
        // return view('product.index', compact('product'));
        $products = Product::with(['subcategory.category'])->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * dynamic dropdown show in subcategory.
     */
    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required|unique:products|string|max:255',
            'description' => 'required|string',
            'old_price' => 'numeric',
            'new_price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $category = Category::find($request->category_id);
        $subcategory = Subcategory::find($request->subcategory_id);

        $product = new Product();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->subcategory_id = $request->subcategory_id;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->product_slug = Str::slug($category->category_name . ' ' . $subcategory->subcategory_name . ' ' . $request->product_name);

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::with(['subcategory.category'])->where('product_slug', $slug)->first();
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $category = Category::all();
        $subcategories = Subcategory::all();
        $product = Product::with(['subcategory.category'])->where('product_slug', $slug)->first();
        return view('product.edit', compact('product', 'category', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'old_price' => 'required|numeric',
            'new_price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the product by its slug
        $product = Product::with(['subcategory.category'])->where('product_slug', $slug)->first();

        // Check if the product name is being changed
        if ($product->product_name !== $request->product_name) {
            // Check if another product with the same name already exists
            $existing_product = Product::where('product_name', $request->product_name)->first();

            if ($existing_product) {
                return redirect()->back()->withErrors(['product_name' => '"' . $existing_product->product_name . '" this name is already used.']);
            }
            $product->product_name = $request->product_name;
        }

        // Fetch the category and subcategory to update the slug accordingly
        $category = Category::find($request->category_id);
        $subcategory = Subcategory::find($request->subcategory_id);

        // Update the slug using category name, subcategory name, and product name
        $product->product_slug = Str::slug($category->category_name . ' ' . $subcategory->subcategory_name . ' ' . $request->product_name);

        // Handle image update if a new image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update other fields
        $product->subcategory_id = $request->subcategory_id;
        $product->description = $request->description;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;

        // Save the updated product
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $product = Product::where('product_slug', $slug)->first();

        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
