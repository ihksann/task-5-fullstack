<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    
    public function store(CategoryFormRequest $request)
    {
        $data = $request -> validated();

        $category = new Category;
        $category->name = $data['name'];

        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect('admin/category')->with('message','Kategori berhasil ditambahkan');      
    }


    public function show($category_id)
    {
        $data = Category::findOrFail($category_id);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Success show data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No data',
            ], 409);
        }
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request -> validated();

        $category = Category::find($category_id);
        $category->name = $data['name'];

        $category->user_id = Auth::user()->id;
        $category->update();

        return redirect('admin/category')->with('message','Kategori berhasil diperbaharui');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        if($category)
        {
            $category->delete();
            return redirect('admin/category')->with('message','Kategori berhasil dihapus');
        }
        else
        {
            return redirect('admin/category')->with('message','Kategori tidak ditemukan');
        }
    }
}
