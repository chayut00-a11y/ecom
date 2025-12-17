<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    //
    public function index()
    {
        $banners = Banner::get();
        $data = Product::paginate(5);

        return view('product', ['products' => $data, 'banners' => $banners]);
    }

    public function detail($id)
    {
        $data = Product::find($id);

        return view('detail', ['product' => $data]);
    }

    public function search(Request $request)
    {
        $data = Product::where('name', 'like', '%' . $request->input('query') . '%')->get();

        return view('search', ['products' => $data]);
    }

    public function show(Product $product)
    {
        $userId = Session::get('user')['id'];
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);
    }

    public function updateProduct(Request $request)
    {

        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->ecategory_id;
        $product->price = $request->price;

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $product['image'] = "images/$profileImage";
        }

        $product->update();

        return redirect('/allproduct')->with('success', 'Data Saved');
    }

    public function showProducts(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();

        if ($request->has('category_id')) {
            $categoryId = $request->input('category_id');
            $category = Category::where('id', $categoryId)->first();
            if ($category) {
                $products->where('category_id', $category->id);
            }
        }

    

        $products = $products->get();

        return view('showproduct', ['categories' => $categories, 'products' => $products]);
    }

}
