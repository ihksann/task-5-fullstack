@extends('layouts.master')

@section('title', 'Tambah Artikel')

@section('content')

    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h1 class="mt-4">Tambah Artikel</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Masukan informasi dibawah ini :</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/add-post') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="">Kategori</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $cateitem)
                                <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Judul Artikel</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Isi Konten</label>
                        <textarea type="text" name="content" id="mySummernote" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
