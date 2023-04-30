<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::paginate();
        return response()->json([
            'success' => true,
            'message' => 'Menampilkan semua kategori',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $data = $request->only(['name']);
        $data['user_id'] = auth()->user()->id;
        $categories = Category::create($data);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        };
        return response()->json([
            'success' => true,
            'message' => 'Success input data',
            'data' => $categories,
        ], 200);
    }

    public function show($id)
    {
        $data = Category::findOrFail($id);

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

    public function update(Request $request, $id)
    {
        $check = Category::firstWhere('id', $id);

        if ($check) {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:categories,name',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Success update data',
                'update' => $category,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No data',
            ], 404);
        }
    }
    public function delete($id)
    {
        $check = Category::firstWhere('id', $id);
        if ($check) {
            Category::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Success delete data',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No data',
            ], 404);
        }
    }

}
