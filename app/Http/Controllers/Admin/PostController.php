<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.post.create',compact('category'));
    }

    public function store(PostFormRequest $request)
    {
        $data = $request->validated();

        $post = new Post;
        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->content = $data['content'];

        if($request->hasfile('image')){
            $file=$request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/',$filename);
            $post->image=$filename;
        }
        $post->user_id = Auth::user()->id;
        $post->save();
        
        return redirect('admin/posts')->with('message','Artikel Berhasil ditambahkan');
        
    }

    public function show($post_id)
    {
        $data = Post::findOrFail($post_id);

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

    public function edit($post_id)
    {
        $category = Category::all();
        $post = Post::find($post_id);
        return view('admin.post.edit', compact('post','category'));
    }

    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();

        $post = Post::find($post_id);
        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->content = $data['content'];

        if($request->hasfile('image')){

            $destination = 'uploads/post/'.$post->image;
            if(File::exists(public_path($destination))){
                File::delete(public_path($destination));
            }

            $file=$request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/',$filename);
            $post->image=$filename;
        }
        $post->user_id = Auth::user()->id;
        $post->update();
        
        return redirect('admin/posts')->with('message','Artikel Berhasil diperbarui');
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $destination = 'uploads/post/'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
        $post->delete();
        return redirect('admin/posts')->with('message','Artikel berhasil dihapus');
    }
    
}
