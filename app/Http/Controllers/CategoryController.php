<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store']);
    }

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Please fill it up!',
            'description.required' => 'Please fill it up!'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // return view('categories');
        return redirect()->route('categories')->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        $topics = $category->topics;

        return view('categories.show', compact('category','topics'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories', $category)->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully');
    }
}
