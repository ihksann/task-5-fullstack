<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::paginate();
        // return view('welcome', $data);
        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil menampilkan semua artikel',
            'data'      => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $check_category = Category::where('id', $request->category_id)->first();

        if (!$check_category) {
            return response()->json([
                'message' => 'Kategori tidak tersedia',
            ]);
        }

        $data = $request->all();
        $image = $request->file('image');
        $data['image'] = $image->hashName();
        $image->storeAs('uploads/post/', $image->hashName());
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);

        if ($post) {
            return response()->json([
                'success'   => true,
                'message'   => 'Berhasil menambahkan artikel',
                'data'      => $post,
            ], 200);
        }
        return response()->json([
            'message' => 'Error'
        ], 400);
    }

    public function show($id)
    {
        $data = Post::findOrFail($id);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data',
            ], 409);
        }
    }

    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        dd($request->all());
        $data = $request->all();
        dd($post->image);
        if (!$request->file('image')) {
            $post->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui data',
                'update' => $post
            ], 200);
        } else {
            Storage::delete('uploads/post/' . $post->image);
            $image = $request->file('image');
            $image->storeAs('uploads/post/', $image->hashName());
            $data['image'] = $image->hashName();
            $post->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui data',
                'update' => $post
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error',
        ], 404);
    }

    public function delete($id)
    {
        $check = Post::findOrFail($id);
        if ($check) {
            Storage::delete('uploads/post/' . $check->image);
            Post::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No data',
            ], 404);
        }
    }
}
