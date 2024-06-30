<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'parent_id' => 'required',
            'description' => 'required'
        ]);
        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->description = $request->description;
        if ($request->status == 1)
        {
            $category->status = $request->status;
        }
        else
        {
            $category->status = 2;
        }
        $category->save();
        Alert::success('Category Added Successfully', '');
        return redirect()->back();
    }

    public function manage()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.category.manage', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->description = $request->description;
        if ($request->status == 1)
        {
            $category->status = $request->status;
        }
        else
        {
            $category->status = '2';
        }
        $category->save();
        Alert::success('Category update successfully', '');
        return redirect()->route('category.manage');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $subCategories = Category::where('parent_id', $category->id)->get();
//        dd($category->news);
        foreach ($subCategories as $item)
        {
            $item->delete();
        }
        foreach ($category->news as $data)
        {
            if (file_exists($data->image))
            {
                unlink($data->image);
            }
            $data->delete();
        }
        $category->delete();
        Alert::success('Category delete Successfully', '');
        return redirect()->back();
    }
}
