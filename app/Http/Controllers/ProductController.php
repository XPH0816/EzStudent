<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index($category = null) //If a category is provided, it filters the products by that category. If no category is provided, it retrieves all products.
    {
        $products = Product::where('quantity', '>', 0) // Filter out products with quantity 0
            ->get();

        return view('productIndex', compact('products'))->with('category', $category);
    }
    public function adminIndex($category = null) //If a category is provided, it filters the products by that category. If no category is provided, it retrieves all products.
    {
        $products = Product::all();
        return view('adminDashboard', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminAddStock');
    }

    public function generateReport($category = null)
    {
        $products = Product::all();
        return view('adminGenerateReport', compact('products'));
    }

    public function displayAddForm()
    {
        return view('adminAddStock');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {
        $request->validated();

        // Save image information to the database
        $productData = [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $request->file('image')->store('images'),
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ];

        Product::create($productData);

        return redirect()->back()->with('status', 'Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findorFail($id);

        return view('product', compact('product'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('type', 'like', '%' . $query . '%');
        })
            ->where('quantity', '>', 0) // Filter out products with quantity 0
            ->get();

        return view('search', compact('products'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('adminUpdateStock', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|in:Men,Women',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
        ]);

        // Update other fields
        $product->fill($request->except('image'));

        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $product->image = $request->file('image')->store('images');
        }

        $product->save();

        return redirect()->back()->with('status', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.home')->with('info', 'Product deleted successfully');
    }

    public function showDestroy($id)
    {
        $product = Product::findOrFail($id);

        return view('adminDeleteStock', compact('product'));
    }
}
