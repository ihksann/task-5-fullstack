@extends('layouts.master')

@section('title', 'Kategori')

@section('content')

    <div class="container-fluid px-4">


        <div class="card mt-4">
            <div class="card-header">
                <h4>Lihat Kategori <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">Tambah Kategori</a></h4>
            </div>

            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat oleh</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($category as $item)
                        
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            @if ($item->user_id == Auth::id())
                            <td>
                                <a href="{{ url('admin/edit-category/'.$item->id) }}" class="btn btn-success">Edit</a>
                            </td>

                            <td>
                                <a href="{{ url('admin/delete-category/'.$item->id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>




        <div class="row">

        </div>
    </div>

@endsection
