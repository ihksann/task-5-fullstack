@extends('layouts.master')

@section('title', 'Lihat Artikel')

@section('content')

    <div class="container-fluid px-4">




        <div class="card mt-4">
            <div class="card-header">
                <h4>View Post
                    
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Judul Artikel</th>
                            <th>Isi Artikel</th>
                            <th>Author</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            
                        
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset('uploads/post/'.$item->image)}}" width="50px" height="50px" alt="">
                            </td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->user->name }}</td>
                            @if ($item->user_id == Auth::id())
                            <td>
                                <a href="{{ url('admin/post/'.$item->id) }}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <a href="{{ url('admin/delete-post/'.$item->id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    
                </table>
                <a href="{{ url('admin/add-post') }}" class="btn btn-primary">Tambahkan Artikel</a>
            </div>
        </div>
    </div>
@endsection
