<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function add_product(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        ]);
        $products = new Product();
        $products->title = $request->title;
        $products->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName); 
            $products->image = 'uploads/' . $imageName;
        }
        if ($products->save()) {
            return redirect()->route('home')->with('success', 'Product added successfully');
        } else {
            return redirect()->route('home')->with('error', 'Failed to add the product');
        }
    }

    public function show_product() {
        $products =Product::all();
        return view('product' ,compact('products'));
    }

    public function delete_product($id) {
        $product = Product::find($id);
        if($product->delete()) {
        return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
        return redirect()->back()->with('error', 'failed to delete product');
        }
    }
    public function edit_product($id) {
        $product = Product::find($id);
        return view('product-update',compact('product')); 
    }
    public function update_product(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        ]);
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $image = $request->image;
        if($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName); 
            $product->image = 'uploads/' . $imageName;
        }
        if($product->save()) {
            return redirect()->back()->with('success', 'Product updated successfully');
        } else {
            return redirect()->back()->with('error', 'failed to update product');
        }
    }

    // Controller method to retrieve products

    public function search(Request $request)
{
    $search = $request->input('search');
    $products = Product::where('title', 'like', "%$search%")->orWhere('description','like',"%$search%")->get();

    return view('search', compact('products' ,'search'));
}

}
