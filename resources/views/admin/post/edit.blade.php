@extends('layouts.master')

@section('title', 'Edit Artikel')

@section('content')

    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4>Edit Artikel</h4>
                
            </div>
            <div class="card-body">
                <form action="{{ url('admin/update-post/'.$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="">Kategori</label>
                        <select name="category_id" required class="form-control">
                            <option value="">-Select Category-</option>
                            @foreach ($category as $cateitem)
                                <option value="{{ $cateitem->id }}" {{ $post->category_id == $cateitem->id ? 'selected':'' }}>
                                    {{ $cateitem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Judul Artikel</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Isi Konten</label>
                        <textarea type="text" name="content" id="mySummernote" class="form-control">{!! $post->content !!}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Artikel</button>
                            <button>
                                <a href="{{ url('admin/posts') }}" class="btn btn-danger">Back</a>
                            </button>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
