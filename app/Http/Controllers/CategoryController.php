<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function showCat()
    {
        $category = Category::paginate(5);

        return view('category', ['categories' => $category]);
    }

    public function addCat(Request $request)
    {
        $category       = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect('/category');
    }

    public function deleteCat($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category has been deleted successfully!');
    }

    public function editCat($id)
    {
        $category = Category::find($id);

        return response()->json([
            'status'   => 200,
            'category' => $category,
        ]);
    }

    public function updateCat(Request $request)
    {
        $category_id    = $request->category_id;
        $category       = Category::find($category_id);
        $category->name = $request->name;
        $category->update();

        return redirect('/category')->with('success', 'Data Saved');
    }


}
