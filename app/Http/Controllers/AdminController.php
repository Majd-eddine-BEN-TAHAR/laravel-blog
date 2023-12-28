<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function posts()
    {
        return view('admin.posts');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function editCategory(Category $category)
    {
        return view('admin.edit_category', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25|unique:categories,name',
            'description' => 'required',
        ]);

        // Correctly generate the slug
        $slug = Str::slug($request->input('name'), '-');

        Category::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description')
        ]);

        session()->flash('success', 'Category added successfully.');
        return redirect()->route('admin.categories');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            // ignore the category name being updated
            'name' => 'required|max:25|unique:categories,name,' . $category->id,
            'slug' => 'required|max:25|unique:categories,slug,' . $category->id,
            'description' => 'required',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('slug')), // replace spaces with dashes using Str
            'description' => $request->input('description')
        ]);

        session()->flash('success', 'Category updated successfully.');
        return redirect()->route('admin.categories');
    }



    public function destroyCategory(Category $category)
    {
        $category->delete();

        session()->flash('success', 'Category deleted successfully.');
        return redirect()->route('admin.categories');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
