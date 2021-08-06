<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat()
    {
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);


        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->paginate(3);

        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request)
    {
        $validate = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255'
            ],
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Less Than 255Chars',
            ]
        );

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('all.category')->with('success', 'Category Inserted Successfully');
    }

    public function EditCat($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function UpdateCat(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'category_name' => 'required|max:255'
            ],
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Less Than 255Chars',
            ]
        );

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDeleteCat($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->route('all.category')->with('success', 'Category Soft Deleted Successfully');
    }

    public function RestoreCat($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->route('all.category')->with('success', 'Category Restored Successfully');
    }

    public function PDeleteCat($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('all.category')->with('success', 'Category Permanetly Deleted Successfully');
    }
}
